<?php

namespace App\Mail;

use Arr;
use App\Models\Invitation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use MailerSend\Helpers\Builder\Variable;
use Illuminate\Contracts\Queue\ShouldQueue;
use MailerSend\LaravelDriver\MailerSendTrait;

class InvitationEmail extends Mailable
{
    use Queueable, SerializesModels, MailerSendTrait;

    public $invitation;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Invitation $invitation)
    {
        $this->invitation = $invitation;
    }

    public function build()
    {
        $invitation = $this->invitation;
        
        // Recipient for use with variables and/or personalization
        $to = Arr::get($this->to, '0.address');

        [$person_name, $domain] = explode('@', $invitation->email);

        return $this
            // ->view('emails.test_html')
            // ->text('emails.test_text')
            ->mailersend(
                template_id: config('mail.mailers.mailersend.templates.invitation'),
                variables: [
                    new Variable($to, [
                        'team.name' => $invitation->team->name,
                        'person.name' => $person_name,
                        'person.role' => 'Member',
                        'tenant.name' => tenant()->id,
                        'account.name' => config('app.name'),
                        'support_email' => config('mail.from.address'),
                        'invitation_link' => route('invitation.accept', ['token' => $invitation->token, 'email' => $invitation->email])
                    ])
                ]
            );
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Invitation Email',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: 'emails.invitation',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
