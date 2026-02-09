<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Traits\ApiResponser;
use App\Services\AuthService;
use App\Services\UserService;
use App\Http\Requests\Auth\Login;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\UpdateProfile;
use App\Http\Requests\Auth\ChangePassword;
use App\Http\Resources\User\Resource as UserResource;

/**
 * @tags Admin
 */
class AuthController extends Controller
{
    use ApiResponser;

    public function __construct(private AuthService $authService, private UserService $userService)
    {
        //
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
     * My Profile
     *
     * To load relationship data pass below values in `include` parameter
     * - Profile
     * - Client Detail
     */
    public function me()
    {
        $user = $this->userService->resource(Auth::id());

        return $this->resource(new UserResource($user));
    }

    /**
     * Update Profile
     */
    public function updateProfile(UpdateProfile $request)
    {
        $data = $this->userService->update(Auth::id(), $request->all());

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
