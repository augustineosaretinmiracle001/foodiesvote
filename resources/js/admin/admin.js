// Admin Panel Main JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Initialize sidebar functionality
    initializeSidebar();
    
    // Initialize notifications
    initializeNotifications();
    

    
    // Real-time updates are handled in initializeRealTimeUpdates
});

// Sidebar functionality
function initializeSidebar() {
    const sidebar = document.getElementById('adminSidebar');
    const toggleButton = document.getElementById('adminSidebarToggle');
    const mainContent = document.getElementById('main-content');
    const body = document.body;
    
    if (!sidebar || !toggleButton) return;
    
    // Set initial state
    if (window.innerWidth >= 768) {
        sidebar.classList.add('collapsed');
        sidebar.classList.remove('active');
        if (mainContent) {
            mainContent.style.marginLeft = '70px';
        }
    } else {
        sidebar.classList.remove('collapsed', 'active');
        if (mainContent) {
            mainContent.style.marginLeft = '0';
        }
    }
    
    // Toggle function
    toggleButton.addEventListener('click', function() {
        if (window.innerWidth >= 768) {
            // Desktop: toggle collapsed state
            sidebar.classList.toggle('collapsed');
            // Adjust main content margin
            if (mainContent) {
                if (sidebar.classList.contains('collapsed')) {
                    mainContent.style.marginLeft = '70px';
                } else {
                    mainContent.style.marginLeft = '250px';
                }
            }
        } else {
            // Mobile: toggle active state
            sidebar.classList.toggle('active');
            body.classList.toggle('sidebar-open');
        }
    });
    
    // Handle window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 768) {
            sidebar.classList.remove('active');
            body.classList.remove('sidebar-open');
            // Reset margin for desktop
            if (mainContent) {
                mainContent.style.marginLeft = sidebar.classList.contains('collapsed') ? '70px' : '250px';
            }
        } else {
            sidebar.classList.remove('active', 'collapsed');
            body.classList.remove('sidebar-open');
            if (mainContent) {
                mainContent.style.marginLeft = '0';
            }
        }
    });
    
    // Close sidebar on outside click (mobile)
    document.addEventListener('click', function(event) {
        const isClickInsideSidebar = sidebar.contains(event.target);
        const isClickOnToggleButton = toggleButton.contains(event.target);
        
        if (!isClickInsideSidebar && !isClickOnToggleButton && window.innerWidth < 768) {
            sidebar.classList.remove('active');
            body.classList.remove('sidebar-open');
        }
    });
}

// Initialize notifications
function initializeNotifications() {
    // Initialize real-time updates
    initializeRealTimeUpdates();
}



// Real-time updates
function initializeRealTimeUpdates() {
    let lastNotificationCount = 0;
    
    if (window.Echo) {
        window.Echo.private('admin-notifications')
            .listen('NewLoginAttemptEvent', (e) => {
                playNotificationSound();
                updateNotificationBadge();
                loadRecentNotifications();
                showBrowserNotification('New Login Attempt', e.message);
                refreshPageData();
            });
    }
    
    updateNotificationBadge();
    loadRecentNotifications();
    
    // Auto-refresh every 10 seconds
    setInterval(() => {
        fetch('/saheed/admin/notifications/count')
            .then(response => response.json())
            .then(data => {
                // Only play sound if Echo is not available (fallback)
                if (!window.Echo && data.count > lastNotificationCount && lastNotificationCount > 0) {
                    playNotificationSound();
                }
                lastNotificationCount = data.count;
                updateNotificationBadge();
                loadRecentNotifications();
                refreshPageData();
            })
            .catch(err => console.log('Failed to check notifications:', err));
    }, 10000);
}

// Play notification sound
function playNotificationSound() {
    try {
        const audio = new Audio('/sounds/notification.mp3');
        audio.volume = 0.5;
        audio.play().catch(err => console.log('Audio play failed:', err));
    } catch (error) {
        console.log('Could not play notification sound:', error);
    }
}

