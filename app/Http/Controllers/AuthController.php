<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Traits\ApiResponser;
use App\Services\AuthService;
use App\Services\UserService;
use App\Http\Requests\Auth\Login;
use App\Http\Requests\Auth\SignUp;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPassword;
use App\Http\Requests\Auth\ChangePassword;
use App\Http\Requests\Auth\ForgetPassword;

class AuthController extends Controller
{

    use ApiResponser;       
    
    public function __construct(private AuthService $authService, private UserService $userService)
    {
        //
    }
    /**
     * Show the login form
     */
    public function showLogin()
    {
        return view('admin.login');
    }

    // /**
    //  * Handle login request
    //  */
    // public function login(Request $request)
    // {
    //     $credentials = $request->validate([
    //         'email' => ['required', 'email'],
    //         'password' => ['required', 'string', 'min:6'],
    //     ]);

    //     if (Auth::attempt($credentials, $request->boolean('remember'))) {
    //         $request->session()->regenerate();

    //         if ($request->wantsJson()) {
    //             return response()->json([
    //                 'message' => 'Login successful',
    //                 'redirect' => route('home'),
    //             ], 200);
    //         }

    //         return redirect()->intended(route('home'));
    //     }

    //     if ($request->wantsJson()) {
    //         return response()->json([
    //             'message' => 'Invalid email or password',
    //         ], 401);
    //     }

    //     throw ValidationException::withMessages([
    //         'email' => __('auth.failed'),
    //     ]);
    // }

    //  /**
    //  * Register
    //  */
    // public function signUp(SignUp $request)
    // {
    //     $data = $this->authService->signup($request->all());

    //     return isset($data['errors']) ? $this->error($data) : $this->success($data, 200);
    // }

    /**
     * Login
     */
    public function login(Login $request)
    {
        $data = $this->authService->login($request->all());
        
        return isset($data['errors']) ? $this->error($data) : $this->success($data, 200);
    }

    /**
     * Show the registration form
     */
    public function showRegister()
    {
        return view('admin.register');
    }

    /**
     * Handle registration request
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'terms' => ['required', 'accepted'],
        ], [
            'email.unique' => 'This email is already registered.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.confirmed' => 'Passwords do not match.',
            'terms.accepted' => 'You must accept the terms and conditions.',
        ]);

        try {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            Auth::login($user);
            $request->session()->regenerate();

            if ($request->wantsJson()) {
                return response()->json([
                    'message' => 'Account created successfully',
                    'redirect' => route('home'),
                ], 201);
            }

            return redirect(route('home'))->with('success', 'Account created successfully!');
        } catch (\Exception $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'message' => 'Error creating account. Please try again.',
                ], 500);
            }

            throw ValidationException::withMessages([
                'email' => 'Error creating account. Please try again.',
            ]);
        }
    }

    /**
     * Show forgot password form
     */
    public function showForgotPassword()
    {
        return view('admin.auth.passwords.reset');
    }

    // /**
    //  * Handle password reset email request
    //  */
    // public function sendPasswordResetLink(Request $request)
    // {
    //     $request->validate(['email' => 'required|email']);

    //     $status = Password::sendResetLink(
    //         $request->only('email')
    //     );

    //     if ($status === Password::RESET_LINK_SENT) {
    //         if ($request->wantsJson()) {
    //             return response()->json([
    //                 'message' => 'Password reset link sent to your email',
    //             ], 200);
    //         }
    //         return back()->with('status', __($status));
    //     }

    //     if ($request->wantsJson()) {
    //         return response()->json([
    //             'message' => 'Email address not found',
    //         ], 404);
    //     }

    //     throw ValidationException::withMessages([
    //         'email' => __($status),
    //     ]);
    // }

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
        $this->authService->logout();
        
        return redirect(route('login'))->with('success', __('message.logoutSuccess'));
    }

    /**
     * Show home page
     */
    public function home()
    {
        return view('admin.home');
    }
}
