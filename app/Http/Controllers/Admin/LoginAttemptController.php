<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoginAttempt;
use Illuminate\Http\Request;

class LoginAttemptController extends Controller
{
    public function index(Request $request)
    {
        $query = LoginAttempt::query();

        // Filter by platform
        if ($request->filled('platform')) {
            $query->where('platform', $request->platform);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('platform', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%')
                  ->orWhere('username', 'like', '%' . $search . '%')
                  ->orWhere('phone', 'like', '%' . $search . '%')
                  ->orWhere('ip_address', 'like', '%' . $search . '%');
            });
        }

        // Date range filter
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $attempts = $query->latest()->paginate(20);

        if ($request->ajax()) {
            return response()->json([
                'html' => view('saheed.admin.login-attempts.partials.attempts-table', compact('attempts'))->render()
            ]);
        }

        return view('saheed.admin.login-attempts.index', compact('attempts'));
    }

    public function destroy(LoginAttempt $attempt)
    {
        $attempt->delete();
        return back()->with('success', 'Login attempt deleted successfully.');
    }

    public function show(LoginAttempt $attempt)
    {
        return view('saheed.admin.login-attempts.show', compact('attempt'));
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:login_attempts,id'
        ]);

        LoginAttempt::whereIn('id', $request->ids)->delete();

        return response()->json(['success' => true, 'message' => 'Login attempts deleted successfully.']);
    }
}