// Update notification badge
function updateNotificationBadge() {
    const badge = document.getElementById('notification-count');
    if (!badge) return;
    
    fetch('/saheed/admin/notifications/count')
        .then(response => response.json())
        .then(data => {
            if (data.count > 0) {
                badge.textContent = data.count;
                badge.style.display = 'flex';
                badge.classList.add('animate-bounce');
            } else {
                badge.style.display = 'none';
                badge.classList.remove('animate-bounce');
            }
        })
        .catch(err => console.log('Failed to update notification count:', err));
}

// Load recent notifications
function loadRecentNotifications() {
    fetch('/saheed/admin/notifications/recent')
        .then(response => response.json())
        .then(data => {
            const notificationsList = document.getElementById('notifications-list');
            if (notificationsList) {
                if (data.notifications && data.notifications.length > 0) {
                    notificationsList.innerHTML = '';
                    data.notifications.forEach(notification => {
                        addNotificationToDropdown(notification);
                    });
                } else {
                    notificationsList.innerHTML = `
                        <div class="px-4 py-8 text-sm text-gray-500 text-center">
                            <i class="fas fa-bell-slash text-2xl mb-2 text-gray-300"></i>
                            <p>No new notifications</p>
                        </div>
                    `;
                }
            }
        })
        .catch(err => console.log('Failed to load notifications:', err));
}

// Add notification to dropdown
function addNotificationToDropdown(notification) {
    const notificationsList = document.getElementById('notifications-list');
    if (!notificationsList) return;
    
    const notificationElement = document.createElement('div');
    notificationElement.className = `p-3 border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 ${!notification.read_at ? 'bg-blue-50 dark:bg-blue-900' : ''}`;
    notificationElement.setAttribute('data-notification-id', notification.id);
    
    const body = notification.data?.body || 'A new login attempt has been captured';
    const title = notification.data?.title || 'New Login Attempt';
    const truncatedBody = body.length > 50 ? body.substring(0, 50) + '...' : body;
    
    notificationElement.innerHTML = `
        <div class="flex items-start justify-between">
            <div class="flex items-start flex-1 cursor-pointer" onclick="window.location.href='/saheed/admin/notifications'">
                <div class="flex-shrink-0 pt-0.5">
                    <i class="fas fa-shield-alt text-red-500"></i>
                </div>
                <div class="ml-3 flex-1">
                    <p class="text-sm font-medium text-gray-900 dark:text-white">${title}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">${truncatedBody}</p>
                    <p class="text-xs text-gray-400">${timeAgo(notification.created_at)}</p>
                </div>
                ${!notification.read_at ? '<div class="w-2 h-2 bg-blue-500 rounded-full ml-2 mt-2"></div>' : ''}
            </div>

        </div>
    `;
    
    notificationsList.appendChild(notificationElement);
}

// Time ago helper
function timeAgo(dateString) {
    const date = new Date(dateString);
    const now = new Date();
    const diffInSeconds = Math.floor((now - date) / 1000);
    
    if (diffInSeconds < 60) return 'Just now';
    if (diffInSeconds < 3600) return `${Math.floor(diffInSeconds / 60)}m ago`;
    if (diffInSeconds < 86400) return `${Math.floor(diffInSeconds / 3600)}h ago`;
    return `${Math.floor(diffInSeconds / 86400)}d ago`;
}

// Mark all notifications as read
function markAllNotificationsAsRead() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]');
    if (!csrfToken) return;
    
    fetch('/saheed/admin/notifications/mark-all-read', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken.content,
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            updateNotificationBadge();
            loadRecentNotifications();
        }
    })
    .catch(err => console.log('Failed to mark notifications as read:', err));
}

// Mark single notification as read
function markSingleNotificationAsRead(notificationId, event) {
    event.stopPropagation();
    const csrfToken = document.querySelector('meta[name="csrf-token"]');
    if (!csrfToken) return;
    
    fetch(`/saheed/admin/notifications/${notificationId}/mark-read`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken.content,
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update the specific notification in dropdown
            const notificationElement = document.querySelector(`[data-notification-id="${notificationId}"]`);
            if (notificationElement) {
                notificationElement.classList.remove('bg-blue-50', 'dark:bg-blue-900');
                const markReadBtn = notificationElement.querySelector('button');
                const blueDot = notificationElement.querySelector('.w-2.h-2.bg-blue-500');
                if (markReadBtn) markReadBtn.remove();
                if (blueDot) blueDot.remove();
            }
            updateNotificationBadge();
        }
    })
    .catch(err => console.log('Failed to mark notification as read:', err));
}

