<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingCreation extends Mailable
{
    use Queueable, SerializesModels;


    public $url;
    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $url, User $user)
    {
        $this->url = $url;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('knstadskrant@gmail.com', 'knstadskrant')
            ->view('emails.placeBooking');
    }
}
