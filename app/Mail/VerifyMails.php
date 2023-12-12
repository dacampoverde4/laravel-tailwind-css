<?php
 
namespace App\Mail;
 
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use DB;
class VerifyMails extends Mailable
{
    use Queueable, SerializesModels;
 
    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }
 
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {		$link = $_SERVER['PHP_SELF'];		$link_array = explode('/',$link);		$email = end($link_array);
    $tokenData = DB::table('password_resets')->where('email', $email)->first();

   $token = $tokenData->token;
        return $this->view('emails.recovery',compact('email','token'));
    }
}