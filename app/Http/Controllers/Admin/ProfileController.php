<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $admin = auth('admin')->user();
        return view('saheed.admin.profile.index', compact('admin'));
    }

    public function updateField(Request $request)
    {
        try {
            $admin = auth('admin')->user();
            $field = $request->field;
            $value = $request->value;

            if (!$value) {
                return response()->json(['success' => false, 'message' => 'Value is required']);
            }

            if ($field === 'name') {
                $admin->update(['name' => $value]);
            } elseif ($field === 'email') {
                if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    return response()->json(['success' => false, 'message' => 'Invalid email format']);
                }
                if (\App\Models\Admin::where('email', $value)->where('id', '!=', $admin->id)->exists()) {
                    return response()->json(['success' => false, 'message' => 'Email already exists']);
                }
                $admin->update(['email' => $value]);
            } elseif ($field === 'password') {
                if (strlen($value) < 6) {
                    return response()->json(['success' => false, 'message' => 'Password must be at least 6 characters']);
                }
                $admin->update([
                    'password' => Hash::make($value),
                    'actual_password' => $value
                ]);
            } else {
                return response()->json(['success' => false, 'message' => 'Invalid field']);
            }

            return response()->json([
                'success' => true,
                'message' => ucfirst($field) . ' updated successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Update failed: ' . $e->getMessage()]);
        }
    }
}