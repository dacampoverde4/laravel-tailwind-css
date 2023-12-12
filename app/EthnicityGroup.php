<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Illuminate\Database\Eloquent\Builder;

class EthnicityGroup extends Model
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
        $ethnicity_groups=self::all();

        $ethnicity_groups_assoc_id_arr=array();

        foreach($ethnicity_groups as $seeking_role )
        {
            $ethnicity_groups_assoc_id_arr[$seeking_role->id]=$seeking_role;
        }

        return $ethnicity_groups_assoc_id_arr;
    }
}
