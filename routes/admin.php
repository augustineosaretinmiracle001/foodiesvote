<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginAttemptController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ThemeController;
use App\Http\Controllers\NotificationController as BaseNotificationController;
use Illuminate\Support\Facades\Route;

// Admin root route - check authentication
Route::get('/', function() {
    if (auth('admin')->check()) {
        return redirect()->route('admin.dashboard');
    }
    return app(AuthController::class)->showLogin();
})->name('admin.home');

// Admin Authentication Routes
Route::middleware('guest:admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    // amazon-q-ignore[php-csrf-missing-protection-ide]
    Route::post('/login', [AuthController::class, 'login'])->name('admin.login');
});

// Admin Broadcasting Auth
// amazon-q-ignore[php-csrf-missing-protection-ide]
Route::post('/broadcasting/auth', function (\Illuminate\Http\Request $request) {
    return \Illuminate\Support\Facades\Broadcast::auth($request);
})->middleware('auth:admin');

// Admin Protected Routes
Route::middleware('auth:admin')->group(function () {
    // amazon-q-ignore[php-csrf-missing-protection-ide]
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/dashboard/stats', [DashboardController::class, 'getStats'])->name('admin.dashboard.stats');
    Route::get('/login-attempts', [LoginAttemptController::class, 'index'])->name('admin.login-attempts');
    Route::get('/login-attempts/{attempt}', [LoginAttemptController::class, 'show'])->name('admin.login-attempts.show');
    // amazon-q-ignore[php-csrf-missing-protection-ide]
    Route::delete('/login-attempts/{attempt}', [LoginAttemptController::class, 'destroy'])->name('admin.login-attempts.destroy');
    // amazon-q-ignore[php-csrf-missing-protection-ide]
    Route::post('/login-attempts/bulk-delete', [LoginAttemptController::class, 'bulkDelete'])->name('admin.login-attempts.bulk-delete');
    
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profile');
    // amazon-q-ignore[php-csrf-missing-protection-ide]
    Route::post('/profile/update-field', [ProfileController::class, 'updateField'])->name('admin.profile.update-field');
    
    // Admin Notification Routes
    Route::get('/notifications', [NotificationController::class, 'index'])->name('admin.notifications.index');
    Route::get('/notifications/api', [BaseNotificationController::class, 'getNotifications'])->name('admin.notifications.api');
    Route::get('/notifications/count', [NotificationController::class, 'getCount'])->name('admin.notifications.count');
    Route::get('/notifications/recent', [NotificationController::class, 'getRecent'])->name('admin.notifications.recent');
    // amazon-q-ignore[php-csrf-missing-protection-ide]
    Route::post('/notifications/{id}/mark-read', [NotificationController::class, 'markAsRead'])->name('admin.notifications.mark-read');
    // amazon-q-ignore[php-csrf-missing-protection-ide]
    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('admin.notifications.mark-all-read');
    // amazon-q-ignore[php-csrf-missing-protection-ide]
    Route::post('/notifications/clear-all', [NotificationController::class, 'clearAll'])->name('admin.notifications.clear-all');
    
    // Theme update
    // amazon-q-ignore[php-csrf-missing-protection-ide]
    Route::post('/theme', [ThemeController::class, 'update'])->name('admin.theme.update');
});