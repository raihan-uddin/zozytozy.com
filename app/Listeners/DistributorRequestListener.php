<?php

namespace App\Listeners;

use App\Events\DistributorRequestEvent;
use App\Mail\DistributorRequestEmailToClient;
use App\Mail\DistributorRequestEmailToOwner;
use Illuminate\Support\Facades\Mail;

class DistributorRequestListener
{
    /**
     * Create the event listener.
     */
    public function __construct() {}

    /**
     * Handle the event.
     */
    public function handle(DistributorRequestEvent $event): void
    {
        Mail::to($event->data->email)->send(new DistributorRequestEmailToClient($event->data));
        Mail::to(config('app.owner_emails.raihan'))->send(new DistributorRequestEmailToOwner($event->data));
        Mail::to('app.owner_emails.binbox')->send(new DistributorRequestEmailToOwner($event->data));
    }
}
