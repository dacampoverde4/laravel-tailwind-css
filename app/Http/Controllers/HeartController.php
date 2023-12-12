<?php

namespace App\Http\Controllers;
use App\Features;
use Auth;
use App\Heart;
use Illuminate\Http\Request;

class HeartController extends Controller
{
   
    public function store(Request $request)
    {
        if( !isthisSubscribed() ){
            return $response['subscribe'] = '-1';
        }
        $response = array();
        $userid = base64_decode( $request->input('user') );
        $data = Heart::where('user_id', $userid)->where('wishlistedby', Auth::user()->id)->first();
        if( !$data ){
            $data = new Heart;
            $data->user_id = $userid;
            $response['iswished'] = $data->is_in_wishlist = 1;
            $data->wishlistedby = Auth::user()->id;
        }else{
            if( $data->is_in_wishlist ){
                $response['iswished'] = $data->is_in_wishlist = 0;
            }else{
                $response['iswished'] = $data->is_in_wishlist = 1;
            }
        }
        $data->save();
        return json_encode($response);
    }
    
     public function index( $user_id = 0 ){
        $likes = array();
        if( !$user_id ){
            $user_id = Auth::user()->id;
        } 
        $hearts = \App\Heart::where('user_id', Auth::user()->id)->where('is_seen', 1)->orderBy('id', 'desc')->get();
        return view('user.myHearts', compact('hearts') );
    }
    
}
