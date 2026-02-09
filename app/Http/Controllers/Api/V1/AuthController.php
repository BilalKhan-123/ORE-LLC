<?php

namespace App\Http\Controllers\Api\V1;

use App\Traits\ApiResponser;
use App\Services\AuthService;
use App\Http\Requests\Auth\Login;
use App\Http\Requests\Auth\SignUp;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPassword;
use App\Http\Requests\Auth\ChangePassword;
use App\Http\Requests\Auth\ForgetPassword;

class AuthController extends Controller
{
    use ApiResponser;

    public function __construct(private AuthService $authService)
    {
        //
    }

    /**
     * Register
     */
    public function signUp(SignUp $request)
    {
        $data = $this->authService->signup($request->all());

        return isset($data['errors']) ? $this->error($data) : $this->success($data, 200);
    }

    /**
     * Login
     */
    public function login(Login $request)
    {
        $data = $this->authService->login($request->all());

        return isset($data['errors']) ? $this->error($data) : $this->success($data, 200);
    }

    /**
     * Forget Password
     */
    public function forgetPassword(ForgetPassword $request)
    {
        $data = $this->authService->forgetPassword($request->all());

        return isset($data['errors']) ? $this->error($data) : $this->success($data, 200);
    }

    /**
     * Reset Password
     */
    public function resetPassword(ResetPassword $request)
    {
        $data = $this->authService->resetPassword($request->all());

        return isset($data['errors']) ? $this->error($data) : $this->success($data, 200);
    }

    /**
     * Change Password
     */
    public function changePassword(ChangePassword $request)
    {
        $data = $this->authService->changePassword($request->all());

        return isset($data['errors']) ? $this->error($data) : $this->success($data, 200);
    }

    /**
     * Logout
     */
    public function logout()
    {
        $data = $this->authService->logout();

        return isset($data['errors']) ? $this->error($data) : $this->success($data, 200);
    }
}