// Show browser notification
function showBrowserNotification(title, body) {
    if (Notification.permission === 'granted') {
        new Notification(title, { body: body, icon: '/favicon.ico' });
    } else if (Notification.permission === 'default') {
        Notification.requestPermission().then(permission => {
            if (permission === 'granted') {
                new Notification(title, { body: body, icon: '/favicon.ico' });
            }
        });
    }
}

// Refresh page data
function refreshPageData() {
    const currentPath = window.location.pathname;
    
    if (currentPath.includes('dashboard')) {
        refreshDashboardStats();
    } else if (currentPath.includes('login-attempts')) {
        refreshLoginAttemptsTable();
    }
}

// Refresh dashboard stats
function refreshDashboardStats() {
    fetch('/saheed/admin/dashboard/stats')
        .then(response => response.json())
        .then(data => {
            // Map API keys to element IDs
            const statMapping = {
                'total_attempts': 'total-attempts',
                'today_attempts': 'today-attempts', 
                'instagram_attempts': 'instagram-attempts',
                'facebook_attempts': 'facebook-attempts',
                'google_attempts': 'google-attempts'
            };
            
            Object.keys(statMapping).forEach(key => {
                const elementId = statMapping[key];
                const element = document.getElementById(elementId);
                if (element && data[key] !== undefined && element.textContent !== data[key].toString()) {
                    element.textContent = data[key];
                    element.classList.add('animate-pulse');
                    setTimeout(() => element.classList.remove('animate-pulse'), 1000);
                }
            });
            
            // Update recent attempts table
            const recentTable = document.querySelector('#recent-attempts-table tbody');
            if (recentTable && data.recent_attempts) {
                recentTable.innerHTML = '';
                data.recent_attempts.forEach(attempt => {
                    const row = document.createElement('tr');
                    let platformIcon = '';
                    if (attempt.platform === 'instagram') {
                        platformIcon = '<i class="fab fa-instagram text-pink-600 mr-2"></i>';
                    } else if (attempt.platform === 'google') {
                        platformIcon = '<i class="fab fa-google text-red-600 mr-2"></i>';
                    } else {
                        platformIcon = '<i class="fab fa-facebook text-blue-600 mr-2"></i>';
                    }
                    
                    row.innerHTML = `
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                            <div class="flex items-center">
                                ${platformIcon}
                                ${attempt.platform.charAt(0).toUpperCase() + attempt.platform.slice(1)}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">${attempt.email || attempt.username || attempt.phone || 'N/A'}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">${attempt.ip_address}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">${timeAgo(attempt.created_at)}</td>
                    `;
                    recentTable.appendChild(row);
                });
            }
        })
        .catch(err => console.log('Failed to refresh stats:', err));
}

// Refresh login attempts table
function refreshLoginAttemptsTable() {
    const attemptsContainer = document.getElementById('attemptsContainer');
    if (!attemptsContainer) return;
    
    const currentUrl = new URL(window.location);
    currentUrl.searchParams.set('ajax', '1');
    
    fetch(currentUrl.toString())
        .then(response => response.json())
        .then(data => {
            if (data.html) {
                attemptsContainer.innerHTML = data.html;
                maintainSelections();
            }
        })
        .catch(err => console.log('Failed to refresh login attempts:', err));

    function maintainSelections() {
        const selected = document.querySelectorAll('.attempt-checkbox:checked');
        selected.forEach(cb => {
            cb.closest('tr').classList.add('bg-blue-50', 'dark:bg-blue-900');
        });
        updateBulkActions();
    }

    function updateBulkActions() {
        const selected = document.querySelectorAll('.attempt-checkbox:checked');
        const bulkActions = document.getElementById('bulkActions');
        const selectedCount = document.getElementById('selectedCount');
        
        if (selected.length > 0) {
            bulkActions.classList.remove('hidden');
            selectedCount.textContent = selected.length;
        } else {
            bulkActions.classList.add('hidden');
        }
    }
}

// Request notification permission
if ('Notification' in window && Notification.permission === 'default') {
    Notification.requestPermission();
}