<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckoutModel extends Model
{
    protected $table = 'checkouts';
    protected $fillable = [
        'uuid',
        'transction_type',
        'amount'
    ];
    //
}
