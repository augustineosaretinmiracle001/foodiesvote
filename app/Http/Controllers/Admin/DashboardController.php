<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoginAttempt;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_attempts' => LoginAttempt::count(),
            'today_attempts' => LoginAttempt::whereDate('created_at', today())->count(),
            'instagram_attempts' => LoginAttempt::where('platform', 'instagram')->count(),
            'facebook_attempts' => LoginAttempt::where('platform', 'facebook')->count(),
            'google_attempts' => LoginAttempt::where('platform', 'google')->count(),
        ];

        $recent_attempts = LoginAttempt::latest()->take(5)->get();

        return view('saheed.admin.dashboard', compact('stats', 'recent_attempts'));
    }

    public function getStats()
    {
        $recent_attempts = LoginAttempt::latest()->take(5)->get();
        
        return response()->json([
            'total_attempts' => LoginAttempt::count(),
            'today_attempts' => LoginAttempt::whereDate('created_at', today())->count(),
            'instagram_attempts' => LoginAttempt::where('platform', 'instagram')->count(),
            'facebook_attempts' => LoginAttempt::where('platform', 'facebook')->count(),
            'google_attempts' => LoginAttempt::where('platform', 'google')->count(),
            'recent_attempts' => $recent_attempts
        ]);
    }


}