<?php

namespace App\Http\Controllers\Api;

use App\SecondLifeApiUsersRelation;
use App\Subscription;
use App\User;
use App\VerifyUser;
use Illuminate\Http\Request;
use App\Wallet;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use DB;
use Auth;

class SecondLifeApiController extends SecondLifeApiBaseController
{


    public function __construct()
    {
        parent::__construct();
    }


    public function verifyOtp(Request $request)
    {
        Log::info("\n in verify begin \n");
        Log::info(print_r($request->all(),true));
        Log::info("\n in verify end \n");

        $otp="";
        if($request->has('otp') && $request->get('otp')!=null)
        {
            $otp=$request->get('otp');
        }

        if(!$otp)
        {
            return $this->sendErrorResponse('Please provide OTP.');
        }


        $otp_check = User::where('otp', '=', $otp)
            ->first();

        if ($otp_check === null) {
            return $this->sendErrorResponse('OTP not found.');
        }


        $response_json = $this->sendSuccessResponse(array(),'OTP found.');


        return $response_json;

    }


    public function resetPassword(Request $request)
    {
        Log::info("\n in reset password begin \n");
        Log::info(print_r($request->all(),true));
        Log::info("\n in reset password end \n");

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

        $password="";
        if($request->has('password') && $request->get('password')!=null)
        {
            $password=$request->get('password');
        }

        if(!$password)
        {
            return $this->sendErrorResponse('Please provide password.');
        }

        $user_input['password']= bcrypt($password);

        // update into db
        $user->fill($user_input)->save();

        $response_json = $this->sendSuccessResponse(array(),'Password reset successfully.');

        return $response_json;

    }


    public function verifyOtpAndSubmitUserInfo(Request $request)
    {
        Log::info("\n in verify and submit user begin \n");
        Log::info(print_r($request->all(),true));
        Log::info("\n in verify and submit user end \n");

        $otp="";
        if($request->has('otp') && $request->get('otp')!=null)
        {
            $otp=$request->get('otp');
        }

        if(!$otp)
        {
            return $this->sendErrorResponse('Please provide OTP.');
        }

        $user = User::where('otp', '=', $otp)
            ->first();

        if ($user === null) {
            return $this->sendErrorResponse('OTP not found.');
        }

        $uuid="";
        if($request->has('uuid') && $request->get('uuid')!=null)
        {
            $uuid=$request->get('uuid');
        }

        if(!$uuid)
        {
            return $this->sendErrorResponse('Please provide UUID.');
        }

        $sl_username="";
        if($request->has('username') && $request->get('username')!=null)
        {
            $sl_username=$request->get('username');
        }

        $user_input['uuid']=$uuid;
        $user_input['sl_username']=$sl_username;
        $user_input['verified']=1;

        // update into db
        $user->fill($user_input)->save();

        $response_json = $this->sendSuccessResponse(array(),'User verified and registered.');

        return $response_json;

    }

/*
    public function createUser1(Request $request)
    {
        Log::info("\n in create user begin \n");
        Log::info(print_r($request->all(), true));
        Log::info("\n in create user end \n");

        $sl_username="";
        if($request->has('sl_username') && $request->get('sl_username')!=null)
        {
            $sl_username=$request->get('sl_username');
        }

        if(!$sl_username)
        {
            return $this->sendErrorResponse('Please provide SL username.');
        }

        $user = User::where('sl_username', '=', $sl_username)
            ->first();

        if ($user) {
            return $this->sendErrorResponse('SL username already exists.');
        }

        $uuid="";
        if($request->has('uuid') && $request->get('uuid')!=null)
        {
            $uuid=$request->get('uuid');
        }

        if(!$uuid)
        {
            return $this->sendErrorResponse('Please provide UUID.');
        }

        $email="";
        if($request->has('email') && $request->get('email')!=null)
        {
            $email=$request->get('email');
        }

        if(!$email)
        {
            return $this->sendErrorResponse('Please provide email.');
        }

        $user = User::where('email', '=', $email)
            ->first();

        if ($user) {
            return $this->sendErrorResponse('Email already exists.');
        }

        $password="";
        if($request->has('password') && $request->get('password')!=null)
        {
            $password=$request->get('password');
        }

        if(!$password)
        {
            return $this->sendErrorResponse('Please provide password.');
        }

        /*
        $site_username="";
        if($request->has('site_username') && $request->get('site_username')!=null)
        {
            $site_username=$request->get('site_username');
        }

        if(!$site_username)
        {
            return $this->sendErrorResponse('Please provide site username.');
        }
        *//*


        $user = User::create([
            'name' => $sl_username,
            'displayname' => $sl_username,
            'email' => $email,
            //'group' => $data['user_group'],
            //'gender' => $data['gender'],
            //'species_id'=>$data['species_id'],
            'password' => bcrypt($password),
            'role_id' => 4,
            'uuid' => $uuid,
            'sl_username' => $sl_username,
            'verified' => 1

        ]);


        $response_json = $this->sendSuccessResponse(array(),'User registered successfully.');

        return $response_json;

    }
*/

