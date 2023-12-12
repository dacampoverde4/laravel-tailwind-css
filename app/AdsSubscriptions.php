<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdsSubscriptions extends Model
{
    public $table = "ads_subscriptions";

    public function advertisement()
    {
        return $this->belongsTo('App\Advertisement','id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
