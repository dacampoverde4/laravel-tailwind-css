<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SecondLifeUsersNotification extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid','type', 'message','read','created_time'
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
