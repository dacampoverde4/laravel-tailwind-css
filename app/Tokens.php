<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tokens extends Model
{

    public function prepurches(){
        return $this->hasMany('App\Prepurches');
    }
    //
}
