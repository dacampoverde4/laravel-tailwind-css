<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    protected $table = 'events';

    public function userSaved()
    {
        return $this->belongsToMany('App\User',"users_events_saved","event_id","user_id");
    }


    public function scopeSavedByUser($query,$user_id) {

        return $this
            ->whereHas('userSaved', function ($query) use ($user_id) {
                $query->where('user_id', $user_id);
            });

    }


    public function scopeUpcoming($query) {

        return $query
            ->whereDate('date', '>=', Carbon::today()->toDateString());

    }


    public function scopePast($query) {

        return $query
            ->whereDate('date', '<', Carbon::today()->toDateString());

    }


    public function getEventDateDisplayAttribute()
    {
        if ($this->date) {
            $date_carbon_obj = Carbon::createFromFormat('Y-m-d H:i:s', $this->date);

            return $date_carbon_obj->format('D, M d h:i A');

        }

        return "";

    }

    public function getEventDateDisplay2Attribute()
    {
        if ($this->date) {
            $date_carbon_obj = Carbon::createFromFormat('Y-m-d H:i:s', $this->date);

            return $date_carbon_obj->format('m-d-Y h:i A');

        }

        return "";

    }
}
