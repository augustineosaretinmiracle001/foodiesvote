<header class="bg-white shadow-sm dark:bg-gray-800">
    <style>
        .header-shadow {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .dark .header-shadow {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: #ef4444;
            color: white;
            border-radius: 9999px;
            height: 20px;
            width: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: 600;
        }
    </style>

    <div class="flex items-center justify-between p-4">
        <div class="flex items-center gap-4">
            <button id="adminSidebarToggle" class="p-2 text-gray-600 transition-colors rounded dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                <i class="text-xl fas fa-bars"></i>
            </button>
            <h1 class="text-lg font-semibold text-gray-900 dark:text-white">Your Portal</h1>
        </div>
        <div class="flex items-center gap-4">
            <div class="relative">
                <button id="adminNotificationButton" class="relative p-2 text-gray-600 transition-colors rounded-full dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                    <i class="fas fa-bell"></i>
                    <span class="notification-badge" style="display: flex">
                        2
                    </span>
                </button>
                <div id="adminNotificationDropdown" class="absolute right-0 z-50 hidden mt-2 bg-white border border-gray-200 rounded-md shadow-lg w-80 dark:bg-gray-800 dark:border-gray-700">
                    <div class="p-3 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="font-medium text-gray-900 dark:text-white">Portal Notifications</h3>
                    </div>
                    <div class="overflow-y-auto max-h-96">
                        <div class="p-3 border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 pt-0.5">
                                    <i class="text-green-500 fas fa-user-plus"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">New User Registration</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">A new user has joined the platform.</p>
                                    <p class="text-xs text-gray-400">5 minutes ago</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-3 border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 pt-0.5">
                                    <i class="text-yellow-500 fas fa-coins"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">New Transaction</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Coin package purchase pending approval.</p>
                                    <p class="text-xs text-gray-400">1 hour ago</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-2 text-center border-t border-gray-200 dark:border-gray-700">
                        <a href="#" class="text-sm text-blue-600 dark:text-blue-400 hover:underline">View all</a>
                    </div>
                </div>
            </div>
            <div class="relative">
                <button id="adminProfileButton" class="flex items-center p-1 transition-colors rounded-full hover:bg-gray-100 dark:hover:bg-gray-700">
                    <img class="w-8 h-8 transition-all rounded-full hover:ring-2 hover:ring-blue-500" src="https://ui-avatars.com/api/?name={{ urlencode(auth('admin')->user()->name) }}&background=6366f1&color=fff" alt="{{ auth('admin')->user()->name }}">
                </button>
                <div id="adminProfileDropdown" class="absolute right-0 z-50 hidden w-48 mt-2 bg-white border border-gray-200 rounded-md shadow-lg dark:bg-gray-800 dark:border-gray-700">
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center w-full gap-2 px-4 py-2 text-sm text-left text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <i class="fas fa-sign-out-alt"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const notificationButton = document.getElementById('adminNotificationButton');
            const notificationDropdown = document.getElementById('adminNotificationDropdown');

            const profileButton = document.getElementById('adminProfileButton');
            const profileDropdown = document.getElementById('adminProfileDropdown');

            notificationButton.addEventListener('click', function() {
                notificationDropdown.classList.toggle('hidden');
                profileDropdown.classList.add('hidden');
            });

            profileButton.addEventListener('click', function() {
                profileDropdown.classList.toggle('hidden');
                notificationDropdown.classList.add('hidden');
            });

            document.addEventListener('click', function(event) {
                if (!notificationButton.contains(event.target) && !notificationDropdown.contains(event.target)) {
                    notificationDropdown.classList.add('hidden');
                }
                if (!profileButton.contains(event.target) && !profileDropdown.contains(event.target)) {
                    profileDropdown.classList.add('hidden');
                }
            });
        });
    </script>
    @endpush
</header>
