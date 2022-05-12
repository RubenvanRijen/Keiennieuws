<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EditResidence extends Mailable
{
    use Queueable, SerializesModels;

    public $url;
    public $user;
    public $city;
    public $house_number;
    public $postcode;
    public $street_name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $url, User $user, string $city, string $house_number, string $postcode, string $street_name)
    {
        $this->url = $url;
        $this->user = $user;
        $this->city = $city;
        $this->house_number = $house_number;
        $this->postcode = $postcode;
        $this->street_name = $street_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('knstadskrant@gmail.com', 'knstadskrant')
            ->view('emails.editResidence');
    }
}
