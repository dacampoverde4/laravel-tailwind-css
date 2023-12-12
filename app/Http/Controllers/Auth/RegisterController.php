<?php

namespace App\Http\Controllers\Auth;

use App\Species;
use App\User;
use Auth ;
use Mail;
use App\Mail\VerifyMail;
use App\VerifyUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\WebsiteSetting;
use DB ;
use App\Subscription;

class RegisterController extends Controller
{
/*
|--------------------------------------------------------------------------
| Register Controller
|--------------------------------------------------------------------------
|
| This controller handles the registration of new users as well as their
| validation and creation. By default this controller uses a trait to
| provide this functionality without requiring any additional code.
|
*/

use RegistersUsers;

/**
* Where to redirect users after registration.
*
* @var string
*/
protected $redirectTo = '/home';

/**
* Create a new controller instance.
*
* @return void
*/
public function __construct()
{
    $this->middleware('guest');
}

/**
* Get a validator for an incoming registration request.
*
* @param  array  $data
* @return \Illuminate\Contracts\Validation\Validator
*/
protected function validator(array $data)
{
    return Validator::make($data, [
        'fullname' => 'required|unique:users,displayname|max:100|',
        'email' => 'required|string|email|max:255|unique:users',
        'user_group' => 'required|max:100|',
        'gender' => 'required|max:100|',
        'password' => 'required|string|min:6|confirmed',
    ]);
    
}

/**
* Create a new user instance after a valid registration.
*
* @param  array  $data
* @return \App\User
*/
protected function create(array $data)
{
    $user = User::create([
        'name' => $data['fullname'].' '.$data['lastname'],
        'email' => $data['email'],
        'group' => $data['user_group'],
        'species_id'=>$data['species_id'],
        'password' => bcrypt($data['password']),
        'role_id' => 4, 
        'ip_address' => \Request::ip(),

    ]);
    $default_plan_id = 'plan_DGPRyjNYWH0Y1h';
    $expiry_date = getExpiryDate($default_plan_id);
    $subscription = new Subscription;
    $subscription->user_id = $user->id;
    $subscription->name = 'main';
    $subscription->stripe_plan = $default_plan_id;
    $subscription->quantity = '1';
    $subscription->ends_at = $expiry_date;
    $subscription->save();
    
    
    $verifyUser = VerifyUser::create([
        'user_id' => $user->id,
        'token' => str_random(40)
    ]);
    
    Mail::to($user->email)->send(new VerifyMail($user));
    return $user;
}



public function verifyUser($token)
{
    $verifyUser = VerifyUser::where('token', $token)->first();
    if(isset($verifyUser) ){
        $user = $verifyUser->user;
        if(!$user->verified) {
            $verifyUser->user->verified = 1;
            $verifyUser->user->save();
            $status = trans('messages.emailVerifysuccess');
        }else{
            $status = trans('messages.emailVerifyalready');
        }
    }else{
        return redirect('/login')->with('warning', trans('messages.emailwarning'));
    }

    return redirect('/login')->with('status', $status);
}

protected function registered(Request $request, $user)
{
    $this->guard()->logout();
    $isajax = $request->input('isajax');
    if( $isajax ){
        return trans('messages.emailactivationcode');
    }else{
        return redirect('/login')->with('status', trans('messages.emailactivationcode'));
    }
    
}
public function showRegistrationForm(Request $request) {

    $usergroups = DB::table('usergroups')->get();
    $metaData = self::setMetas();
    $species = Species::orderBy('id', 'asc')->get();
    $states = DB::table("usergroups")
    ->where("title",$request->country_id)
    ->get();
    
    return view('auth.register', compact('usergroups','states','metaData','species'));
}
public function setMetas(){
        $metaDatas = WebsiteSetting::all();
        $newmetaInfo = array();
        if( $metaDatas ){
            foreach( $metaDatas as $metaData ){
                $newmetaInfo[$metaData->meta_key] = $metaData->meta_value;
            }
        }
        return $newmetaInfo;
}
}
