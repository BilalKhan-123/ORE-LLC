<?php

namespace App\Services;

use DB;
use App\Models\User;
use App\Helpers\Helper;
use App\Models\UserOtp;
use App\Models\AgeGroup;

class UserService
{
    public function __construct(
        private User $userObj,
        private UserOtp $userOtpObj,
        private UserOtpService $userOtpService,
        private ParticipantService $participantService
    ) {
        //
    }

    public function resource($id, $inputs = null)
    {
        $user = $this->userObj->getQB()->findOrFail($id);

        return $user;
    }

    public function update(int $id, $inputs = [])
    {
        $user = $this->resource($id);

        DB::beginTransaction();
        if (isset($user->role['name']) && $user->role['name'] == config('site.roles.user')) {
            $this->participantService->update($id, $inputs);
        } else {
            $user->update($inputs);
        }

        if (! empty($inputs['birthdate'])) {
            $userAge = Helper::getCurrentAge($inputs['birthdate']);
            $ageGroup = AgeGroup::query()->where('min_age', '<=', $userAge)->where('max_age', '>=', $userAge)->firstOrFail();

            if (! empty($user->answerLatest)) {
                if (empty($user->answerLatest->age_group_id)) {
                    $user->answerLatest()->take(1)->update([
                        'age_group_id' => $ageGroup->id,
                    ]);
                }
            }
        }
        DB::commit();

        $data = [
            'status' => true,
            'message' => __('message.userProfileUpdate'),
        ];

        return $data;
    }

    public function changeStatus($inputs)
    {
        $user = $this->userObj->findOrFail($inputs['user_id']);
        $user->status = $inputs['status'];
        $user->save();

        $data = [
            'message' => __('message.changeStatusSuccess', ['status' => $inputs['status']]),
        ];

        return $data;
    }
}
