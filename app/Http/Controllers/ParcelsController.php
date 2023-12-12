<?php

namespace App\Http\Controllers;

use App\TerminalApiParcel;
use Illuminate\Http\Request;
use App\Models\Terminal_info;
use Illuminate\Support\Facades\Response;

class ParcelsController extends Controller
{
    public function index()
    {
        $parcels= Terminal_info::where('status', '=', 1)->orderBy('rank', 'DESC')->get();
        
        function unique_multi_array($array, $key) { 
            $temp_array = array(); 
            $i = 0; 
            $key_array = array(); 
            
            foreach($array as $val) { 
                if (!in_array($val[$key], $key_array)) { 
                    $key_array[$i] = $val[$key]; 
                    $temp_array[$i] = $val; 
                } 
                $i++; 
            } 
            return $temp_array; 
          }
          $parcels = unique_multi_array($parcels,'parcel_name');
        //  echo'<pre>';print_r($output);
        //   die;
        return view('parcel',compact('parcels'));
    }

    public function getParcels()
    {
        $response = array();
        $response['success']=false;

        $parcels= Terminal_info::where('status', '=', 1)->orderBy('rank', 'DESC')->get();
        $parcel_arr=array();
        function unique_multi_array($array, $key) { 
            $temp_array = array(); 
            $i = 0; 
            $key_array = array(); 
            
            foreach($array as $val) { 
                if (!in_array($val[$key], $key_array)) { 
                    $key_array[$i] = $val[$key]; 
                    $temp_array[$i] = $val; 
                } 
                $i++; 
            } 
            return $temp_array; 
          }
          $parcels = unique_multi_array($parcels,'parcel_name');
        if(count($parcels)>0)
        {

        foreach($parcels  as $parcel )
        {
                $parcel_arr[] = array(
                    'parcel_name'=>$parcel->parcel_name,
                    'url'=>$parcel->url
                );
            }


        }
       

        $parcels = array_values($parcels);

        $response['success']=true;
        $response['info']=array('parcels'=>$parcels);
        
        $response['msg']='';

        return Response::json($response, 200); 
    }
}
