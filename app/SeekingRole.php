<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Illuminate\Database\Eloquent\Builder;

class SeekingRole extends Model
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
        $seeking_roles=self::all();

        $seeking_roles_assoc_id_arr=array();

        foreach($seeking_roles as $seeking_role )
        {
            $seeking_roles_assoc_id_arr[$seeking_role->id]=$seeking_role;
        }

        return $seeking_roles_assoc_id_arr;
    }
}
