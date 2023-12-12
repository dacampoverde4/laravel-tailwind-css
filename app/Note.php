<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    public function usergroup(){
        return $this->belongsTo('App\Usergroup', 'user_group');
    }
}
