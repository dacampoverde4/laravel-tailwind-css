<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model
{
    public function wallet(){
        return $this->belongsTo('App\Wallet');
    }
    //
}
