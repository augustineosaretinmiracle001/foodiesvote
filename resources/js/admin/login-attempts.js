// Login attempts page specific functionality
document.addEventListener('DOMContentLoaded', function() {
    // Auto-refresh table every 5 seconds
    setInterval(() => {
        if (window.location.pathname.includes('saheed/admin/login-attempts')) {
            const table = document.getElementById('login-attempts-table');
            if (table) {
                // You can implement AJAX refresh here if needed
                // For now, we'll rely on the broadcasting refresh
            }
        }
    }, 5000);
});