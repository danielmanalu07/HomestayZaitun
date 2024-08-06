<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\UserNotification;
use Illuminate\Support\Facades\Notification;

class SendNotificationRegister
{
    /**
     * Create the event listener.
     */
    // public function __construct()
    // {
    //     //
    // }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $user = User::whereHas('nama_lengkap', function ($query) {
            $query->where('id', 1);
        })->get();

        Notification::send($user, new UserNotification($event->user));
    }
}
