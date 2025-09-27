console.log('Admin notifications script loaded');

// Admin notifications for real-time updates
document.addEventListener('DOMContentLoaded', function() {
    if (window.Echo) {
        window.Echo.private('admin-notifications')
            .listen('NewLoginAttemptEvent', (e) => {
                console.log('New login attempt received:', e);
                
                // Play notification sound at full volume
                const audio = new Audio('/sounds/notification.mp3');
                audio.volume = 1.0; // 100% volume
                audio.play().catch(err => console.log('Audio play failed:', err));
                
                // Show browser notification
                if (Notification.permission === 'granted') {
                    new Notification('New Login Attempt', {
                        body: e.message,
                        icon: '/favicon.ico'
                    });
                }
                
                // Show Filament notification if available
                if (window.$wire || window.Livewire) {
                    window.dispatchEvent(new CustomEvent('notify', {
                        detail: {
                            type: 'success',
                            title: 'New Login Attempt',
                            message: e.message
                        }
                    }));
                }

                // Update notification count
                const notificationBadge = document.querySelector('[data-notification-count]');
                if (notificationBadge) {
                    const currentCount = parseInt(notificationBadge.textContent) || 0;
                    notificationBadge.textContent = currentCount + 1;
                }

                // Auto-refresh if on login attempts page
                if (window.location.pathname.includes('login-attempts')) {
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                }
            });
    }
    
    // Request notification permission
    if ('Notification' in window && Notification.permission === 'default') {
        Notification.requestPermission();
    }
});