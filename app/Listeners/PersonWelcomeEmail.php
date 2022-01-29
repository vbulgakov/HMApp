<?php

namespace App\Listeners;

use App\Events\PersonRegistered;
use App\Mail\WelcomeMail;
use App\Models\People;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class PersonWelcomeEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\PersonRegistered  $event
     * @return void
     */
    public function handle(PersonRegistered $event)
    {
        $person = People::find($event->personId)->toArray();

        //  Commented out to allow testing WITHOUT email configuration
        // Mail::to($person['email'])->send(new WelcomeMail());
    }
}
