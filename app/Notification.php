<?php

namespace App;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    public static function notificationCount(){
        return Notification::where('user_id', Auth::user()->id)->where('is_seen', 1)->count();
    }

}
