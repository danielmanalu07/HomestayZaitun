<?php

namespace App\Listeners;

use App\Models\Booking;
use App\Notifications\BookingNotification;
use Illuminate\Support\Facades\Notification;

class SendNotificationBooking
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
        $booking = Booking::whereHas('nama_user', function ($query) {
            $query->where('id', 1);
        })->get();

        Notification::send($booking, new BookingNotification($event->user));
    }
}
