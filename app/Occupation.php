<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Illuminate\Database\Eloquent\Builder;

class Occupation extends Model
{

    public function usergroups()
    {
        return $this->belongsToMany('App\Usergroup');
    }
}