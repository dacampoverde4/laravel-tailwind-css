<?php

namespace App\Http\Controllers;

use Auth;
use App\Match;
use Illuminate\Http\Request;
use App\WebsiteSetting;
use App\TokenDebit;
class MatchController extends Controller
{
    public function index( $user_id = 0 ){
        if( !$user_id ){
            $user_id = Auth::user()->id;
        }
        $displaymatches = 0;
        if(Auth::user()){
          if(isthisSubscribed()){
             $getSubscriptionsmatches = WebsiteSetting::where('meta_key','sub_view_my_likes_'.getCurrentUserPlan()->id)->first();
             $displaymatches = $getSubscriptionsmatches->meta_value;
          }
          if(Auth::user()->role_id=='1'){
            $displaymatches = 1000;
          }
        }

        $data = getmanualfeatures('token_view_my_matches_');

		    $title_by_page = "My Matches";
        if ( $data ){
            $displaymatches = 1000;
        }else{
            $displaymatches = 1000;
        }
        if(Auth::user()->role_id != 1 ){
            if ( isthisSubscribed() || $data ){
                $matches = Match::WhereRaw( ' is_match = 1 AND ( user_id = ' . $user_id .' OR  matcher_id = ' . $user_id .' )' )->take($displaymatches)->get();
            }else{
              $matches = array();
            }
        } else{
            $matches = Match::WhereRaw( ' is_match = 1 AND ( user_id = ' . $user_id .' OR  matcher_id = ' . $user_id .' )' )->take($displaymatches)->get();
        }


		return view('user.myMatches', compact('matches','title_by_page'));
    }

    public static function doMatch(array $matchesdata )
    {
        $user_id = $matchesdata['user_id'];
        $data = Match::where( [ 'user_id' => $user_id, 'matcher_id' => Auth::user()->id ] )
				->orWhereRaw( ' ( matcher_id = ' . $user_id .' AND  user_id = ' . Auth::user()->id .' )' )
				->first();
		if(!$data ){
		    $data = new Match();
		    $data->user_id = Auth::user()->id;
		    $data->matcher_id = $user_id;
		}
		$data->is_match = $matchesdata['is_match'];
		$data->save();
        return true;
    }
}
