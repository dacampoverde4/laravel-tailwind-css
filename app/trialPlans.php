<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class trialPlans extends Model
{
    protected $table = 'trial_plans';

    protected $fillable = [
        'title','subscription_id','days','status','user_group_id',
    ];


    
    public function plan()
    {
        return $this->hasOne('App\Plan', 'id' ,'subscription_id');
    }
     public function Allplans()
    {
        return $this->hasMany('App\Plan', 'id' ,'subscription_id');
    }

    /*public function userGroup(){
        return $this->hasMany('App\Usergroup','id','user_group_id');
    }*/
     public function userGroupPlans(){
        return $this->hasMany('App\userGroupPlan','id','user_group_id');
    }

    public function trailGroups(){
        return $this->hasMany('App\userGroupPlan','trial_plan_id');
    }
}
