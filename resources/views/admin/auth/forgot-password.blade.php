<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Forgot Password - Admin</title>
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
                bottom: -50%;
                left: -50%;
                width: 500px;
                height: 500px;
                background: rgba(255, 255, 255, 0.03);
                border-radius: 50%;
                animation: float 8s ease-in-out infinite reverse;
            }

            @keyframes float {
                0%, 100% { transform: translateY(0); }
                50% { transform: translateY(-30px); }
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

            .login-brand {
                text-align: center;
                color: white;
                position: relative;
                z-index: 2;
                animation: slideInLeft 0.6s ease-out;
            }

            .brand-icon {
                font-size: 80px;
                margin-bottom: 16px;
                display: block;
                text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            }

            .brand-title {
                font-size: 32px;
                font-weight: 700;
                margin-bottom: 8px;
                letter-spacing: 1px;
            }

            .brand-subtitle {
                font-size: 16px;
                color: rgba(255, 255, 255, 0.85);
                margin-bottom: 40px;
                font-weight: 300;
            }

            .brand-features {
                display: flex;
                flex-direction: column;
                gap: 12px;
                align-items: flex-start;
                max-width: 300px;
                margin: 0 auto;
            }

            .feature-item {
                display: flex;
                align-items: center;
                gap: 10px;
                font-size: 14px;
                color: rgba(255, 255, 255, 0.9);
            }

            .feature-icon {
                width: 24px;
                height: 24px;
                background: rgba(255, 255, 255, 0.2);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 12px;
                color: rgba(255, 255, 255, 0.8);
            }

            .login-right {
                flex: 1;
                background: white;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 40px;
            }

            .login-form-container {
                width: 100%;
                max-width: 420px;
                animation: slideInRight 0.6s ease-out;
            }

            .login-title {
                font-size: 28px;
                font-weight: 700;
                color: #1e3c72;
                margin-bottom: 8px;
            }

            .login-subtitle {
                font-size: 14px;
                color: #666;
                margin-bottom: 30px;
                line-height: 1.5;
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

            .alert-info {
                background-color: #d1ecf1;
                color: #0c5460;
                border-color: #bee5eb;
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
                margin-right: 16px;
            }

            .footer-links a:last-child {
                margin-right: 0;
            }

            .footer-links a:hover {
                color: #1e3c72;
            }

            .info-box {
                background-color: #e7f3ff;
                border-left: 4px solid #2a5298;
                padding: 12px 16px;
                border-radius: 4px;
                margin-bottom: 20px;
                font-size: 13px;
                color: #0c5460;
            }

            .info-box i {
                margin-right: 8px;
                color: #2a5298;
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
                    <h1 class="brand-title">ORE LLC</h1>
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

            <!-- Right Side - Forgot Password Form -->
            <div class="login-right">
                <div class="login-form-container">
                    <h2 class="login-title">Reset Password</h2>
                    <p class="login-subtitle">Enter your email address and we'll send you a link to reset your password.</p>

                    <!-- Info Box -->
                    <div class="info-box">
                        <i class="fas fa-info-circle"></i>
                        Check your email for a password reset link
                    </div>

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

                    <form id="forgotPasswordForm">
                        @csrf

                        <!-- Email Field -->
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                placeholder="admin@example.com"
                                required
                            >
                            <span id="email-error" class="error-text" style="display: none;"></span>
                        </div>

                        <!-- Submit Button -->
                        <button 
                            type="submit" 
                            id="submitBtn"
                            class="login-btn"
                        >
                            <span id="btnText">
                                <i class="fas fa-paper-plane"></i>
                                Send Reset Link
                            </span>
                            <span id="btnLoader" class="spinner" style="display: none;"></span>
                        </button>

                        <!-- Footer Links -->
                        <div class="footer-links">
                            <a href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt"></i> Back to Login
                            </a>
                        </div>
                        <div class="footer-links">
                            <a href="{{ route('home') }}">
                                <i class="fas fa-home"></i> Home
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            document.getElementById('forgotPasswordForm').addEventListener('submit', function (e) {
                e.preventDefault();

                const form = this;
                const btn = document.getElementById('submitBtn');
                const btnText = document.getElementById('btnText');
                const btnLoader = document.getElementById('btnLoader');

                const successBox = document.getElementById('successMessage');
                const successText = document.getElementById('successText');

                const errorBox = document.getElementById('errorMessage');
                const errorText = document.getElementById('errorText');

                const validationBox = document.getElementById('validationErrors');
                const errorsList = document.getElementById('errorsList');

                // Reset UI
                successBox.style.display = 'none';
                errorBox.style.display = 'none';
                validationBox.style.display = 'none';
                errorsList.innerHTML = '';

                document.getElementById('email-error').style.display = 'none';

                // Button loading state
                btn.disabled = true;
                btnText.style.display = 'none';
                btnLoader.style.display = 'inline-block';

                const formData = new FormData(form);

                fetch("{{ route('password.email') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
                        "Accept": "application/json"
                    },
                    body: formData
                })
                .then(async response => {
                    const data = await response.json();
                    if (!response.ok) throw data;
                    return data;
                })
                .then(data => {
                    successText.textContent = data.message ?? 'Password reset link sent successfully! Check your email.';
                    successBox.style.display = 'block';

                    // Clear form
                    form.reset();

                    // Redirect after delay
                    setTimeout(() => {
                        window.location.href = "{{ route('login') }}";
                    }, 3000);
                })
                .catch(error => {
                    if (error.errors) {
                        validationBox.style.display = 'block';
                        Object.keys(error.errors).forEach(field => {
                            error.errors[field].forEach(msg => {
                                errorsList.innerHTML += `<li>${msg}</li>`;
                            });

                            const fieldError = document.getElementById(`${field}-error`);
                            if (fieldError) {
                                fieldError.textContent = error.errors[field][0];
                                fieldError.style.display = 'block';
                            }
                        });
                    }
                    else if (error.message) {
                        errorText.textContent = error.message;
                        errorBox.style.display = 'block';
                    }
                    else {
                        errorText.textContent = 'Something went wrong. Please try again.';
                        errorBox.style.display = 'block';
                    }
                })
                .finally(() => {
                    btn.disabled = false;
                    btnText.style.display = 'inline-flex';
                    btnLoader.style.display = 'none';
                });
            });
        </script>
    </body>
</html>
