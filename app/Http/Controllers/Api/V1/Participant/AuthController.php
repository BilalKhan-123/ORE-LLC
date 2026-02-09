<?php

namespace App\Http\Controllers\Api\V1\Participant;

use App\Traits\ApiResponser;
use App\Services\AuthService;
use App\Http\Requests\Auth\Login;
use App\Http\Controllers\Controller;

/**
 * @tags Participant
 */
class AuthController extends Controller
{
    use ApiResponser;

    public function __construct(private AuthService $authService)
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
}
