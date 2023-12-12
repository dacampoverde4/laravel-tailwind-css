<?php

namespace App\Listeners;

use App\Events\UserWasRegisteredAndVerified;
use App\SecondLifeUsersNotification;
use Carbon\Carbon;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notification;
use App\User;
use App\UserMessage;

class SaveUserRegistrationNotificationForSecondLife
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserWasRegisteredAndVerified  $event
     * @return void
     */
    public function handle(UserWasRegisteredAndVerified $event)
    {   
        $admin = User::where('role_id', '=', 1)->first();
        $admin_id = $admin->id;
        
        if($event->user) {

            if($event->user->uuid) {
                /*$message = "Congratulations ".$event->user->displayname."! Your new AvDopt account has been created. Welcome to the revolution of adoption in Second Life.";*/

                $message = "Congratulations ".$event->user->displayname."! Your new <b>AvDopt</b> account has been created. Welcome to the revolution of adoption in Second Life.";

                $message .= "<br/><br/>Although recently launched, <b>AvDopt</b> has been around for quite some time. In fact, over the last 3 years our team of developers have been working assiduously to provide you with the best adoption experience Second Life has to offer. Simply, because you deserve only the best.";

                $message .= "<br/><br/>Whether you’re looking to adopt or to be adopted, <b>AvDopt</b> is everything you’ve searched for. Take advantage of our free & premium services like: Notes, Chat, Match Quest, Trial Dates & so much more.";

                $message .= "<br/><br/>You’ve made your first step towards excellence, and we’re with you every step of the way. Welcome to <b>AvDopt ".$event->user->displayname."</b>; we are the “<b>A</b>” in “<b>Adoption.</b>” ";

                $message .= "<br/><br/>Mikekey Monday";
                $message .= "<br>CEO & Founder ";

                //SL notification
                $second_life_api_user_notification = SecondLifeUsersNotification::create([
                    'uuid' => $event->user->uuid,
                    'type' => 'Registration Notification',
                    'message' => $message,
                    'created_time' => Carbon::now()->timestamp
                ]);


                //notification
                $notification = new Notification;
                $notification->user_id = $event->user->id;
                $notification->message = $message;
                $notification->type = 'Registration Notification';
                $notification->is_seen = 1;
                $notification->created_by = $admin_id;
                $notification->save();
                
                //message
                $sender = new UserMessage;
                $sender->user_id = $admin_id;
                $sender->reciever_id = $event->user->id;
                $sender->message = $message;
                $sender->type = 'message_notification';
                $sender->is_sent = 1;
                $sender->save();

                //email
                $user_email = $event->user->user_email;
                if($user_email){
                    $data_client = array(
                        'name' => $event->user->displayname,
                        'emailmessage' => $message
                    );
                    $to_client = $event->user->user_email;

                    $mail = \Mail::send('emails.emailnotification', compact('data_client'), function ($message) use ($data_client, $to_client) {
                        $message->to($to_client)->subject('Avdopt Notification');
                        $message->from('avdopt@info.com','Avdopt');
                    });   
                }
                
            }
        }
    }
}
