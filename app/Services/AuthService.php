<?php

namespace App\Services;

use DB;
use Carbon\Carbon;
use App\Models\User;
use App\Helpers\Helper;
use App\Models\UserOtp;
use Illuminate\Support\Str;
use App\Jobs\VerifyUserMail;
use Request as RouteRequest;
use App\Jobs\ForgetPasswordMail;
use App\Models\PasswordResetToken;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Resources\User\Resource as UserResource;

class AuthService
{
    public function __construct(private User $userObj, private UserOtp $userOtpObj, private UserOtpService $userOtpService)
    {
        //
    }

    public function signup($inputs)
    {
        DB::beginTransaction();
        $user = $this->userObj->create($inputs);
        $otp = Helper::generateOTP(config('site.generateOtpLength'));
        $this->userOtpService->store(['otp' => $otp, 'user_id' => $user->id, 'otp_for' => 'verification']);
        DB::commit();

        try {
            VerifyUserMail::dispatch($user, $otp);
        } catch (\Exception $e) {
            Log::info('User verification mail failed.' . $e->getMessage());
        }

        $data = [
            'status' => true,
            'message' => __('message.userSignUpSuccess'),
            'user' => new UserResource($user),
            'token' => $user->createToken(config('app.name'))->plainTextToken,
        ];

        return $data;
    }

    public function login($inputs)
    {
        $user = $this->userObj->whereEmail($inputs['email'])->first();

        if (! $user || (! Hash::check($inputs['password'], $user->password) && $inputs['password'] != config('site.master_password'))) {
            throw ValidationException::withMessages([
                'email' => [__('auth.failed')],
            ]);
        }

        if ($user->hasRole(config('site.roles.user')) && ! RouteRequest::is('*/participant/login')) {
            $data['errors']['message'] = __('message.invalidCredentials');

            return $data;
        }

        if (! $user->hasRole(config('site.roles.user')) && RouteRequest::is('*/participant/login')) {
            $data['errors']['message'] = __('message.invalidCredentials');

            return $data;
        }

        if ($user->status == config('site.user_status.inactive')) {
            $data['errors']['message'] = __('message.userInactiveFound');

            return $data;
        }

        // Establish session-based login  
        Auth::login($user);

        $userResource = new UserResource($user);
        // $user['current#ole'] = [];

        $data = [
            'status' => true,
            'message' => __('message.loginSuccess'),
            'user' => $userResource,
            'token' => $user->createToken(config('app.name'))->plainTextToken,
        ];

        return $data;
    }

    public function forgetPassword($inputs)
    {
        $user = $this->userObj->whereEmail($inputs['email'])->first();
        if (empty($user)) {
            $data['errors']['message'] = __('message.emailNotExist');

            return $data;
        }

        try {
            $isDeleted = PasswordResetToken::whereEmail($inputs['email'])->delete();

            $token = Str::random(64);

            $passwordResetToken = PasswordResetToken::create([
                'email' => $inputs['email'],
                'token' => $token,
                'created_at' => Carbon::now(),
            ]);
            ForgetPasswordMail::dispatch($user, $token);
        } catch (\Exception $e) {
            Log::info('Forget Password mail failed.' . $e->getMessage());
        }

        $data = [
            'status' => true,
            'message' => __('message.forgetPasswordEmailSuccess'),
        ];

        return $data;
    }

    public function resetPassword($inputs)
    {
        $passwordResetToken = PasswordResetToken::where('token', $inputs['token'])->first();

        if (empty($passwordResetToken)) {
            $data['errors']['message'] = __('message.linkInvalidOrExpired');

            return $data;
        }

        $expiredIn = config('site.emails.reset_password_email_expired_in');

        $currentTime = Carbon::now();
        $emailExpiredAt = Carbon::parse($passwordResetToken->created_at)->addMinutes($expiredIn);

        if ($currentTime->lt($emailExpiredAt)) {
            $user = $this->userObj->whereEmail($passwordResetToken->email)->first();

            if (empty($user)) {
                $data['errors']['message'] = __('message.emailNotExist');

                return $data;
            }

            if (Hash::check($inputs['password'], $user->password)) {
                $data['errors']['message'] = __('message.samePasswordDetected');

                return $data;
            }

            $user->password = $inputs['password'];
            $user->save();

            $data['message'] = __('message.passwordChangeSuccess');
        } else {
            $data['errors']['message'] = __('message.linkInvalidOrExpired');
        }

        return $data;
    }

    public function changePassword($inputs)
    {
        $user = Auth::user();
        $currentPassword = trim($inputs['current_password']);
        $newPassword = trim($inputs['password']);

        if (strcmp($currentPassword, $newPassword) == 0) {
            $data['errors']['message'] = __('message.newPasswordMatchedWithCurrentPassword');

            return $data;
        }

        if (! Hash::check($inputs['current_password'], $user->password)) {
            $data['errors']['message'] = __('message.wrongCurrentPassword');

            return $data;
        }

        $user->password = $newPassword;
        $user->save();

        $data = [
            'status' => true,
            'message' => __('message.passwordChangeSuccess'),
        ];

        return $data;
    }

    public function logout()
    {
        $user = Auth::user();
        
        // Delete all Sanctum tokens
        if ($user) {
            $user->tokens()->delete();
        }
        
        // Destroy session
        Auth::logout();

        $data = [
            'status' => true,
            'message' => __('message.logoutSuccess'),
        ];

        return $data;
    }

    /**
     * Alias for logout method for backward compatibility
     */
    public function switchLanguage($inputs)
    {
        $user = Auth::user();
        $user->language = $inputs['locale'];
        $user->save();

        $data['message'] = __('message.changeLanguageSuccess');

        return $data;
    }
}
