<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $table = 'wallets';
    protected $fillable = [
        'user_id',
        'balance'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function wallettransaction(){
        return $this->hasMany('App\WalletTransaction');
    }
}
