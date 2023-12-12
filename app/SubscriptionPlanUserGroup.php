<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubscriptionPlanUserGroup extends Model
{
    protected $table = 'subscription_plan_user_groups';

    protected $fillable = [
        'main_group_id','map_group_id', 'main_group_plan_id','map_group_plan_id','created_time'
    ];
    
    public function group_point_first(){
        return $this->belongsTo('App\Usergroup', 'main_group_id', 'id');
    }

    public function group_point_second(){
        return $this->belongsTo('App\Usergroup', 'map_group_id', 'id');
    }
    public function group_point1_plan(){
        return $this->belongsTo('App\Plan', 'main_group_plan_id', 'plan_id');
    }
    public function group_point2_plan(){
        return $this->belongsTo('App\Plan', 'map_group_plan_id', 'plan_id');
    }
}
