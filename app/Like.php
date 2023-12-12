<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public function userWhoLiked(){
        return $this->belongsTo('App\User', 'liked_by');
    }

    public function userWhomLiked(){
        return $this->belongsTo('App\User', 'user_id');
    }

}
