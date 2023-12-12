<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Terminal_info extends Model
{
    protected $table = 'terminal_infos';
    protected $fillable = [
        'uuid',
        'terminal_id',
        'parcel_name',
        'region_name',
        'x',
        'y',
        'z',
    ];
    //
}
