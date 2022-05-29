<?php

namespace App\Listeners;

use App\Events\BookingCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\SendNewBookingNotification;

class SendNewBookingListener
{
    public function handle(BookingCreated $event)
    {
        $agent = $event->booking->property->author();

        $agent->notify(new SendNewBookingNotification($event->booking));

    }
}