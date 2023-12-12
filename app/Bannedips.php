<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bannedips extends Model
{
    protected $table = 'bannedips';

    protected $fillable = [
        'ip_address'
    ];
}
