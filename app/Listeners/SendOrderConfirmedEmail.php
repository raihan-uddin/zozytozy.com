<?php

namespace App\Listeners;

use App\Events\OrderConfirmed;
use App\Mail\OrderConfirmedMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendOrderConfirmedEmail
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     */
    public function __construct() {}

    /**
     * Handle the event.
     */
    public function handle(OrderConfirmed $event): void
    {
        Mail::to($event->order->user->email)->send(new OrderConfirmedMail($event->order));
    }
}
