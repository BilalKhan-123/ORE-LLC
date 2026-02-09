<?php

namespace App\Services;

use App\Models\User;
use App\Models\Answer;
use App\Library\Helper;
use App\Models\Payment;
use App\Models\UserOtp;
use App\Jobs\WelcomeUser;
use App\Traits\BaseModel;
use App\Models\AnswerResult;
use App\Models\UserDescribe;
use App\Library\PaymentHelper;
use App\Models\UserMajorIllness;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Jobs\TestMultipleAttemptMailJob;
use Carbon\Carbon;

class ParticipantService
{
    use BaseModel;

    private $userObj;

    public function __construct()
    {
        $this->userObj = new User;
    }

    public function collection(array $inputs)
    {
        $users = $this->userObj->getQB()->role(config('site.roles.user'));

        if (Auth::user()->hasRole(config('site.roles.client'))) {
            $users = $users->where('client_id', Auth::user()->id);
        }

        $inputs['limit'] = isset($inputs['limit']) ? $inputs['limit'] : config('site.paginationLimit');

        return (isset($inputs['limit']) && $inputs['limit'] == '-1') ? $users->get() : $users->paginate($inputs['limit']);
    }

    public function store(array $inputs)
    {
        $client = null;
        if (auth('sanctum')->check()) {
            $password = Helper::generatePassword();
            if (auth('sanctum')->user()->hasRole(config('site.roles.client'))) {
                $inputs['client_id'] = auth('sanctum')->user()->id;
            }
        } else {
            $password = $inputs['password'];

            if (isset($inputs['client_code']) && ! empty($inputs['client_code'])) {
                $client = $this->userObj->whereClientCode($inputs['client_code'])->first();

                $inputs['client_id'] = $client->id;
            }
        }

        $inputs['password'] = $password;

        DB::beginTransaction();
        unset($inputs['client_code']);
        $user = $this->userObj->create($inputs);
        $user->assignRole(config('site.roles.user'));
        if (! empty($user->client)) {
            $client = $user->client;
            $this->syncClientData($client);
        }
        DB::commit();

        try {
            $customer = PaymentHelper::createCustomer($user->full_name, $user->email);
            $user->stripe_customer_id = $customer->id;
            $user->save();
        } catch (\Exception $e) {
            Log::info('Stripe customer create error : ' . $e->getMessage());
        }

        try {
            WelcomeUser::dispatch($user, (auth('sanctum')->check() ? $password : ''))->onQueue('mail');
        } catch (\Exception $e) {
            Log::info('Error Send Welcome Email : ' . $e->getMessage());
        }

        if (auth('sanctum')->check()) {
            $data['message'] = __('entity.entityCreated', ['entity' => __('message.participant')]);
        } else {
            $data['message'] = __('message.userRegisterSuccess');
        }

        return $data;
    }

    public function resource($id, $inputs = [])
    {
        $user = $this->userObj->getQB()->role(config('site.roles.user'))->findOrFail($id);

        return $user;
    }

    public function update(int $id, array $inputs)
    {
        
        $user = $this->resource($id);
        $coreInputs = $inputs;
        unset($inputs['describe_you'], $inputs['current_major_illness']);
        DB::beginTransaction();
        if (isset($inputs['birthdate'])) {
            $birthdate = Carbon::parse($inputs['birthdate']);
            $inputs['chronological_age'] = $birthdate->age; 
        }
        if(isset($inputs['day']) && isset($inputs['month']) && isset($inputs['year'])){
            //$inputs['month'] = \Carbon\Carbon::parse($inputs['month'])->month;
            $birthdate = Carbon::createFromDate($inputs['year'], $inputs['month'], $inputs['day']);
            $inputs['birthdate'] = $birthdate->toDateString();
            $inputs['chronological_age'] = $birthdate->age; 
        }
        
        $user->update($inputs);
        $this->syncChildData($user, $coreInputs);
        DB::commit();
        $data['message'] = __('entity.entityUpdated', ['entity' => __('message.participant')]);

        return $data;
    }

    public function destroy(int $id)
    {
        // Custom Deletion
        DB::statement('SET foreign_key_checks = 0;');
        $answer_ids = Answer::where('user_id', $id)->pluck('id');
        if (count($answer_ids) > 0) {
            AnswerResult::whereIn('answer_id', $answer_ids)->delete();
            Answer::where('user_id', $id)->delete();
        }
        Payment::where('user_id', $id)->delete();
        UserDescribe::where('user_id', $id)->delete();
        UserMajorIllness::where('user_id', $id)->delete();
        UserOtp::where('user_id', $id)->delete();
        DB::statement('SET foreign_key_checks = 1;');

        $this->userObj->where('id', $id)->delete();
        //$this->userObj->delete($id);
        $data['message'] = __('entity.entityDeleted', ['entity' => __('message.participant')]);

        return $data;
    }

    public function changeStatus($inputs)
    {
        $participant = $this->userObj->findOrFail($inputs['participant_id']);

        if ($participant->hasAcccessManageParticipantStatus()) {
            $participant->update(['status' => $inputs['status']]);

            if ($inputs['status'] == config('site.user_status.inactive')) {
                $isDeleted = $participant->tokens()->delete();
            }

            $data = [
                'status' => true,
                'message' => __('message.changeStatusSuccess', ['module' => __('message.participant'), 'status' => $inputs['status']]),
            ];

            return $data;
        }
        $data['errors']['message'] = __('message.invalidAction');

        return $data;
    }

    public function updateAllowMultipleAttempts(array $inputs)
    {
        $userObj = $this->userObj->findOrFail($inputs['user_id']);

        if ($userObj->hasAcccessManageParticipantStatus()) {
            $userObj->update(['allow_multiple_attempts' => $inputs['allow_multiple_attempts']]);

            $resUser = ['name' => $userObj->first_name . ' ' . $userObj->last_name];

            $data = [
                'status' => true,
                'message' => ($inputs['allow_multiple_attempts'] == 1 ? __('message.allowAttempt', $resUser) : __('message.notAllowAttempt', $resUser)),
            ];

            TestMultipleAttemptMailJob::dispatch($userObj);

            return $data;
        }
        $data['errors']['message'] = __('message.invalidAction');

        return $data;
    }

    private function syncChildData(object $user, array $inputs)
    {
        $authUser = auth()->user();
        if (! empty($inputs['describe_you'])) {
            $authUser->userDescribe()->delete();

            $userDescribeArr = [];
            foreach ($inputs['describe_you'] as $item) {
                $userDescribeArr[] = new UserDescribe([
                    'dropdown_option_id' => $item,
                ]);
            }
            $authUser->userDescribe()->saveMany($userDescribeArr);
        }

        if (! empty($inputs['current_major_illness'])) {
            $authUser->userMajorIllness()->delete();
            $userMajorIllnessArr = [];
            foreach ($inputs['current_major_illness'] as $item) {
                $userMajorIllnessArr[] = new UserMajorIllness([
                    'dropdown_option_id' => $item,
                ]);
            }
            $authUser->userMajorIllness()->saveMany($userMajorIllnessArr);
        }
    }

    private function syncClientData(?object $client)
    {
        if (! empty($client)) {
            $participantCount = $client->participants()->count();
            $client->clientMetadata()->update([
                'number_of_participants' => $participantCount,
            ]);
        }
    }
}
