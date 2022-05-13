<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EditEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $url;
    public $user;
    public $newEmail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $url, User $user, string $newEmail)
    {
        $this->url = $url;
        $this->user = $user;
        $this->newEmail = $newEmail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('knstadskrant@gmail.com', 'knstadskrant')
            ->view('emails.editEmail')->subject('Email aanpassen');
    }
}
