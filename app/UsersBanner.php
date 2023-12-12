<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersBanner extends Model
{
    public $table = "user_banners";

    public function banners()
    {
        return $this->belongsTo('App\Banner');
    }

    public function advertisement()
    {
        return $this->belongsTo('App\Advertisement','id');
    }
}