    public function createUser(Request $request)
    {

        Log::info("\n in create user begin \n");
        Log::info(print_r($request->all(), true));
        Log::info("\n in create user end \n");

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


        if ($user) {
            //VerifyUser::where('user_id',$user->id)->delete();
            $verify_user = VerifyUser::where('user_id', $user->id)->first();
            if(!$verify_user)
            {
                $verify_user = VerifyUser::create([
                    'user_id' => $user->id,
                    'token' => str_random(40)
                ]);
            }
            $token=$verify_user->token;
            if(!$user->verified){
                $url=URL::to('/').'/account-setup/token/'.$token.'?user_return=1';
                $message="Please setup account";
            }else{
                $url=URL::to('/home');
                $message="User already registered.";
            }
            $response_json = $this->sendSuccessResponse(array(
                "username"=>$user->name,
                "url"=>$url,
            ),$message);

        }
        else
        {
            $sl_first_name="";
            if($request->has('sl_first_name') && $request->get('sl_first_name')!=null)
            {
                $sl_first_name=$request->get('sl_first_name');
            }

            if(!$sl_first_name)
            {
                return $this->sendErrorResponse('Please provide SL first name.');
            }

            $sl_last_name="";
            if($request->has('sl_last_name') && $request->get('sl_last_name')!=null)
            {
                $sl_last_name=$request->get('sl_last_name');
            }

            if(!$sl_last_name)
            {
                return $this->sendErrorResponse('Please provide SL last name.');
            }

            $sl_username=$sl_first_name;

            if($sl_last_name)
                $sl_username.='.'.$sl_last_name;

            /*$user = User::where('name', '=', $sl_username)
                ->first();

            if ($user) {
                return $this->sendErrorResponse('SL first and last name already exists.');
            }*/

            $email="";
            if($request->has('email') && $request->get('email')!=null)
            {
                $email=$request->get('email');
            }

            if(!$email)
            {
                return $this->sendErrorResponse('Please provide email.');
            }

            $user = User::where('email', '=', $email)
                ->first();

            if ($user) {
                return $this->sendErrorResponse('Email already exists.');
            }

            $password="";
            if($request->has('password') && $request->get('password')!=null)
            {
                $password=$request->get('password');
            }

            if(!$password)
            {
                return $this->sendErrorResponse('Please provide password.');
            }

            $user = User::create([
                'name' => $sl_username,
                //'displayname' => $sl_username,
                'email' => $email,
                //'group' => $data['user_group'],
                //'gender' => $data['gender'],
                //'species_id'=>$data['species_id'],
                'password' => bcrypt($password),
                'role_id' => 4,
                'uuid' => $uuid,
                'sl_username' => $sl_username,
                'verified' => 0

            ]);

            $verify_user = VerifyUser::create([
                'user_id' => $user->id,
                'token' => str_random(40)
            ]);

            $token=$verify_user->token;

            $subscription = new Subscription;
            $subscription->user_id = $user->id;
            $subscription->name = 'main';
            $subscription->stripe_plan = 'plan_DGPRyjNYWH0Y1h';
            $subscription->quantity = '1';
            $subscription->save();

            $user->deposit(100, 'deposit', ['description' => 'Welcome Gift 100']);


            $response_json = $this->sendSuccessResponse(array(
                "username"=>$sl_username,
                "url"=>URL::to('/').'/account-setup/token/'.$token.'?user_return=0',
            ),'User registered successfully.');
        }

        return $response_json;

    }

/*
    public function updateSecondLifeApiUserRelation(Request $request){

        $uuid="";
        if($request->has('uuid') && $request->get('uuid')!=null)
        {
            $uuid=$request->get('uuid');
        }

        if(!$uuid)
        {
            return $this->sendErrorResponse('Please provide UUID.');
        }

        $server_name="";
        if($request->has('server_name') && $request->get('server_name')!=null)
        {
            $server_name=$request->get('server_name');
        }

        $email="";
        if($request->has('email') && $request->get('email')!=null)
        {
            $email=$request->get('email');
        }

        $sl_url="";
        if($request->has('sl_url') && $request->get('sl_url')!=null)
        {
            $sl_url=$request->get('sl_url');
        }

        if(!$sl_url)
        {
            return $this->sendErrorResponse('Please provide SL Url.');
        }

        $second_life_api_user_relation = SecondLifeApiUsersRelation::where('uuid', '=', $uuid)
            ->first();

        if ($second_life_api_user_relation === null) {

            $second_life_api_user_relation = SecondLifeApiUsersRelation::create([
                'uuid' => $uuid,
                'server_name' => $server_name,
                'email' => $email,
                'sl_url' => $sl_url,

            ]);

            $response_json = $this->sendSuccessResponse(array(),'Entered successfully.');
        }
        else
        {
            $second_life_api_user_relation_input['server_name']= $server_name;
            $second_life_api_user_relation_input['email']= $email;
            $second_life_api_user_relation_input['sl_url']= $sl_url;

            // update into db
            $second_life_api_user_relation->fill($second_life_api_user_relation_input)->save();

            $response_json = $this->sendSuccessResponse(array(),'Updated successfully.');
        }

        return $response_json;


    }
*/


    public function __destruct() {
        // clearing the object reference
        parent::__destruct();
    }


}
