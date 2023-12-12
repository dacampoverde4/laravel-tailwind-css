<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Answer extends Model
{
    protected $table = 'answers';
    protected $fillable = [
        'user_id',
        'group_id',
        'answer_data'
    ];
    protected $hidden = ['updated_at'];
}