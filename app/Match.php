<?php

namespace App;

use Auth;
use App\Like;
use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    public static function checkMatch($likedby){
        $likedata = Like::where( [ 'user_id' => $likedby, 'liked_by' => Auth::user()->id ] )
				->orWhereRaw( ' ( liked_by = ' . $likedby .' AND  user_id = ' . Auth::user()->id .' )' )
				->pluck('isliked')->toArray();
		if( count( $likedata ) == 2 ){
    		$likedata = array_count_values($likedata);
    		if( @$likedata['1'] ){
    		    return $likedata['1'];
    		}
		}
		return false;
    }
    
    public static function matchCount( $user_id = 0 ){
        if( !$user_id ){
            $user_id = Auth::user()->id;
        }
        return Match::WhereRaw( ' is_match = 1 AND is_decline = 0 AND ( user_id = ' . $user_id .' OR  matcher_id = ' . $user_id .' )' )
				->count();
    }
    
    public function match()
    {
        return $this->belongsTo('App\User','matcher_id');
    }
}
