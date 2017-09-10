<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Mail\Mailer;
use Illuminate\Support\Facades\Log;

class SendRegisterEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $view,$subject,$usermail;
    protected $data; // going to be array
    public function __construct($_view,$_subject,$_usermail,array $_data)
    {
        $this->view =$_view;
        $this->subject =$_subject;
        $this->usermail =$_usermail;
        $this->data= $_data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mail)
    {
        $subject = $this->subject;
        $usermail = $this->usermail;
        $mail->send($this->view, $this->data, function ($message) use ($subject,$usermail)
        {

            // $message->from('me@gmail.com', 'Christian Nwamba');
            $message->subject($subject);

            $message->to($usermail);

        });
        Log::debug('mail has been archived to user '.$usermail." subject ".$subject);

    }
}
