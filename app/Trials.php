<?php

namespace App;
use Auth;

use Illuminate\Database\Eloquent\Model;

class Trials extends Model
{
    public function userid()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    public function matcherid()
    {
        return $this->belongsTo('App\User', 'matcher_id');
    }

    public function getReviewsTrail()
    {
        return $this->hasOne(\App\Review::class,'tid','id')
        			->where('user_id',Auth::user()->id)
        			->where('type','trial');
    }
    public function getReviewsAdoption()
    {
        return $this->hasOne(\App\Review::class,'tid','id')
        			->where('user_id',Auth::user()->id)
        			->where('type','adoption');
    }
     public function getDissolveAdoption()
    {
        return $this->hasOne(\App\Review::class,'tid','id')
        			->where('user_id',Auth::user()->id)
        			->where('type','dissolve');
    }
}
