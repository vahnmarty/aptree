<?php

namespace App\Listeners;

use Mail;
use App\Mail\InvitationEmail;
use App\Events\InvitationCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendInvitation
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
     * @param  \App\Events\InvitationCreated  $event
     * @return void
     */
    public function handle(InvitationCreated $event)
    {
        $invitation = $event->invitation;

        Mail::to($invitation->email)->send(new InvitationEmail($invitation));
    
    }
}
