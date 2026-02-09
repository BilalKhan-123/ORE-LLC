<?php

namespace App\Http\Controllers\Api\V1;

use App\Traits\ApiResponser;
use App\Services\AuthService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SwitchLanguage;

/**
 * @tags Auth
 */
class LanguageController extends Controller
{
    use ApiResponser;

    public function __construct(private AuthService $authService)
    {
        //
    }

    /**
     * Switch Language
     */
    public function __invoke(SwitchLanguage $request)
    {
        $data = $this->authService->switchLanguage($request->all());

        return isset($data['errors']) ? $this->error($data) : $this->success($data, 200);
    }
}
