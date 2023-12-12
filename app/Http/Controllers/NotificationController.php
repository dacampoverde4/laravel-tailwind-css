<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Auth;
use App\Notification;
use Illuminate\Http\Request;
use Mail;
use GuzzleHttp\Client;
use DateTime;
use Storage;
class NotificationController extends Controller
{

    public static function create( array $notificationdata )
    {
        $data = new Notification;
        $data->user_id = $notificationdata['user_id'];
        $data->message = $notificationdata['message'];
        $data->type = $notificationdata['type'];
        $data->is_seen = 1;
        $data->created_by = Auth::user()->id;
        $data->save();
		/*
        $userdata['name'] = Auth::user()->name;
		$userdata['messages'] = $notificationdata['message'];
		$userdata['user_id'] = $notificationdata['user_id'];
		$email = \App\User::where('id',$notificationdata['user_id'])->pluck('email');
		$userdata['email'] = $email[0];
		$mail = Mail::send('emails.notificationmail',$userdata, function($message) use ($userdata)
		{
			$message->from('avdopt@info.com', "Avdopt");
			$message->subject("New Notification from Avdopt");
			$message->to($userdata['email']);
		});
		*/
        return true;

    }

	public function testmail(){
		/* echo 'abc';
		$html = view('emails.heartrrequest')->render();
		echo $html; */
		/*\Stripe\Stripe::setApiKey(env("STRIPE_SECRET"));
		        $token =  \Stripe\Token::create(array(
          "card" => array(
            "number" => "4242424242424242",
            "exp_month" => 7,
            "exp_year" => 2024,
            "cvc" => "314"
          )
        ));
		         $token->id;

		$charge = \Stripe\Charge::create([
		    'amount' => 999,
		    'currency' => 'usd',
		    'description' => 'Example charge',
		    'source' => $token->id,
		    'statement_descriptor' => 'Custom descriptor',
		]);
		dd($charge);*/
        die;

		/* $messages = \App\Message::where('created_at', '>', Carbon::now()->subMinutes(80)->toDateTimeString())->where('is_seen','1')->get();
		foreach($messages as $data){
			$userdata = array();
			$userinfo = \App\User::where('id',$data->user_id)->first();
			$recieverinfo = \App\User::where('id',$data->reciever_id)->first();
			$recieverinfo = \App\User::where('id',$data->reciever_id)->first();
			$userdata['name'] = $userinfo->name;
			$userdata['email'] = $recieverinfo->email;

			Mail::send('emails.chatnotificationnn', array('key' => $userdata), function($message) use ($userdata)
        {
			$message->from('avdopt@info.com', 'Avdopt');
            $message->to($userdata['email'])->subject('New Message!');
        });

		} */


    }



}
