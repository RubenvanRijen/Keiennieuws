<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EndSubscriptionNotification extends Mailable
{
    use Queueable, SerializesModels;
    public $url;
    public $template_message;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->template_message =  $template_message = "Er is een gebruiker weggegaan";
        $this->url =  $url = url('/dashboard/admin/user-info/' . $id);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->from('knstadskrant@gmail.com', 'knstadskrant')
            ->view('emails.notificationEmail')->subject('Notificatie');
    }
}
