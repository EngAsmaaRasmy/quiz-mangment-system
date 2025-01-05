<?php

namespace Modules\Clients\App\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdminCredentialsMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public $user, public $domain, public $password)
    {
        //
    }

    /**
     * Build the message.
     */
    public function build(): self
    {
        return $this->markdown('clients::emails.admin_credentials')
                    ->subject('Your Admin Account Credentials');
    }
}
