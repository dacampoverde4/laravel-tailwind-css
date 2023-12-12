<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PushNotification extends Model
{
    protected $table = 'push_notifications';
    protected $fillable = [
        'name',
        'image',
        'url',
        'button_text',
        'content',
        'showing_count',
        'seconds_to_show_after_login',
        'show_to_new_users'
    ];
    protected $hidden = ['updated_at'];
    protected $appends = ['bannerimage'];

    public function getBannerimageAttribute(){
        if (! $this->attributes['image']) {
            return 'assets/images/default.png';
        }
        return $this->attributes['image'];
    }

    public function usergroups()
    {
        return $this->belongsToMany('App\Usergroup');
    }

    public function plans()
    {
        return $this->belongsToMany('App\Plan');
    }
}
