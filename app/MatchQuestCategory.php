<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class MatchQuestCategory extends Model
{
    protected $table = 'match_quest_categories';
    protected $fillable = [
        'name',
        'slug',
        'description',
        'banner'
    ];
    protected $hidden = ['updated_at'];
    protected $appends = ['bannerimage'];

    public function getBannerimageAttribute(){
        if (! $this->attributes['banner']) {
            return 'assets/images/default.png';
        }
        return $this->attributes['banner'];
    }

    public function questions(){
        return $this->hasMany('App\Questionnaires', 'category_id', 'id')->where('group_id', Auth::user()->group);
    }

    public function visitedUserQuestions(){
        return $this->hasMany('App\Questionnaires', 'category_id', 'id');
    }
}