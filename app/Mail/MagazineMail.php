<?php

namespace App\Mail;

use App\Magazine;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MagazineMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $subject;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->data = Magazine::get()->last();
        $this->subject = "【佛陀教育雜誌】Vol.".$this->data->id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.magazine');
//        ->attach(public_path().'/storage/magazine_file/'.$this->data->file)
    }
}
