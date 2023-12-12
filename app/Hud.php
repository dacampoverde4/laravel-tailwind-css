<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Illuminate\Database\Eloquent\Builder;

class Hud extends Model
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
        $huds=self::all();

        $huds_assoc_id_arr=array();

        foreach($huds as $hud )
        {
            $huds_assoc_id_arr[$hud->id]=$hud;
        }

        return $huds_assoc_id_arr;
    }

}
