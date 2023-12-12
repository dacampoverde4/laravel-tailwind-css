<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TerminalApiParcel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid', 'parcel_name', 'sl_url'
    ];

}
