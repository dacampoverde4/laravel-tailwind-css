<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userGroupPlan extends Model
{
   protected $table = 'user_group_plans';

    protected $fillable = [
        'trial_plan_id','user_group_id',
    ];


    
   
    public function trial(){
        return $this->belongTo('App\trialPlans','id','trial_plan_id');
    }
     
}
