<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ElectiveMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data,$curricula;

    public $subject = '佛陀教育網路教育 選課通知';
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$curricula)
    {
        $this->data = $data;
        $this->curricula = $curricula;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.elective');
    }
}
