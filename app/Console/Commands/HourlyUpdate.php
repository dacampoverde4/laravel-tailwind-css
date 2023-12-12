<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;

class HourlyUpdate extends Command
{

    protected $signature = 'HourlyUpdate:sendemails';

    protected $description = 'Send message notifications Emails';


    public function __construct()
    {

       parent::__construct();

    }


    public function handle()
    {
        $messages = \App\Message::where('created_at', '>', Carbon::now()->subMinutes(80)->toDateTimeString())->where('is_seen','1')->get();

        foreach($messages as $data){
            $userdata = array();
            $userinfo = \App\User::where('id',$data->user_id)->first();
            $recieverinfo = \App\User::where('id',$data->reciever_id)->first();
            $recieverinfo = \App\User::where('id',$data->reciever_id)->first();
            $userdata['name'] = $userinfo->name;
            $userdata['email'] = $recieverinfo->email;

            Mail::send('emails.chatnotification', array('key' => $userdata), function($message) use ($userdata){
                $message->from('avdopt@info.com', 'Avdopt');
                $message->to($userdata['email'])->subject('New Message!');
            });

        }

        $matches = \App\Heart::where('created_at', '>', Carbon::now()->subMinutes(5)->toDateTimeString())->where('is_seen','1')
            ->get();
        foreach($matches as $match){
            $userinfo = \App\User::where('id',$match->user_id)->first();
            $recieverinfo = \App\User::where('id',$match->wishlistedby)->first();
            $userdata['name'] = $userinfo->name;
            $userdata['user_id'] = $userinfo->id;
            $emails[] = $recieverinfo->email;
            Mail::send('emails.heartrrequest', array('key' => $userdata), function($message) use ($userdata){
                $message->from('avdopt@info.com', 'Avdopt');
                $message->to($userdata['email'])->subject('New Heart request!');
            });
        }
    }

}