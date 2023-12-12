<?php
namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use User;
class AdminLoginController extends Controller
{
  public function __construct()
  {
//$this->middleware('admin');
  }
  public function showLoginForm()
  {
    return view('auth.admin-login');
  }
  public function login(Request $request)
  {
    return $request;
    // Validate the form data
    $this->validate($request, [
        'email'   => 'required|email',
        'password' => 'required|min:6'
    ]);
     
    // Attempt to log the user in
    //if (auth::guard('web')->attempt(['role_id' => 1, 'email' => $request->email, 'password' => $request->password], $request->remember)) {
    if (auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
        $user=auth()->user()->toArray();
        if($user['role_id']==1 || $user['role_id']==3 ) {
            // if successful, then redirect to their intended location
            return redirect()->to('/home');
        }
    }
    // if unsuccessful, then redirect back to the login with the form data
    $this->logout($request);
    return redirect('/admin/login')->withInput($request->only('email', 'remember'))->with('warning', trans('messages.adminerrormsg'));;

  }


  public function logout(Request $request)
  {
    Auth::guard('web')->logout();
    $request->session()->flush();
    $request->session()->regenerate();
    return redirect()->guest(route( 'admin.login' ));
  }

}
