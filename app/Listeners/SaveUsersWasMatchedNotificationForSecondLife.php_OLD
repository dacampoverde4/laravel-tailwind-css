<?php

namespace App\Listeners;

use App\Events\UsersWasMatched;
use App\SecondLifeUsersNotification;
use Carbon\Carbon;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notification;
use App\User;
use App\UserMessage;

class SaveUsersWasMatchedNotificationForSecondLife
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
     * @param  UsersWasMatched  $event
     * @return void
     */
    public function handle(UsersWasMatched $event)
    {       

        $admin = User::where('role_id', '=', 1)->first();
        $admin_id = $admin->id;
        if ($event->matched_user_1 && $event->matched_user_2) {

            if($event->matched_user_2->displayname && $event->matched_user_1->uuid) {

                $encodeid = base64_encode($event->matched_user_2->id); 
                $url = url('/userprofile/'.$encodeid);               
                $userotherprofilelink = '<a href="'.$url.'">'.$event->matched_user_2->displayname.'</a>';

                $message = "Congratulations ".$event->matched_user_1->displayname."! ".$event->matched_user_2->he_she." Likes you too… ".$userotherprofilelink." is a match! Join ".$event->matched_user_2->him_her." in a ";
                $message .= '<a href="'.url('chat?id='.$event->matched_user_2->id).'">chat</a>';
                $message .= " or schedule a ";
                $message .= '<a href="'.url( 'schedule/'.base64_encode($event->matched_user_2->id) ).'">Trial Date</a>';
                $message .= '!';

                //SL notification
                $second_life_api_user_notification = SecondLifeUsersNotification::create([
                    'uuid' => $event->matched_user_1->uuid,
                    'type' => 'Match Notification',
                    'message' => $message,
                    'created_time' => Carbon::now()->timestamp
                ]);

                //notification
                $notification = new Notification;
                $notification->user_id = $event->matched_user_1->id;
                $notification->message = $message;
                $notification->type = 'Match Notification';
                $notification->is_seen = 1;
                $notification->created_by = $admin_id;
                $notification->save();
                
                //message
                $sender = new UserMessage;
                $sender->user_id = $admin_id;
                $sender->reciever_id = $event->matched_user_1->id;
                $sender->message = $message;
                $sender->type = 'message_notification';
                $sender->is_sent = 1;
                $sender->save();

                //email
                $data_client = array(
                    'name' => $event->matched_user_1->displayname,
                    'emailmessage' => $message
                );        
                $to_client = $event->matched_user_1->email;
                $mail = \Mail::send('emails.emailnotification', compact('data_client'), function ($message) use ($data_client, $to_client) {
                    $message->to($to_client)->subject('Avdopt Notification');
                    $message->from('avdopt@info.com','Avdopt');
                });
            }

            if($event->matched_user_1->displayname && $event->matched_user_2->uuid) {

                $encodeid = base64_encode($event->matched_user_1->id); 
                $url = url('/userprofile/'.$encodeid);               
                $userotherprofilelink = '<a href="'.$url.'">'.$event->matched_user_1->displayname.'</a>';                

                $message = "Congratulations ".$event->matched_user_2->displayname."! Now that you and ".$userotherprofilelink." are a match, Join ".$event->matched_user_2->him_her." in a ";
                $message .= '<a href="'.url('chat?id='.$event->matched_user_1->id).'">chat</a>';
                $message .= " or schedule a "; 
                $message .= '<a href="'.url( 'schedule/'.base64_encode($event->matched_user_1->id) ).'">Trial Date</a>';
                $message .= '!';

                //SL notification
                $second_life_api_user_notification = SecondLifeUsersNotification::create([
                    'uuid' => $event->matched_user_2->uuid,
                    'type' => 'Match Notification',
                    'message' => $message,
                    'created_time' => Carbon::now()->timestamp
                ]);

                //notification
                $notification = new Notification;
                $notification->user_id = $event->matched_user_2->id;
                $notification->message = $message;
                $notification->type = 'Match Notification';
                $notification->is_seen = 1;
                $notification->created_by = $admin_id;
                $notification->save();

                //message
                $sender = new UserMessage;
                $sender->user_id = $admin_id;
                $sender->reciever_id = $event->matched_user_2->id;
                $sender->message = $message;
                $sender->type = 'message_notification';
                $sender->is_sent = 1;
                $sender->save();

                //email
                $data_client = array(
                    'name' => $event->matched_user_2->displayname,
                    'emailmessage' => $message
                );        
                $to_client = $event->matched_user_2->email;
                $mail = \Mail::send('emails.emailnotification', compact('data_client'), function ($message) use ($data_client, $to_client) {
                    $message->to($to_client)->subject('Avdopt Notification');
                    $message->from('avdopt@info.com','Avdopt');
                });                
            }
        }
    }
}
