<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VolunteerApplication extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The data.
     *
     * @var array
     */
    public $name;
    public $email;
    public $explenation;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $email, $explenation)
    {
        $this->name = $name;
        $this->email = $email;
        $this->explenation = $explenation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('knstadskrant@gmail.com', 'knstadskrant')
            ->view('emails.volunteerApplication')->subject('Nieuwe vrijwiliger');
    }
}
