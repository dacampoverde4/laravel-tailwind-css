<?php

namespace App\Listeners;

use App\Events\UserWasLiked;
use App\SecondLifeUsersNotification;
use App\UserMessage;
use App\Notification;
use Carbon\Carbon;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\UserAllNotification;

class SaveAllNotifications
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
     * @param  object  $event
     * @return void
     */
    public function handle(UserAllNotification $event)
    {
        if($event->user_allnotification['emailtype']){
            $data_client = array(
                'name' => $event->user_allnotification['emailtype']['displayname'],
                'emailmessage' => $event->user_allnotification['emailtype']['email_message']
            );        
            $to_client = $event->user_allnotification['emailtype']['email'];

            $mail = \Mail::send('emails.emailnotification', compact('data_client'), function ($message) use ($data_client, $to_client) {
                $message->to($to_client)->subject('Avdopt Notification');
                $message->from('avdopt@info.com','Avdopt');
            });
        }

        if($event->user_allnotification['messagetype']){
            $sender = new UserMessage;
            $sender->user_id = $event->user_allnotification['messagetype']['user_id'];
            $sender->reciever_id = $event->user_allnotification['messagetype']['reciever_id'];
            $sender->message = $event->user_allnotification['messagetype']['message'];
            $sender->type = $event->user_allnotification['messagetype']['type'];
            $sender->is_sent = 1;
            $sender->save();
        }

        if($event->user_allnotification['notificationtype']){
            $notification = new Notification;
            $notification->user_id = $event->user_allnotification['notificationtype']['user_id'];
            $notification->message = $event->user_allnotification['notificationtype']['message'];
            $notification->type = $event->user_allnotification['notificationtype']['type'];
            $notification->is_seen = 1;
            $notification->created_by = $event->user_allnotification['notificationtype']['created_by'];
            $notification->save();
        }

        if($event->user_allnotification['sl_notificationtype']){
             $second_life_api_user_notification = SecondLifeUsersNotification::create([
                'uuid' => $event->user_allnotification['sl_notificationtype']['uuid'],
                'type' => $event->user_allnotification['sl_notificationtype']['type'],
                'message' => $event->user_allnotification['sl_notificationtype']['message'],
                'sl_msg' => $event->user_allnotification['sl_notificationtype']['sl_msg'],
                'read' => 0,
                'created_time' => Carbon::now()->timestamp
            ]);
        }
    }
}
