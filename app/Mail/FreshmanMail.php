<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FreshmanMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data,$new_student_id;
    public $subject = '佛陀教育網路學院 入學通知';
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$new_student_id)
    {
        $this->data = $data;
        $this->new_student_id = $new_student_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.freshman');
    }
}
