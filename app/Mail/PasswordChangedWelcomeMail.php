<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;   // ← only if you plan to queue

class PasswordChangedWelcomeMail extends Mailable /* implements ShouldQueue */
{
    use Queueable, SerializesModels;

    /** @var \App\Models\User */
    public $user;   // accessible in the Blade view

    /**
     * Inject the user that just changed the password.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     */
    public function build(): self
    {
        return $this->subject('Welcome! Your password has been updated')
                    ->markdown('emails.password_changed_welcome');
                    // resources/views/emails/password_changed_welcome.blade.php
    }
}
