<?php

namespace App\Listeners;

use App\Events\UserWasLiked;
use App\SecondLifeUsersNotification;
use Carbon\Carbon;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SaveUserWasLikedNotificationForSecondLife
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
     * @param  UserWasLiked  $event
     * @return void
     */
    public function handle(UserWasLiked $event)
    {
        if ($event->user_whom_liked && $event->user_who_liked) {

            if($event->user_who_liked->displayname && $event->user_whom_liked->uuid) {
                $message = 'Hey ' . $event->user_whom_liked->second_life_full_name . ', you just received a profile like from ' . $event->user_who_liked->displayname . '.';

                if (!$event->user_whom_liked->likedUser($event->user_who_liked->id)) {
                    $message .= ' Like their profile and you\'ll have a potential match! ' . $event->user_who_liked->profile_url;
                }

                $second_life_api_user_notification = SecondLifeUsersNotification::create([
                    'uuid' => $event->user_whom_liked->uuid,
                    'type' => 'Like Notification',
                    'message' => $message,
                    'created_time' => Carbon::now()->timestamp
                ]);
            }
        }
    }
}
