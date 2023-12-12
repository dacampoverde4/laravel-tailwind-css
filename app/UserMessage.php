<?php

namespace App;

use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class UserMessage extends Model
{
    protected $guarded = [];
    
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    
    public function reciever()
    {
        return $this->belongsTo('App\User', 'reciever_id');
    }

    public static function recentnotecount(){
    	return UserMessage::where('reciever_id', Auth::user()->id)->where('is_seen', 1)->count();
    }
}
