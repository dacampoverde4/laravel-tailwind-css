<?php

namespace App;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function user()
    {
        return $this->hasOne(\App\User::class,'id','user_id');
    }
    public function reviewComment()
    {
        return $this->hasOne(\App\ReviewComment::class,'rid','id')
        			->where('user_id',Auth::id());
    }
    public function ReviewAbuse()
    {
        return $this->hasOne(\App\ReviewAbuse::class,'rid','id')
        			->where('user_id',Auth::id());
    }
}
