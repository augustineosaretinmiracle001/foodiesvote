<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $notifications = auth('admin')->user()->notifications()->paginate(20);

        if ($request->ajax()) {
            return view('saheed.admin.notifications.partials.notifications-list', compact('notifications'))->render();
        }

        return view('saheed.admin.notifications.index', compact('notifications'));
    }

    public function markAsRead($id)
    {
        $notification = auth('admin')->user()->notifications()->find($id);
        if ($notification) {
            $notification->markAsRead();
        }

        if (request()->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->back()->with('success', 'Notification marked as read.');
    }

    public function markAllAsRead()
    {
        auth('admin')->user()->unreadNotifications->markAsRead();
        
        if (request()->ajax()) {
            return response()->json(['success' => true, 'message' => 'All notifications marked as read']);
        }
        
        return redirect()->back()->with('success', 'All notifications marked as read.');
    }

    public function getCount()
    {
        $count = auth('admin')->user()->unreadNotifications()->count();
        return response()->json(['count' => $count]);
    }

    public function getRecent()
    {
        $notifications = auth('admin')->user()->notifications()->take(2)->get();
        return response()->json(['notifications' => $notifications]);
    }

    public function clearAll()
    {
        auth('admin')->user()->notifications()->delete();
        return redirect()->back()->with('success', 'All notifications cleared successfully.');
    }
}