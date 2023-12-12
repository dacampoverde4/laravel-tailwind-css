<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Illuminate\Database\Eloquent\Builder;

class Questionnaires extends Model
{

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('orderStatus', function(Builder $builder) {
            $builder->orderby('sort', 'asc');
        });
    }

    public function usergroup(){
        return $this->belongsTo('App\Usergroup', 'group_id');
    }

    public function usergroups(){
        return $this->belongsToMany('App\Usergroup')->withPivot('questionnaires_id', 'usergroup_id');
    }
    public function category(){
        return $this->belongsTo('App\MatchQuestCategory', 'category_id', 'id');
    }
}
