<?php

namespace App\Listeners;

use App\Events\UserWasLiked;
use App\SecondLifeUsersNotification;
use Carbon\Carbon;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

function GetFirstCuote($link, $from) {
    $p1=strpos($link, '"', $from);
    $p2=strpos($link, "'", $from);
    if ($p1 == FALSE && $p2 == FALSE)
        return FALSE;
    if ($p1 == FALSE)
        return $p2;
    if ($p2 == FALSE)
        return $p1;
    if ($p1<$p2)
        return $p1;
    return $p2;
}

function FromAtoSL($aLink) {
    //'<a href="'.$url.'">'.$event->matched_user_1->displayname.'</a>'
    $pos=strpos($aLink, "<a ");
    if ($pos == FALSE) return $aLink;
    $nSt=$pos+3;
    $pos=strpos($aLink, "href", $nSt);
    if ($pos == FALSE) return $aLink;
    $nSt=$pos+4;
    $pos=GetFirstCuote($aLink, $nSt);
    if ($pos == FALSE) return $aLink;
    $cuote=substr($aLink, $pos, 1);
    $nSt=$pos+1;
    $pos=strpos($aLink, $cuote, $nSt);
    if ($pos == FALSE) return $aLink;
    $url=substr($aLink, $nSt, $pos-$nSt);
    $nSt=$pos+1;
    $pos=strpos($aLink, "</a>", $nSt);
    if ($pos == FALSE) $name=" ";
    else $name=substr($aLink, $nSt, $pos-$nSt);
    return "[".$url." ".$name."]";
}

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
                    $slMsg = $message.' Like their profile and you\'ll have a potential match! ' . FromAtoSL($event->user_who_liked->profile_url);
                    $message .= ' Like their profile and you\'ll have a potential match! ' . $event->user_who_liked->profile_url;
                }

                $second_life_api_user_notification = SecondLifeUsersNotification::create([
                    'uuid' => $event->user_whom_liked->uuid,
                    'type' => 'Like Notification',
                    'message' => $message,
                    'sl_msg' => $slMsg,
                    'created_time' => Carbon::now()->timestamp
                ]);
            }
        }
    }
}
