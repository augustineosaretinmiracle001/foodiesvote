<?php

namespace App\Observers;

use App\Events\NewLoginAttemptEvent;
use App\Models\LoginAttempt;
use App\Models\Admin;
use App\Notifications\NewLoginAttempt;

class LoginAttemptObserver
{
    public function created(LoginAttempt $loginAttempt)
    {
        // Broadcast the event immediately (no queue)
        broadcast(new NewLoginAttemptEvent($loginAttempt))->toOthers();

        // Notify all admins
        $admins = Admin::all();

        foreach ($admins as $admin) {
            $admin->notify(new NewLoginAttempt($loginAttempt));
        }
    }
}
