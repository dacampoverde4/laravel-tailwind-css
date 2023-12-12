<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class FamilyRole extends Model
{

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('orderStatus', function(Builder $builder) {      
            $builder->orderby('sort', 'asc');
        });
    }

    public static function allAsAssocArrayById()
    {
        $family_roles=self::all();

        $family_roles_assoc_id_arr=array();

        foreach($family_roles as $family_role )
        {
            $family_roles_assoc_id_arr[$family_role->id]=$family_role;
        }

        return $family_roles_assoc_id_arr;
    }
}
