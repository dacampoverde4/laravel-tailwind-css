<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Mail;
use App\User;
use Illuminate\Support\Facades\Response;
use Validator;
use Redirect;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Session;
class LoginController extends Controller
{
/*
|--------------------------------------------------------------------------
| Login Controller
|--------------------------------------------------------------------------
|
| This controller handles authenticating users for the application and
| redirecting them to your home screen. The controller uses a trait
| to conveniently provide its functionality to your applications.
|
*/

use AuthenticatesUsers;
    
    /**
    * Where to redirect users after login.
    *
    * @var string
    
    */
    
    
    // protected $redirectTo = '/securitypin';
    
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('guest')->except(['logout','authCheck']);
    }
    
    public function authenticated(Request $request, $user)
    {

        if ($user->is_deleted == 'true') {
            $user->is_deleted = 'false';
            $user->save();           
            Session::put('key', 'return back');
        }
        $user->last_login = Carbon::now()->toDateTimeString();
        $user->save();
        /*if (!$user->verified) {
            auth()->logout();
            return back()->with('warning', trans('messages.confirmmsg'));
        }
        
        if (auth()->user()->suspend == 1) {
            auth()->logout();
            return back()->with('warning', trans('messages.suspend'));
        }
        
        if (auth()->user()->is_deleted == 'true') {
            auth()->logout();
            return back()->with('warning', trans('messages.deleted'));
        }
    
        if (!$user->securitypin){
            return redirect()->to('/securitypin');
        }
        if (!$user->displayname || $user->displayname == NULL){
            return redirect()->to('/screenname');
        }*/
    
        if(auth()->user()->role_id == 1 || auth()->user()->role_id == 3){
            return redirect()->to('/admin/dashboard');
        }
        return redirect()->intended($this->redirectPath());
    }
    
    protected function credentials(Request $request)
    {
        $username = $request->get($this->username());
        $password = $request->password;
        
        $rules = [
            'email' => 'email'    
        ];
        $messages = [
            'email.email' => 'Email is invalid'
        ];
        $validator = Validator::make($request->all(),$rules,[]);

        $sl_name=str_replace(' ','',$username);
        $sl_name=str_replace('.','',$sl_name);

        $sl_name_db='';

        $users=User::whereRaw("REPLACE( `name`, '.', '' )='".$sl_name."'")->get();

        if(count($users)==1)
        {
            $sl_name_db=$users[0]->name;
        }


        if ($validator->fails())
        {
            // check login with first name & last name with dot
            if( strpos($username,'.') )
            {   
                if (Auth::attempt(['displayname' => str_replace('.',' ',$username), 'password' => $password])) {
                     $username = Auth::user()->email;
                }
            }
         
            // check login with first name & last name with space
            if (Auth::attempt(['displayname' => $username, 'password' => $password])) {
                 $username = Auth::user()->email;
            }
            
            // check login with firstname
            if (Auth::attempt(['name' => $username, 'password' => $password])) {
                 $username = Auth::user()->email;
            }

            if($sl_name_db){
                if (Auth::attempt(['name' => $sl_name_db, 'password' => $password])) {
                    $username = Auth::user()->email;
                }
            }
        }

        return [
            'email' => $username,
            'password' => $request->password,
        ];
    
    }

    /**
     * Get the failed login response instance.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    protected function sendFailedLoginResponse(Request $request)
    {
       
        return redirect()->to('/login')
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors([
                $this->username() => [trans('auth.failed')],
            ]);
            
    }

    public function authCheck()
    {
        if (!Auth::check()) {

            session(['url.intended' => url()->previous()]);

            return Response::json(array(
                'success' => false,
                'error' => ''

            ), 200); //422

        }

        return Response::json(array(
            'success' => true,
            'message' => ""
        ), 200);

    }
        
    public function logout(Request $request) {
        if( Auth::user() ){
            User::where('id', '=', Auth::user()->id)->update(['is_online' => 0, 'last_activity' => Carbon::now() ]);
        }
        Auth::logout();
        return redirect('/');
    }
    
}