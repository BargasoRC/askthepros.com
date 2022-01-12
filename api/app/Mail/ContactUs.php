<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Carbon\Carbon;

class ContactUs extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $date;
    public $content;
    public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $timezone, $subject, $content)
    {
        $this->data = $data;
        $this->content = $content;
        $this->date = Carbon::now()->copy()->tz($timezone)->format('F j, Y h:i A');
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */

    public function build()
    {
        return $this->subject($this->subject)->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'))->view('email.contactusreceiver');
    }
}
