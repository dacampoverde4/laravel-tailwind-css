<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Photoalbum extends Authenticatable
{
    use Notifiable;
    protected $table = 'photo_album';
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'user_id','image', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    
}
