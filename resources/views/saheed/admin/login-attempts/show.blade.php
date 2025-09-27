<x-admin-layout title="Login Attempt Details">

<div class="p-6">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Login Attempt Details</h1>
            <p class="text-sm text-gray-600 dark:text-gray-400">View detailed information about this login attempt</p>
        </div>
        <a href="{{ route('admin.login-attempts') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
            <i class="fas fa-arrow-left mr-2"></i>Back to List
        </a>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Platform</label>
                        <div class="flex items-center">
                            @if($attempt->platform === 'facebook')
                                <i class="fab fa-facebook text-blue-600 mr-2"></i>
                            @elseif($attempt->platform === 'instagram')
                                <i class="fab fa-instagram text-pink-600 mr-2"></i>
                            @elseif($attempt->platform === 'google')
                                <i class="fab fa-google text-red-600 mr-2"></i>
                            @endif
                            <span class="text-sm text-gray-900 dark:text-white capitalize">{{ $attempt->platform }}</span>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Identifier</label>
                        <p class="text-sm text-gray-900 dark:text-white">{{ $attempt->email ?? $attempt->username ?? $attempt->phone ?? 'N/A' }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Password</label>
                        <div class="flex items-center">
                            <span id="password-text" class="text-sm text-gray-900 dark:text-white mr-2">••••••••••</span>
                            <button onclick="togglePassword()" class="text-blue-600 hover:text-blue-800 text-sm">
                                <i id="password-icon" class="fas fa-eye"></i>
                            </button>
                        </div>
                        <div id="password-hidden" class="hidden">{{ $attempt->password }}</div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                        @if($attempt->status === 'credentials')
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                        @elseif($attempt->status === 'verification')
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                        @else
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200">
                        @endif
                            {{ ucfirst($attempt->status) }}
                        </span>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">IP Address</label>
                        <p class="text-sm text-gray-900 dark:text-white">{{ $attempt->ip_address }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">User Agent</label>
                        <p class="text-sm text-gray-900 dark:text-white break-all">{{ $attempt->user_agent }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Created At</label>
                        <p class="text-sm text-gray-900 dark:text-white">{{ $attempt->created_at->format('M d, Y h:i A') }}</p>
                    </div>

                    @if($attempt->verification_code)
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Verification Code</label>
                        <p class="text-sm text-gray-900 dark:text-white">{{ $attempt->verification_code }}</p>
                    </div>
                    @endif
                </div>
            </div>

            @if($attempt->verification_code)
            <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Additional Information</h3>
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                    <p class="text-sm text-gray-600 dark:text-gray-400">This login attempt includes a verification code, indicating the user completed the two-factor authentication step.</p>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<script>
function togglePassword() {
    const passwordText = document.getElementById('password-text');
    const passwordIcon = document.getElementById('password-icon');
    const passwordHidden = document.getElementById('password-hidden');
    
    if (passwordText.textContent === '••••••••••') {
        passwordText.textContent = passwordHidden.textContent;
        passwordIcon.className = 'fas fa-eye-slash';
    } else {
        passwordText.textContent = '••••••••••';
        passwordIcon.className = 'fas fa-eye';
    }
}
</script>
</x-admin-layout>