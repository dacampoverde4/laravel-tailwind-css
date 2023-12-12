<?php

namespace App\Http\Controllers;

use Auth;
use App\Visitor;
use App\Features;
use App\FeatureUses;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public static function store( $userid ){
        if( Auth::user() ){
            $isfeature = Features::validate('sub_free_profile_visit_', 'token_free_profile_visit_');
            if( !$isfeature ){
               return false;
            }
            if(Auth::user()->id != $userid){
               $find_id = Visitor::where('visitor_id', Auth::user()->id)->where('user_id', $userid)->first();
               if(empty($find_id)){
                   $data = new Visitor;
                   $data->user_id = $userid;
                   $data->visitor_id = Auth::user()->id;
                   $data->save();
    			   $feature = 'sub_free_profile_visit_';
    			   if( $isfeature == 2 ){
    					$feature = 'token_free_profile_visit_';
    				}
    				FeatureUses::storeFeatureUsase( $feature, $isfeature );
               }
           }
        }
    }
    
}
