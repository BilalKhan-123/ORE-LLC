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
