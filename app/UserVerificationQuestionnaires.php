<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserVerificationQuestionnaires extends Model
{
    const user_verification_questionnaires = 'user_verification_questionnaires';
    const id = 'id';
    const question_title = 'question_title';
    const question_type = 'question_type';
    const question_data = 'question_data';
    const sort = 'sort';
    const created_at = 'created_at';
    const updated_at = 'updated_at';
    const category_id = 'category_id';

    protected $table = self::user_verification_questionnaires;
    protected $primaryKey = self::id;

    // Boot
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('orderStatus', function (Builder $builder) {
            $builder->orderby('sort', 'asc');
        });
    }

    // Usergroup
    public function usergroup()
    {
        return $this->belongsTo('App\Usergroup', 'group_id');
    }

    // Usergroups
    public function usergroups()
    {
        return $this->belongsToMany('App\Usergroup')->withPivot('user_verification_questionnaires_id', 'usergroup_id');
    }

    // Category
    public function category()
    {
        return $this->belongsTo('App\MatchQuestCategory', 'category_id', 'id');
    }

    // Set Request
    protected static function setRequest($self, $request, $type)
    {
        $self->question_title = $request[self::question_title];
        $self->question_type = $request[self::question_type];
        $self->question_data = json_encode(request('question'));
        if (isset($request[self::sort])) $self->sort = $request[self::sort];
        $self->category_id = $request[self::category_id];
        return $self;
    }
    // Add Or Update
    public function addOrupdate($request, $type = 0)
    {
        if ($type == 0) {
            $usergroup_ids = request('usergroups');
            $data = self::setRequest($self = new self(), $request, $type);
            $data->save();
            $data->usergroups()->attach($usergroup_ids);
            return $data ? $data :  null;
        } else {
            $usergroup_ids = request('usergroups');
            $data = self::find($request[self::id]);
            if ($data) {
                $data = self::setRequest($data, $request, $type);
                $data->save();
                $data->usergroups()->sync($usergroup_ids);
                return $data ? $data : null;
            }
        }
    }
}