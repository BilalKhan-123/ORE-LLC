<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login</title>

        @include('includes.header-links')
        
    </head>
    <body class="antialiased">
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
            <div class="max-w-7xl mx-auto p-12 lg:p-8">
                <div class="flex justify-center">
                    <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-lg p-8 w-full max-w-md">
                        <h2 class="text-2xl font-semibold text-center text-gray-900 dark:text-white mb-8">
                            Login to Your Account
                        </h2>

                        <!-- Success Message -->
                        <div id="successMessage" class="hidden mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                            <p id="successText"></p>
                        </div>

                        <!-- Error Message -->
                        <div id="errorMessage" class="hidden mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                            <p id="errorText"></p>
                        </div>

                        <!-- Validation Errors -->
                        <div id="validationErrors" class="hidden mb-4 p-4 bg-yellow-50 border border-yellow-400 rounded">
                            <ul id="errorsList" class="list-disc list-inside text-sm text-yellow-700"></ul>
                        </div>

                        <form id="loginForm" class="space-y-6">
                            @csrf

                            <!-- Email Field -->
                            <div>
                                <label for="email" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    Email Address
                                </label>
                                <input 
                                    type="email" 
                                    id="email" 
                                    name="email" 
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-2 focus:outline-red-500 dark:bg-gray-700 dark:text-white transition-all"
                                    placeholder="Enter your email"
                                    required
                                >
                                <span id="email-error" class="text-sm text-red-500 mt-1 block hidden"></span>
                            </div>

                            <!-- Password Field -->
                            <div>
                                <label for="password" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    Password
                                </label>
                                <input 
                                    type="password" 
                                    id="password" 
                                    name="password" 
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-2 focus:outline-red-500 dark:bg-gray-700 dark:text-white transition-all"
                                    placeholder="Enter your password"
                                    required
                                >
                                <span id="password-error" class="text-sm text-red-500 mt-1 block hidden"></span>
                            </div>

                            <!-- Remember Me Checkbox -->
                            <div class="flex items-center">
                                <input 
                                    type="checkbox" 
                                    id="remember" 
                                    name="remember" 
                                    class="w-4 h-4 text-red-500 border-gray-300 rounded focus:ring-red-500"
                                >
                                <label for="remember" class="ml-2 text-sm text-gray-700 dark:text-gray-300">
                                    Remember me
                                </label>
                            </div>

                            <!-- Login Button -->
                            <button 
                                type="submit" 
                                id="loginBtn"
                                class="w-full bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-lg transition-all motion-safe:hover:scale-[1.01] flex items-center justify-center"
                            >
                                <span id="btnText">Login</span>
                                <span id="btnLoader" class="hidden ml-2">
                                    <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </span>
                            </button>
                        </form>

                        <!-- Footer Links -->
                        <div class="mt-6 text-center space-y-2">
                            @if (Route::has('admin.password.request'))
                                <p class="text-sm">
                                    <a href="{{ route('admin.password.request') }}" class="text-red-500 hover:text-red-600 font-semibold">Forgot your password?</a>
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- AJAX Script -->
        <script>
                document.getElementById('loginForm').addEventListener('submit', function (e) {
                    e.preventDefault();

                    // Elements
                    const form = this;
                    const btn = document.getElementById('loginBtn');
                    const btnText = document.getElementById('btnText');
                    const btnLoader = document.getElementById('btnLoader');

                    const successBox = document.getElementById('successMessage');
                    const successText = document.getElementById('successText');

                    const errorBox = document.getElementById('errorMessage');
                    const errorText = document.getElementById('errorText');

                    const validationBox = document.getElementById('validationErrors');
                    const errorsList = document.getElementById('errorsList');

                    // Reset UI
                    successBox.classList.add('hidden');
                    errorBox.classList.add('hidden');
                    validationBox.classList.add('hidden');
                    errorsList.innerHTML = '';

                    document.getElementById('email-error').classList.add('hidden');
                    document.getElementById('password-error').classList.add('hidden');

                    // Button loading state
                    btn.disabled = true;
                    btnText.textContent = 'Logging in...';
                    btnLoader.classList.remove('hidden');

                    // Form data
                    const formData = new FormData(form);

                    fetch("{{ route('admin.login') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
                            "Accept": "application/json"
                        },
                        body: formData
                    })
                    .then(async response => {
                        const data = await response.json();

                        if (!response.ok) {
                            throw data;
                        }

                        return data;
                    })
                    .then(data => {
                        // Success
                        successText.textContent = data.message ?? 'Login successful';
                        successBox.classList.remove('hidden');

                        setTimeout(() => {
                            window.location.href = data.redirect ?? '/home';
                        }, 1000);
                    })
                    .catch(error => {
                        // Validation errors
                        if (error.errors) {
                            validationBox.classList.remove('hidden');

                            Object.keys(error.errors).forEach(field => {
                                error.errors[field].forEach(msg => {
                                    errorsList.innerHTML += `<li>${msg}</li>`;
                                });

                                const fieldError = document.getElementById(`${field}-error`);
                                if (fieldError) {
                                    fieldError.textContent = error.errors[field][0];
                                    fieldError.classList.remove('hidden');
                                }
                            });
                        }
                        // Auth / other errors
                        else if (error.message) {
                            errorText.textContent = error.message;
                            errorBox.classList.remove('hidden');
                        }
                        else {
                            errorText.textContent = 'Something went wrong. Please try again.';
                            errorBox.classList.remove('hidden');
                        }
                    })
                    .finally(() => {
                        btn.disabled = false;
                        btnText.textContent = 'Login';
                        btnLoader.classList.add('hidden');
                    });
                });
        </script>

        
       @include('includes.footer-links')
    </body>
</html>
