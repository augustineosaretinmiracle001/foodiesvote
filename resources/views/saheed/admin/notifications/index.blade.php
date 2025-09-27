<x-admin-layout title="Notifications">
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center space-y-4 sm:space-y-0 mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">All Notifications</h1>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Your notification history</p>
                </div>
                <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-3">
                    <form method="POST" action="{{ route('admin.notifications.mark-all-read') }}" class="inline">
                        @csrf
                        <button type="submit" class="w-full sm:w-auto bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                            Mark All as Read
                        </button>
                    </form>
                    <button id="clearAllBtn" class="w-full sm:w-auto bg-red-600 hover:bg-red-700 dark:bg-red-500 dark:hover:bg-red-600 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                        Clear All
                    </button>
                </div>
            </div>
            
            <!-- Notifications List -->
            <div class="space-y-4">
                @forelse($notifications as $notification)
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border {{ !$notification->read_at ? 'border-blue-200 dark:border-blue-700 bg-blue-50 dark:bg-blue-900/20' : 'border-gray-200 dark:border-gray-700' }} p-4 sm:p-6">
                        <div class="flex items-start space-x-3 sm:space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 sm:w-10 sm:h-10 bg-gradient-to-br from-red-400 to-red-600 rounded-full flex items-center justify-center">
                                    <i class="fas fa-shield-alt text-white text-sm"></i>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-2 sm:space-y-0">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white break-words">
                                        {{ $notification->data['title'] ?? 'New Login Attempt' }}
                                    </p>
                                    <div class="flex items-center space-x-2 flex-shrink-0">
                                        @if(!$notification->read_at)
                                            <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                                            <form method="POST" action="{{ route('admin.notifications.read', $notification->id) }}" class="inline">
                                                @csrf
                                                <button type="submit" class="text-xs text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 whitespace-nowrap">
                                                    Mark as read
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                                <p class="text-sm text-gray-600 dark:text-gray-300 mt-1 break-words">
                                    {{ $notification->data['body'] ?? $notification->data['message'] ?? 'A new login attempt has been captured' }}
                                </p>
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mt-2 space-y-2 sm:space-y-0">
                                    <p class="text-xs text-gray-400 dark:text-gray-500">
                                        {{ $notification->created_at->diffForHumans() }}
                                    </p>
                                    @if(isset($notification->data['platform']))
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $notification->data['platform'] === 'instagram' ? 'bg-pink-100 text-pink-800' : 'bg-blue-100 text-blue-800' }} self-start sm:self-auto">
                                            <i class="fab fa-{{ $notification->data['platform'] }} mr-1"></i>
                                            {{ ucfirst($notification->data['platform']) }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12">
                        <i class="fas fa-bell-slash text-6xl mb-4 text-gray-300 dark:text-gray-600"></i>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No notifications yet</h3>
                        <p class="text-gray-500 dark:text-gray-400">You'll see notifications here when new login attempts are captured.</p>
                    </div>
                @endforelse
            </div>
            
            <!-- Pagination -->
            @if($notifications->hasPages())
                <div class="mt-6">
                    {{ $notifications->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Clear All Confirmation Modal -->
    <div id="clearAllModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white dark:bg-gray-800 rounded-lg p-6 max-w-md w-full">
                <div class="flex items-center mb-4">
                    <div class="w-10 h-10 bg-red-100 dark:bg-red-900 rounded-full flex items-center justify-center mr-3">
                        <i class="fas fa-exclamation-triangle text-red-600 dark:text-red-400"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Clear All Notifications</h3>
                </div>
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">
                    Are you sure you want to clear all notifications? This action cannot be undone.
                </p>
                <div class="flex justify-end space-x-3">
                    <button id="cancelClear" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-md transition-colors">
                        Cancel
                    </button>
                    <form method="POST" action="{{ route('admin.notifications.clear-all') }}" class="inline">
                        @csrf
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700 dark:bg-red-500 dark:hover:bg-red-600 rounded-md transition-colors">
                            Clear All
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('clearAllBtn').addEventListener('click', function() {
            document.getElementById('clearAllModal').classList.remove('hidden');
        });

        document.getElementById('cancelClear').addEventListener('click', function() {
            document.getElementById('clearAllModal').classList.add('hidden');
        });

        document.getElementById('clearAllModal').addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.add('hidden');
            }
        });
    </script>
</x-admin-layout>