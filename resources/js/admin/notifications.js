// Admin notifications for real-time updates
document.addEventListener('DOMContentLoaded', function() {
    const notificationCount = document.getElementById('notification-count');
    const notificationsList = document.getElementById('notifications-list');
    
    if (window.Echo) {
        window.Echo.private('admin-notifications')
            .listen('NewLoginAttemptEvent', (e) => {
                console.log('New login attempt received:', e);
                
                // Play notification sound at full volume
                const audio = new Audio('/sounds/notification.mp3');
                audio.volume = 1.0;
                audio.play().catch(err => console.log('Audio play failed:', err));
                
                // Update notification count
                updateNotificationCount();
                
                // Add notification to dropdown
                addNotificationToList(e);
                
                // Show browser notification
                if (Notification.permission === 'granted') {
                    new Notification('New Login Attempt', {
                        body: e.message,
                        icon: '/favicon.ico'
                    });
                } else if (Notification.permission === 'default') {
                    Notification.requestPermission();
                }
                
                // Refresh table if on login attempts page
                if (window.location.pathname.includes('saheed/admin/login-attempts')) {
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                }
            });
    }
    
    function updateNotificationCount() {
        fetch('/saheed/admin/notifications/count')
            .then(response => response.json())
            .then(data => {
                if (data.count > 0) {
                    notificationCount.textContent = data.count;
                    notificationCount.classList.remove('hidden');
                } else {
                    notificationCount.classList.add('hidden');
                }
            })
            .catch(err => console.log('Failed to update notification count:', err));
    }
    
    function addNotificationToList(event) {
        const notification = document.createElement('div');
        notification.className = 'px-4 py-3 border-b border-gray-200 hover:bg-gray-50';
        notification.innerHTML = `
            <div class="flex items-start space-x-3">
                <div class="flex-shrink-0">
                    <i class="fas fa-shield-alt text-yellow-500"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900">New Login Attempt</p>
                    <p class="text-sm text-gray-500">${event.message}</p>
                    <p class="text-xs text-gray-400">${new Date().toLocaleTimeString()}</p>
                </div>
            </div>
        `;
        
        // Remove "no notifications" message if it exists
        const noNotifications = notificationsList.querySelector('.text-center');
        if (noNotifications) {
            noNotifications.remove();
        }
        
        // Add new notification at the top
        notificationsList.insertBefore(notification, notificationsList.firstChild);
    }
    
    // Initial count load
    updateNotificationCount();
});