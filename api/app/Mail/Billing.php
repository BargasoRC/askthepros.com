<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Carbon\Carbon;

class Billing extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    public $date;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $data, $timezone)
    {
        $this->user = $user;
        $this->data = $data;
        $this->date = Carbon::now()->copy()->tz($timezone)->format('F j, Y h:i A');
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
         return $this->subject('Billing')->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'))->view('email.billing');
    }
}
