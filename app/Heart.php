<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Heart extends Model
{
    public static function is_in_wishlist( $userid ){
        if( Auth::user() ){ 
            $data = Heart::where('user_id', $userid)->where('wishlistedby', Auth::user()->id)->first();
            if( $data ){
                return $data->is_in_wishlist;
            }
        }
        return false;
    }
}
