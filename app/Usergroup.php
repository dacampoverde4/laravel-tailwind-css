<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Illuminate\Database\Eloquent\Builder;

class Usergroup extends Model
{

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('orderStatus', function (Builder $builder) {
            $builder->orderby('sort', 'asc');
        });
    }

    protected $fillable = [
        'primary_color'
    ];
    public function tagdata()
    {
        return $this->belongsTo('App\UsergroupTag', 'tags');
    }

    public function titles()
    {
        return $this->belongsTo('App\GenderRole');
    }

    public function pushnotification()
    {
        return $this->belongsTo('App\PushNotification');
    }


    public function getImageFullUrlAttribute()
    {
        if ($this->id == 4) {
            return URL::asset('/') . '/frontend/images/usergroup/toddler.jpg';
        } elseif ($this->id == 3) {
            return URL::asset('/') . '/frontend/images/usergroup/child.jpg';
        } elseif ($this->id == 1) {
            return URL::asset('/') . '/frontend/images/usergroup/ugteen.jpg';
        } elseif ($this->id == 2) {
            return URL::asset('/') . '/frontend/images/usergroup/adult.jpg';
        } elseif ($this->id == 5) {
            return URL::asset('/') . '/frontend/images/usergroup/elder.jpg';
        }

        return "";
    }

    public function getMinMaxAgeRangeArray()
    {
        $min_max_age_arr = array();

        if ($this->minage && $this->maxage && $this->minage <= $this->maxage) {

            for ($i = $this->minage; $i <= $this->maxage; $i++) {
                $min_max_age_arr[] = $i;
            }
        }

        return $min_max_age_arr;
    }

    public function getFamilyRoleCollection()
    {
        $user_group = $this;

        $user_group_family_roles_arr = array();

        $user_group_family_roles_collection = new \Illuminate\Database\Eloquent\Collection();

        if ($user_group->family_roles) {

            $family_roles_assoc_id_arr = FamilyRole::allAsAssocArrayById();

            /* family roles logic */


            $user_group_family_roles_id_arr = ($user_group->family_roles) ? json_decode($user_group->family_roles) : array();

            if ($user_group_family_roles_id_arr) {
                foreach ($user_group_family_roles_id_arr as $user_group_family_roles_id) {

                    if (isset($family_roles_assoc_id_arr[$user_group_family_roles_id])) {
                        $user_group_family_roles_arr[$user_group_family_roles_id] = $family_roles_assoc_id_arr[$user_group_family_roles_id];
                    }
                }
            }

            $user_group_family_roles_collection = $user_group_family_roles_collection->merge($user_group_family_roles_arr);
        }


        return $user_group_family_roles_collection;
    }

    public function getHudsCollection()
    {
        $user_group = $this;

        $user_huds_arr = array();

        $user_huds_collection = new \Illuminate\Database\Eloquent\Collection();

        if ($user_group->huds) {

            $huds_assoc_id_arr = Hud::allAsAssocArrayById();

            /* family roles logic */


            $user_huds_id_arr = ($user_group->huds) ? json_decode($user_group->huds) : array();

            if ($user_huds_id_arr) {
                foreach ($user_huds_id_arr as $user_huds_id) {

                    if (isset($huds_assoc_id_arr[$user_huds_id])) {
                        $user_huds_arr[$user_huds_id] = $huds_assoc_id_arr[$user_huds_id];
                    }
                }
            }

            $user_huds_collection = $user_huds_collection->merge($user_huds_arr);
        }


        return $user_huds_collection;
    }

    public function getGenderRoleCollection()
    {
        $user_group = $this;

        $user_group_gender_roles_arr = array();

        $user_group_gender_roles_collection = new \Illuminate\Database\Eloquent\Collection();

        if ($user_group->genderrole) {

            $gender_roles_assoc_id_arr = GenderRole::allAsAssocArrayById();

            /* gender roles logic */


            $user_group_gender_roles_id_arr = ($user_group->genderrole) ? json_decode($user_group->genderrole) : array();

            if ($user_group_gender_roles_id_arr) {
                foreach ($user_group_gender_roles_id_arr as $user_group_gender_roles_id) {

                    if (isset($gender_roles_assoc_id_arr[$user_group_gender_roles_id])) {
                        $user_group_gender_roles_arr[] = $gender_roles_assoc_id_arr[$user_group_gender_roles_id];
                    }
                }
            }

            $user_group_gender_roles_collection = $user_group_gender_roles_collection->merge($user_group_gender_roles_arr);
        }


        return $user_group_gender_roles_collection;
    }

    public static function allWithGenderRolesAndFamilyRoles()
    {
        $user_groups = self::all();
        $gender_roles_assoc_id_arr = GenderRole::allAsAssocArrayById();
        $family_roles_assoc_id_arr = FamilyRole::allAsAssocArrayById();

        foreach ($user_groups as $user_group) {

            /* gender roles logic */

            $user_group_gender_roles_arr = array();

            $user_group_gender_roles_collection = new \Illuminate\Database\Eloquent\Collection();

            $user_group_gender_roles_id_arr = ($user_group->genderrole) ? json_decode($user_group->genderrole) : array();

            if ($user_group_gender_roles_id_arr) {
                foreach ($user_group_gender_roles_id_arr as $user_group_gender_roles_id) {

                    if (isset($gender_roles_assoc_id_arr[$user_group_gender_roles_id])) {
                        $user_group_gender_roles_arr[] = $gender_roles_assoc_id_arr[$user_group_gender_roles_id];
                    }
                }
            }

            $user_group_gender_roles_collection = $user_group_gender_roles_collection->merge($user_group_gender_roles_arr);

            $user_group->gender_role_collection = $user_group_gender_roles_collection;


            /* family roles logic */

            $user_group_family_roles_arr = array();

            $user_group_family_roles_collection = new \Illuminate\Database\Eloquent\Collection();

            $user_group_family_roles_id_arr = ($user_group->family_roles) ? json_decode($user_group->family_roles) : array();

            if ($user_group_family_roles_id_arr) {
                foreach ($user_group_family_roles_id_arr as $user_group_family_roles_id) {

                    if (isset($family_roles_assoc_id_arr[$user_group_family_roles_id])) {
                        $user_group_family_roles_arr[$user_group_family_roles_id] = $family_roles_assoc_id_arr[$user_group_family_roles_id];
                    }
                }
            }

            $user_group_family_roles_collection = $user_group_family_roles_collection->merge($user_group_family_roles_arr);

            $user_group->family_role_collection = $user_group_family_roles_collection;
        }

        return $user_groups;
    }
    public function Questionnaires()
    {
        return $this->belongsToMany('App\Questionnaires')->withPivot('questionnaires_id', 'usergroup_id');
    }
    public function userVerificationQuestionnaires()
    {
        return $this->belongsToMany('App\UserVerificationQuestionnaires')->withPivot('user_verification_questionnaires_id', 'usergroup_id');
    }
    public function relationships()
    {
        return $this->belongsToMany('App\Relationship');
    }
    public function occupations()
    {
        return $this->belongsToMany('App\Occupation');
    }
   
}
