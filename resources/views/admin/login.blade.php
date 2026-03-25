<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: 'Inter', 'Segoe UI', sans-serif;
                background: #f8f9fa;
                min-height: 100vh;
            }

            .login-wrapper {
                display: flex;
                min-height: 100vh;
            }

            .login-left {
                flex: 1;
                background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 40px 20px;
                position: relative;
                overflow: hidden;
            }

            .login-left::before {
                content: '';
                position: absolute;
                top: -50%;
                right: -50%;
                width: 500px;
                height: 500px;
                background: rgba(255, 255, 255, 0.05);
                border-radius: 50%;
                animation: float 6s ease-in-out infinite;
            }

            .login-left::after {
                content: '';
                position: absolute;
                bottom: -30%;
                left: -30%;
                width: 400px;
                height: 400px;
                background: rgba(255, 255, 255, 0.05);
                border-radius: 50%;
                animation: float 8s ease-in-out infinite;
            }

            @keyframes float {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(30px); }
            }

            .login-brand {
                position: relative;
                z-index: 2;
                color: white;
                text-align: center;
                max-width: 400px;
            }

            .brand-icon {
                font-size: 80px;
                margin-bottom: 30px;
                display: block;
                animation: slideInLeft 0.6s ease-out;
            }

            @keyframes slideInLeft {
                from {
                    opacity: 0;
                    transform: translateX(-50px);
                }
                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }

            .brand-title {
                font-size: 36px;
                font-weight: 700;
                margin-bottom: 12px;
                animation: slideInLeft 0.6s ease-out 0.1s backwards;
            }

            .brand-subtitle {
                font-size: 16px;
                opacity: 0.9;
                margin-bottom: 30px;
                animation: slideInLeft 0.6s ease-out 0.2s backwards;
            }

            .brand-features {
                display: flex;
                flex-direction: column;
                gap: 15px;
                animation: slideInLeft 0.6s ease-out 0.3s backwards;
            }

            .feature-item {
                display: flex;
                align-items: center;
                gap: 12px;
                font-size: 14px;
            }

            .feature-icon {
                width: 28px;
                height: 28px;
                border-radius: 50%;
                background: rgba(255, 255, 255, 0.2);
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 12px;
            }

            .login-right {
                flex: 1;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 40px 20px;
            }

            .login-form-container {
                width: 100%;
                max-width: 420px;
                animation: slideInRight 0.6s ease-out;
            }

            @keyframes slideInRight {
                from {
                    opacity: 0;
                    transform: translateX(50px);
                }
                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }

            .login-title {
                font-size: 32px;
                font-weight: 700;
                color: #1e3c72;
                margin-bottom: 8px;
            }

            .login-subtitle {
                font-size: 14px;
                color: #666;
                margin-bottom: 30px;
            }

            .form-group {
                margin-bottom: 20px;
            }

            .form-group label {
                display: block;
                margin-bottom: 8px;
                font-weight: 600;
                color: #333;
                font-size: 13px;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            .form-group input {
                width: 100%;
                padding: 12px 16px;
                border: 1px solid #e0e0e0;
                border-radius: 8px;
                font-size: 14px;
                transition: all 0.3s ease;
                background: #fff;
            }

            .form-group input:focus {
                outline: none;
                border-color: #2a5298;
                box-shadow: 0 0 0 3px rgba(42, 82, 152, 0.1);
                background: white;
            }

            .form-group input::placeholder {
                color: #aaa;
            }

            .form-check {
                display: flex;
                align-items: center;
                margin-bottom: 24px;
            }

            .form-check input[type="checkbox"] {
                width: 18px;
                height: 18px;
                cursor: pointer;
                accent-color: #2a5298;
                margin-right: 8px;
            }

            .form-check label {
                margin-bottom: 0;
                font-weight: 500;
                font-size: 13px;
                color: #555;
                cursor: pointer;
                text-transform: none;
                letter-spacing: 0;
            }

            .login-btn {
                width: 100%;
                padding: 13px;
                background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
                color: white;
                border: none;
                border-radius: 8px;
                font-size: 15px;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s ease;
                margin-bottom: 20px;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                letter-spacing: 0.3px;
            }

            .login-btn:hover:not(:disabled) {
                transform: translateY(-2px);
                box-shadow: 0 12px 24px rgba(42, 82, 152, 0.3);
            }

            .login-btn:active:not(:disabled) {
                transform: translateY(0);
            }

            .login-btn:disabled {
                opacity: 0.7;
                cursor: not-allowed;
            }

            .spinner {
                display: inline-block;
                width: 16px;
                height: 16px;
                border: 2px solid rgba(255, 255, 255, 0.3);
                border-radius: 50%;
                border-top-color: white;
                animation: spin 0.8s linear infinite;
            }

            @keyframes spin {
                to { transform: rotate(360deg); }
            }

            .alert {
                border-radius: 8px;
                border: 1px solid;
                font-size: 13px;
                margin-bottom: 20px;
                padding: 12px 16px;
                animation: slideDown 0.3s ease-out;
            }

            @keyframes slideDown {
                from {
                    opacity: 0;
                    transform: translateY(-10px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .alert-success {
                background-color: #d4edda;
                color: #155724;
                border-color: #c3e6cb;
            }

            .alert-danger {
                background-color: #f8d7da;
                color: #721c24;
                border-color: #f5c6cb;
            }

            .alert-warning {
                background-color: #fff3cd;
                color: #856404;
                border-color: #ffeeba;
            }

            .error-text {
                color: #e74c3c;
                font-size: 12px;
                margin-top: 5px;
                display: block;
            }

            .footer-links {
                text-align: center;
                margin-top: 24px;
                padding-top: 24px;
                border-top: 1px solid #e0e0e0;
            }

            .footer-links a {
                color: #2a5298;
                text-decoration: none;
                font-weight: 500;
                font-size: 13px;
                transition: color 0.3s ease;
            }

            .footer-links a:hover {
                color: #1e3c72;
            }

            @media (max-width: 992px) {
                .login-wrapper {
                    flex-direction: column;
                }

                .login-left {
                    padding: 30px 20px;
                    min-height: 300px;
                }

                .brand-icon {
                    font-size: 60px;
                    margin-bottom: 20px;
                }

                .brand-title {
                    font-size: 28px;
                    margin-bottom: 8px;
                }
            }

            @media (max-width: 576px) {
                .login-right {
                    padding: 20px;
                }

                .login-form-container {
                    max-width: 100%;
                }

                .login-title {
                    font-size: 24px;
                }

                .login-left::before,
                .login-left::after {
                    display: none;
                }
            }
        </style>
    </head>
    <body>
        <div class="login-wrapper">
            <!-- Left Side - Branding -->
            <div class="login-left">
                <div class="login-brand">
                    <i class="fas fa-shield-alt brand-icon"></i>
                    <h1 class="brand-title">{{ config('site.siteTitle') }}</h1>
                    <p class="brand-subtitle">Admin Portal</p>
                    
                    <div class="brand-features">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-check"></i>
                            </div>
                            <span>Secure & Reliable</span>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-check"></i>
                            </div>
                            <span>Advanced Security</span>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-check"></i>
                            </div>
                            <span>24/7 Protection</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Login Form -->
            <div class="login-right">
                <div class="login-form-container">
                    <h2 class="login-title">Welcome Back</h2>
                    <p class="login-subtitle">Login to your admin account</p>

                <div class="login-body">
                    <!-- Success Message -->
                    <div id="successMessage" class="alert alert-success" role="alert" style="display: none;">
                        <i class="fas fa-check-circle me-2"></i>
                        <span id="successText"></span>
                    </div>

                    <!-- Error Message -->
                    <div id="errorMessage" class="alert alert-danger" role="alert" style="display: none;">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <span id="errorText"></span>
                    </div>

                    <!-- Validation Errors -->
                    <div id="validationErrors" class="alert alert-warning" role="alert" style="display: none;">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Please fix the following errors:</strong>
                        <ul id="errorsList" class="mb-0 mt-2" style="font-size: 12px; padding-left: 20px;"></ul>
                    </div>

                    <form id="loginForm" action="{{ route('admin.login.post') }}" method="POST">
                        @csrf

                        <!-- Email Field -->
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                placeholder="admin@example.com"
                                value="{{ old('email') }}"
                                required
                            >
                            @error('email')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                placeholder="Enter your password"
                                required
                            >
                            @error('password')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Remember Me Checkbox -->
                        <div class="form-check">
                            <input 
                                type="checkbox" 
                                id="remember" 
                                name="remember"
                                {{ old('remember') ? 'checked' : '' }}
                            >
                            <label for="remember">Keep me logged in</label>
                        </div>

                        <!-- Login Button -->
                        <button 
                            type="submit" 
                            id="loginBtn"
                            class="login-btn"
                        >
                            <span id="btnText">
                                <i class="fas fa-sign-in-alt"></i>
                                Sign In
                            </span>
                            <span id="btnLoader" class="spinner" style="display: none;"></span>
                        </button>

                        <!-- Forgot Password & Footer Links -->
                        {{-- <div class="footer-links">
                            @if (Route::has('admin.password.request'))
                                <a href="{{ route('admin.password.request') }}">
                                    <i class="fas fa-key"></i> Forgot Password?
                                </a>
                            @endif
                        </div> --}}
                        <div class="footer-links">
                            <a href="{{ route('home') }}">
                                <i class="fas fa-home"></i> Home
                            </a>
                        </div>
                    </form>
                </div>  
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            document.getElementById('loginForm').addEventListener('submit', function (e) {
                const btn = document.getElementById('loginBtn');
                const btnText = document.getElementById('btnText');

                // Button loading state
                btn.disabled = true;
                btnText.innerHTML = '<span class="spinner"></span> Logging in...';
            });
        </script>
    </body>
</html>
