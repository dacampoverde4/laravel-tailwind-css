<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    public $table = "advertisement";

    public function adsubscription()
    {
        return $this->hasOne('App\AdsSubscriptions','ads_id');
    }
}
