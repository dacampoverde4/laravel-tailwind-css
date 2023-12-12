<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GenderRole extends Model
{

    public static function allAsAssocArrayById()
    {
        $gender_roles=self::all();

        $gender_roles_assoc_id_arr=array();

        foreach($gender_roles as $gender_role )
        {
            $gender_roles_assoc_id_arr[$gender_role->id]=$gender_role;
        }

        return $gender_roles_assoc_id_arr;
    }
}
