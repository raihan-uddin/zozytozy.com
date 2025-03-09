<?php

namespace App\Listeners;

use App\Events\OrderSubmitted;
use App\Mail\OrderSubmitted as OrderSubmittedMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendOrderSubmittedEmail
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     */
    public function __construct() {}

    /**
     * Handle the event.
     */
    public function handle(OrderSubmitted $event): void
    {
        Mail::to($event->order->user->email)->send(new OrderSubmittedMail($event->order));
    }
}
