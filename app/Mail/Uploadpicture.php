<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class Uploadpicture extends Mailable
{
    use Queueable, SerializesModels;


    public $name;
    public $files;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $files)
    {
        $this->name = $name;
        if ($this->name === null) {
            $this->name = 'onbekende';
        }
        $this->files = $files;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->from('knstadskrant@gmail.com', 'knstadskrant')
            ->view('emails.uploadPicture')->subject('Photo upload');

        foreach ($this->files as $file) {
            $email->attachFromStorageDisk('local', $file);
        }
    }
}
