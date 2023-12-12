<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $table = 'plans';

    public function prepurches(){
        return $this->hasMany('App\Prepurches');
    }
}
