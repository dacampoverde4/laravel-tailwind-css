<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prepurches extends Model
{
    //
    protected $table = 'prepurches';
    protected $fillable = [
        'plan_id',
        'user_id','token_id','uuid'
    ];



    public function plan(){
        return $this->belongsTo('App\Plan');
    }

    public function tokens(){
        return $this->belongsTo('App\Tokens');
    }
    
}
