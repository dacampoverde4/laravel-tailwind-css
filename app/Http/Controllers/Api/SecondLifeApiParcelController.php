<?php

namespace App\Http\Controllers\Api;

use App\Plan;
use App\Subscription;
use App\TerminalApiParcel;
use App\User;
use App\Models\Terminal_info;
use App\VerifyUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;

class SecondLifeApiParcelController extends SecondLifeApiBaseController
{


    public function __construct()
    {
        parent::__construct();
    }


    public function addParcelInfo(Request $request)
    {

        $uuid="";
        if($request->has('uuid') && $request->get('uuid')!=null)
        {
            $uuid=$request->get('uuid');
        }

        if(!$uuid)
        {
            return $this->sendErrorResponse('Please provide UUID.');
        }

        $user = User::where('uuid', '=', $uuid)
            ->first();

        if ($user === null) {
            return $this->sendErrorResponse('UUID not found.');
        }

        $parcel_name="";
        if($request->has('parcel_name') && $request->get('parcel_name')!=null)
        {
            $parcel_name=$request->get('parcel_name');
        }

        if(!$parcel_name)
        {
            return $this->sendErrorResponse('Please provide parcel name.');
        }

        $parcel = TerminalApiParcel::where('parcel_name', '=', $parcel_name)
            ->first();

        if ($parcel !== null) {
            return $this->sendErrorResponse('Parcel name already exists.');
        }

        $sl_url="";
        if($request->has('sl_url') && $request->get('sl_url')!=null)
        {
            $sl_url=$request->get('sl_url');
        }

        if(!$sl_url)
        {
            return $this->sendErrorResponse('Please provide sl url.');
        }

        $parcel = TerminalApiParcel::create([
            'uuid' => $uuid,
            'parcel_name' => $parcel_name,
            'sl_url' => $sl_url
        ]);

        $response_json = $this->sendSuccessResponse(array(),'Parcel info added successfully.');

        return $response_json;

    }
    
    public function addTerminalInfo(Request $request){
       
        $terminal_id="";
        if($request->has('terminal_id') && $request->get('terminal_id')!=null)
        {
            $terminal_id=$request->get('terminal_id');
            $terminal_id= preg_replace('/[^A-Za-z0-9\-]/', '', $terminal_id);
            
        }
        
        if(!$terminal_id)
        {
            return $this->sendErrorResponse('Please provide terminal_id.');
        }
        
        $parcel_name="";
        if($request->has('parcel_name') && $request->get('parcel_name')!=null)
        {
            $parcel_name=$request->get('parcel_name');
            $parcel_name= preg_replace('/[^A-Za-z0-9\-]/', ' ', $parcel_name);
        }

        if(!$parcel_name)
        {
            return $this->sendErrorResponse('Please provide parcel name.');
        }
        $region_name="";
        if($request->has('region_name') && $request->get('region_name')!=null)
        {
            $region_name=$request->get('region_name');
            $region_name= preg_replace('/[^A-Za-z0-9\-]/', ' ', $region_name);
        }
        if(!$region_name)
        {
            return $this->sendErrorResponse('Please provide region name.');
        }

        if($request->has('x') && $request->get('x')!=null)
        {
            $x=$request->get('x');
        }
        if(!$x)
        {
            return $this->sendErrorResponse('Please provide x.');
        }
        if (!in_array($x,range(0,255)) ) {
            return $this->sendErrorResponse('Please provide x range 1 t0 255.');
        }
        if($request->has('y') && $request->get('y')!=null)
        { 
            $y=$request->get('y');
        }
        if(!$y)
        {
            return $this->sendErrorResponse('Please provide y.');
        }
        if (!in_array($y,range(0,255)) ) {
            return $this->sendErrorResponse('Please provide y range 1 t0 255.');
        }
        if($request->has('z') && $request->get('z')!=null)
        {
            $z=$request->get('z');
        }
        if(!$z)
        {
            return $this->sendErrorResponse('Please provide z.');
        }
        $row=array(
                'terminal_id'=>$terminal_id,
                'region_name' => $region_name,
                'parcel_name' => $parcel_name,
                'x'=>$x,
                'y'=>$y,
                'z'=>$z
        );  

       $query= Terminal_info::updateOrCreate(
            ['terminal_id' => $row['terminal_id']],
            $row
        );
        $response_json = $this->sendSuccessResponse(array(),'Terminal info added successfully.');
        return $response_json;
        
    }
    public function usedTerminal(Request $request){
        
        $terminal_id="";
        if($request->has('terminal_id') && $request->get('terminal_id')!=null)
        {
            $terminal_id=$request->get('terminal_id');
            $terminal_id= preg_replace('/[^A-Za-z0-9\-]/', '', $terminal_id);
            
        }
        
        if(!$terminal_id)
        {
            return $this->sendErrorResponse('Please provide terminal_id.');
        }
        $terminal = Terminal_info::where('terminal_id', '=', $terminal_id)
            ->first();
        
        if (!$terminal) {
            return $this->sendErrorResponse('terminal_id not found.');
        }
        
        $crank=$terminal->rank;  
        $irank=$crank+1;
        $uterminal = Terminal_info::where('terminal_id', '=', $request->terminal_id)
            ->update(['rank' =>$irank]);  
            if (!$uterminal) {
                return $this->sendErrorResponse('terminal_id not found.');
            }
            $response_json = $this->sendSuccessResponse(array(),'Terminal position updated in the database.');
            return $response_json;  
    }
    public function deleteTerminal(Request $request){
            
        $terminal_id="";
        if($request->has('terminal_id') && $request->get('terminal_id')!=null)
        {
            $terminal_id=$request->get('terminal_id');
            $terminal_id= preg_replace('/[^A-Za-z0-9\-]/', '', $terminal_id);
            
        }
        
        if(!$terminal_id)
        {
            return $this->sendErrorResponse('Please provide terminal_id.');
        }
        $terminal = Terminal_info::where('terminal_id', '=', $terminal_id)
            ->first();
        
        if (!$terminal) {
            return $this->sendErrorResponse('terminal_id not found.');
        }
        $uterminal = Terminal_info::where('terminal_id', '=', $request->terminal_id)
            ->delete();  
            $response_json = $this->sendSuccessResponse(array(),'Terminal Removed from database.');
            return $response_json;
    }
    public function __destruct() {
        // clearing the object reference
        parent::__destruct();
    }


}
