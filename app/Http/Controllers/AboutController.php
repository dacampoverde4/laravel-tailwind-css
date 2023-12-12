<?php

namespace App\Http\Controllers;

use App\Events;
use App\Species;
use Carbon\Carbon;
use DB;
use Session;
use Redirect;
use Mail;
use Auth;
use App\Like;
use App\Match;
use App\User;
use App\Heart;
use App\Trials;
use App\VerifyUser;
use App\Usergroup;
use App\TrialLocation;
use App\Profile;
use App\Visitor;
use App\FamilyRole;
use App\UsersFamilyRole;
use App\Category;
use App\Donation;
use App\Mail\VerifyMails;
use App\WebsiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Mail\Notifications;
use App\WordsSecurity;
use App\Notification;
use App\MatchQuestCategory;
use App\Photoalbum;
use App\Page;

class AboutController extends Controller
{

    public function __construct()
    {

    }

    public function index()
    {
        $user_id=Auth::user()->id;
        $user = User::find($user_id);
        $dispname = $user->displayname;
        if ($user->is_deleted == 'true') {
          Auth::logout();
          $message = 'Your account deactivated sucessfully. Please login to Reactivate it in the future. All your data will remain on our servers.';
          return redirect()->route('welcome')->with('warning', $message);
        }
        $upcoming_events=Events::savedByUser($user_id)
            ->upcoming()
            ->orderBy('date','asc')
            ->limit(10)
            ->get();


    		if( Auth::user()->displayname === NULL ){
    			//return redirect()->to('/screenname')->with('warning', trans('Set Screen Name'));
    		}

        // Update Trial Request $status

        $this->updateTrialRequestStatus();


        $allaccepted = Trials::where('matcher_id', Auth::user()->id)
        ->where('is_sent', 1)
        ->where('is_accepted',0)
        ->where('is_decline',0)
        ->where('is_maybe',0)
        ->where('is_ended',0)
        ->orderBy('id', 'desc')
        ->get();

        $checkTrial = Trials::orWhereRaw( ' ( matcher_id = ' . Auth::user()->id .' AND  user_id = ' . Auth::user()->id .' )' )
        ->where('is_success', 0)
        ->where('is_accepted',1)
        ->first();



        $deleted = Session::get('key');
        Session::forget('key');
        $user_id = Auth::user()->id;
        $activeusers = User::where('photo_status', 0)->where('is_online', 1)->limit(6)->orderBy('id', 'desc')->get();
        $likes = Like::where('isliked', 1)->where('user_id', $user_id )->limit(6)->orderBy('id', 'desc')->get();
        $hearts = Heart::where('wishlistedby', $user_id)->limit(3)->orderBy('id', 'desc')->get();
        $visitors = Visitor::where('user_id', $user_id)->limit(3)->orderBy('id', 'desc')->get();
        $matches = Match::WhereRaw( ' is_match = 1 AND ( user_id = ' . $user_id .' OR  matcher_id = ' . $user_id .' )' )->orderBy('id', 'desc')->limit(6)->get();

        //photo_ulbum
        $photo_ulbum = Photoalbum::where('user_id', '=', $user_id)->get();
        $termContent = Page::findOrFail(config('params.pages.terms'));
        $policyContent = Page::findOrFail(config('params.pages.policy'));
        $auth_user_profile = '';
        $auth_user = Auth::user();
        $auth_user_profile = $auth_user;


        if(Auth::user()->role_id == 1 || Auth::user()->role_id == 3){
          return view('home', compact('activeusers', 'activeusers', 'likes', 'hearts', 'matches', 'visitors', 'allaccepted', 'checkTrial','upcoming_events', 'dispname', 'photo_ulbum', 'termContent', 'policyContent', 'auth_user_profile'));
        }else{
            return view('homeuser', compact('activeusers', 'activeusers', 'likes', 'hearts', 'matches', 'visitors', 'allaccepted', 'checkTrial','upcoming_events','deleted', 'dispname', 'photo_ulbum', 'termContent', 'policyContent', 'auth_user_profile'));
        }

    }
    public function team()
    {
			$staff= User::where('role_id','3')->get();
			$categories = Category::all();
			$employee = DB::table('users')->join('staff', 'users.id', '=', 'staff.staff_id')->select('users.name as staffname','users.displayname','users.profile_pic', 'users.about_me' ,'staff.*')->orderBy('staff.id', 'DESC')->limit(1)->get();

        return view('team',compact('staff','employee','categories'));
    }
	 public function teamview($id)
    {
		$cat_id=$id;
			$staff= User::where('role_id','3')->where('category_id',$cat_id)->get();
			//echo"<pre>"; print_r($staff); die ;
			$categories = Category::all();
			$employee = DB::table('users')->join('staff', 'users.id', '=', 'staff.staff_id')->select('users.name as staffname','users.displayname','users.profile_pic', 'users.about_me' ,'staff.*')->orderBy('staff.id', 'DESC')->limit(1)->get();

        return view('team',compact('staff','employee','categories','cat_id'));
    }

    public function admin()
    {
        return view('admin.newdashboard');
    }

 public function acountsetup()
    {
        return view('account-setup');
    }

 public function acountsetupnext()
    {
        return view('account-setupnext');
    }

public function about()
    {
        return view('about');
    }

	public function schedule($user_id, Request $request)
    {
        $user_id = base64_decode($user_id);

        if($request->get('action') == 'sendTrial_Request'){

          // send Request Trial
          $currentUser = Auth::user();
          $matcher_id = $request->get("matcher_id");
          $trial_location_id = $request->get("trial_location_id");
          $trial_date = $request->get("trial_date");
          $trial_time = $request->get("trial_time");
          $family_role_id = $request->get("adopter_familyRole");
          $adoptee_familyrole = $request->get("adoptee_familyRole");

          //check if trial exists
          $checkReq = Trials::WhereRaw('( (user_id = ' . Auth::user()->id .' && matcher_id = ' . $matcher_id .' ) OR (user_id = ' . $matcher_id .' && matcher_id = ' . Auth::user()->id .' ))' )->get()->first();

          if($checkReq){

              if($checkReq->user_id == Auth::user()->id){
                 $trialMessage = 'You & '.$checkReq->matcherid->display_name_on_pages.' setup a New Trial Date';
              }
              if($checkReq->matcher_id == Auth::user()->id){
                 $trialMessage = 'You & '.$checkReq->userid->display_name_on_pages.' setup a New Trial Date';
              }

              if($checkReq->is_sent == 1 && $checkReq->is_accepted == 0 && $checkReq->is_decline == 0 && $checkReq->is_maybe == 0 && $checkReq->is_success == 0 && $checkReq->is_ended == 0){
                return redirect('/trials')->with('message', $trialMessage);
              }
              //update request
              $trial = Trials::findorfail($checkReq->id);
              $trial->user_id    = $currentUser->id;
              $trial->matcher_id = $matcher_id;
              $trial->trial_date = $trial_date;
              $trial->trial_time = $trial_time;
              $trial->trial_family_role = $family_role_id;
              $trial->adoptee_family_role = $adoptee_familyrole;
              $trial->is_sent = 1;
              $trial->is_accepted = 0;
              $trial->is_decline = 0;
              $trial->is_maybe = 0;
              $trial->is_success = 0;
              $trial->is_ended = 0;
              $trial->reschedule_count = $checkReq->reschedule_count+1;
              $trial->created_at = date('Y-m-d H:i:s');
              $trial->trial_location_id = $trial_location_id;
              $trial->save();

          }else{
            $trial = new Trials();
            $trial->user_id = $currentUser->id;
            $trial->matcher_id = $matcher_id;
            $trial->trial_date = $trial_date;
            $trial->trial_time = $trial_time;
            $trial->trial_family_role = $family_role_id;
            $trial->adoptee_family_role = $adoptee_familyrole;
            $trial->trial_location_id = $trial_location_id;
            $trial->save();
          }

          Session::flash('message', 'Awesome '.$currentUser->display_name_on_pages.'! You\'ve successfully sent a request for a Trial Date ;)');
          return redirect('/trials');
        }

        //get Adopter family roles
        $getFamilyRoleInfo = UsersFamilyRole::where('user_id', Auth::user()->id)->pluck('family_role_id')->toArray();
        if (count($getFamilyRoleInfo) > 0) {
            $AdopterFamilyRoles = FamilyRole::whereIn('id', $getFamilyRoleInfo)->get();
        } else {
            $AdopterFamilyRoles = FamilyRole::all();
        }

        //get Adoptee family roles
        $getFamilyRoleInfo = UsersFamilyRole::where('user_id', $user_id)->pluck('family_role_id')->toArray();
        if (count($getFamilyRoleInfo) > 0) {
            $AdopteeFamilyRoles = FamilyRole::whereIn('id', $getFamilyRoleInfo)->get();
        } else {
            $AdopteeFamilyRoles = FamilyRole::all();
        }

        $locations = TrialLocation::all();
        $user = User::find($user_id);
        return view('schedule',compact('user','locations','user_id','AdopterFamilyRoles','AdopteeFamilyRoles'));
    }


	public function support()
	{
  $users = DB::table('donations')->join('users', 'donations.user_id', '=', 'users.id')->where('donations.is_supporter',1)->get();
    return view('support', compact('users'));
	}

	public function certificate()
	{

	     return view('certificate');
	}

  public function adoptionCertificate($id)
  {
      $certificateInfo = array();
      if($id != null){
        $id = base64_decode($id);
        $getTrial = Trials::find($id);


        if($getTrial){
            if($getTrial->is_success == 1){
                $adopterSLName = $getTrial->userid->second_life_full_name;
                $adopteeSLName = $getTrial->matcherid->second_life_full_name;

                $adopterPP = $getTrial->userid->profile_pic;
                $destinationPath = public_path('uploads');

                if (!file_exists($destinationPath.'/'.$adopterPP)) {
                    $adopterPP = 'default.jpg';
                }

                $adopteePP = $getTrial->matcherid->profile_pic;
                if (!file_exists($destinationPath.'/'.$adopteePP)) {
                    $adopteePP = 'default.jpg';
                }

                //get adopter familtRole
                $getFamilyRole = FamilyRole::find($getTrial->trial_family_role);
                $adopter_familyRole = $getFamilyRole->title;

                //get adoptee familtRole
                $getFamilyRole1 = FamilyRole::find($getTrial->adoptee_family_role);
                $adoptee_familyRole = $getFamilyRole1->title;

                // get Adopter he/shee attributes
                if($getTrial->userid->gender)
                {
                    if($getTrial->userid->usergender)
                    {
                        if($getTrial->userid->usergender->gender=='female')
                            $adopterAttr =  'She';
                        else {
                          $adopterAttr = 'He';
                        }
                    }
                }else{
                    $adopterAttr = 'He/She';
                }

                // get Adoptee he/shee attributes
                if($getTrial->matcherid->gender)
                {
                    if($getTrial->matcherid->usergender)
                    {
                        if($getTrial->matcherid->usergender->gender=='female')
                            $adopteeAttr =  'She';
                        else {
                          $adopteeAttr = 'He';
                        }
                    }
                }else{
                    $adopteeAttr = 'He/She';
                }

                $successDate = date("F d, Y  h:i A",strtotime($getTrial->success_date));

                $certificateInfo = array (
                  'adopterSLName' => $adopterSLName,
                  'adopteeSLName' => $adopteeSLName,
                  'adopterPP' => $adopterPP,
                  'adopteePP' => $adopteePP,
                  'adopter_familyrole' => $adopter_familyRole,
                  'adoptee_familyrole' =>$adoptee_familyRole,
                  'adopter_attr' => $adopterAttr,
                  'adoptee_attr' => $adopteeAttr,
                  'successDate' => $successDate
                );
            }
        }
      }
       return view('certificate', compact('certificateInfo','getTrial'));
  }

    public function pin()
    {
        return view('securitypin');
    }

    public function showpin()
    {
        return view('pinshow');
    }

    public function check(Request $request)
    {
        $pin=DB::table('users')
        ->select('*')
        ->where(['users.securitypin' =>request('pin')])
        ->get();
        foreach($pin as $row){
            if($row->securitypin==request('pin')){
                return view('checkemail',compact('pin'));
            }
        }
        return redirect()->to('/securitypin/show')->with('warning', trans('messages.wrongpin'));



    }
    public function recovery(Request $request,$email)
    {
        Mail::to($email)->send(new VerifyMails($email));

        return redirect()->to('/securitypin/show')->with('warning', trans('Check your email to verify'));
    }



    public function update(Request $request)
    {

        $request->validate([
            'pin' => 'required|max:4|min:4|unique:users,securitypin,'.Auth::user()->id,

        ]);

        $pin =User::findorfail(Auth::user()->id) ;
        $pin->securitypin = request('pin');
        $pin->save();

        return redirect('login');

    }

    public function welcome(){


        $group=Usergroup::get();
        $recentusers = User::where('photo_status',0)->orderBy('last_activity', 'DESC')->paginate(24);
         $latesevents = Events::orderBy('id', 'asc')->limit(3)->get();
   //echo"<pre>"; print_r($events); die;
        $likes = Like::whereNotIn('user_id', [1])->get();
        $userids = array();
        foreach($likes as $key=>$like){
            $userids[] = $like->user_id ;
        }
        $count = array_count_values($userids);
        count($count);
        arsort($count);
        $slicedata = array_slice($count, 0, 10, true);
        $keys = array_keys($slicedata);
        $topusers = User::find($keys);
        $species = Species::orderBy('id', 'asc')->get();
        return view('welcome',compact('group','recentusers','topusers','species','latesevents'));
    }

    public function testfunction(){
        $trials=Trials::get();
        return view('testfile',compact('trials'));
    }
    public function mail()
    {
       $test  = [1,2,3,4];
       Mail::to('securewebsaurabhnew@gmail.com')->send(new Notifications($test));

       return 'Email was sent';
    }
    public function screenname()
    {
       return view('setscreenName');
    }
    public function screennameupdate(Request $request)
    {
        $user = Auth::user();
        $getWords = WordsSecurity::pluck('title')->toArray();
        $minChar = WebsiteSetting::where('meta_key','screen_name_minimum')->first();
        $maxChar = WebsiteSetting::where('meta_key','screen_name_maximum')->first();
        if($minChar->meta_value){
            $min = $minChar->meta_value;
        }
        else{
            $min = '4';
        }
        if($maxChar->meta_value){
            $max = $maxChar->meta_value;
        }
        else{
            $max = '4';
        }

        $request->validate([
            'screenname' => 'required|max:'.$max.'|min:'.$min.'|regex:/^[A-Za-z\s-_]+$/|unique:users,displayname,'.Auth::user()->id,
        ]);
        
        /*COMPARE WORDS STARTS HERE*/
            $user_explode = explode(' ', $user->second_life_full_name);
           
            $getWords = array_merge($getWords,$user_explode);
            $getWords = strtolower(implode('|', $getWords));
            $user_name = request('screenname');

          if(preg_match('('.$getWords.')', strtolower($user_name)) === 1) { 
              
            return redirect()->back()->with('warning', 'You can not use this screen name, try another!');
                
            }


        /*COMPARE WORDS ENDS HERE*/



        // Compare with security words
        // $compareUsernameWordsStrcmp = '';
        // $user_second_life_full_name = explode(',',preg_replace('/\s+/',' ',$user->second_life_full_name));
        // $getWords = array_merge($getWords,$user_second_life_full_name);

        //  $compareWords = preg_replace('/\b(\w*' . strtolower(implode('|', $getWords)) . '\w*)\b/','',strtolower(request('screenname')));
        //  if(!empty($compareWords)){
        //    $compareUsernameWordsStrcmp = strcmp(strtolower($compareWords), strtolower(implode('|', $getWords)));
        //  }else{
        //    $compareUsernameWordsStrcmp = '-1';
        //  }

        //  if ($compareUsernameWordsStrcmp != 0) {
        //     return redirect()->back()->with('warning', 'You can not use this screen name, try another!');
        //  }





        $screenname = User::findorfail(Auth::user()->id);
        $screenname->displayname = request('screenname');
        $screenname->save();
        return redirect('login');
    }

    public function savecertificate(Request $request){

          $certImg = $request->get('imgBase64');
          $trial_id = $request->get('trial_id');

          if($certImg){

            $destinationPath = public_path("uploads").'/certificates';
            $getTrial = Trials::find($trial_id);

            if(Auth::user()->id == $getTrial->user_id){
              $file_path = 'adoption_certificate_adopter_'.$getTrial->id.'.png';
            }
            if(Auth::user()->id == $getTrial->matcher_id){
              $file_path = 'adoption_certificate_adoptee_'.$getTrial->id.'.png';
            }

            $file_path = $destinationPath.'/'.$file_path;
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $certImg = str_replace('data:image/png;base64,', '', $certImg);
            $certImg = str_replace(' ', '+', $certImg);
            $data = base64_decode($certImg);
            $success = file_put_contents($file_path, $data);

            print $success ? $file_path : 'Unable to save the file.';

          }
    }

    public function updateTrialRequestStatus(){
      // get all Trails and check their end dates
      $all = Trials::all();
      foreach($all as $trial){
        // Ends the trials after 24 hours automatically
        if($trial->is_ended != 1){

          // check end status

          if($trial->trial_end_reason != ''){
                $getTrailEndStatusDate = json_decode($trial->trial_end_reason);

                $autoEndDate = date("Y-m-d H:i:s", strtotime('+2 days', strtotime($getTrailEndStatusDate->end_date)));
                $currentDateTime = date("Y-m-d H:i:s");
                $timediff = strtotime($currentDateTime) - strtotime($autoEndDate);

                if($timediff == 0){
                      // send notification
                      $this->sendNotification($trial->id, 'cancel');
                      $getTrial->delete($trial->id);
                }

          }else{

            $planInfo = getUserPlan($trial->user_id);
            $planInfo = json_decode($planInfo);

            $planTrialDays = $planInfo->trial_period;

            $currentDateTime = date("Y-m-d H:i");

            $trialDateTime = $trial->trial_date.' '.$trial->trial_time;

            if($planTrialDays != null){
              $newTrialDate = date("Y-m-d H:i", strtotime('+'.$planTrialDays.' days', strtotime($trialDateTime)));
            }else{
              $newTrialDate = date("Y-m-d H:i", strtotime('+24 hours', strtotime($trialDateTime)));
            }

            $timediff = strtotime($currentDateTime) - strtotime($newTrialDate);

            if($timediff == 0){
                  DB::table('trials')
                  ->where('id', $trial->id)
                  ->update([
                    'is_ended' => 1,
                    'auto_ended' => 1
                  ]);
                  // send notification
                  $this->sendNotification($trial->id, 'auto_ended');
            }
          }   // end else
        }
      }// end foreach
    }

    public function sendNotification($trialId, $status){

        $accept = Trials::findorfail($trialId);

        $message = '';
        $getLocation = TrialLocation::find(  $accept->trial_location_id);
        $message = ' Trial Location: '.$getLocation->address;
        $message .= ' ,Trial Date: '.date("d F, Y",strtotime($accept->trial_date));
        $message .= ' ,Trial Time: '.date("h:ia", strtotime($accept->trial_time));

        //

        $sender = $accept->user_id;
        $reciver = $accept->matcher_id;


        // current user notification
        $userNotification = new Notification();
        $userNotification->user_id = $sender;
        $userNotification->type = 'like';
        $userNotification->is_seen = 1;
        $userNotification->created_by = $reciver;

        // Matcher notification
        $matcherNotification = new Notification();
        $matcherNotification->user_id = $reciver;
        $matcherNotification->type = 'like';
        $matcherNotification->is_seen = 1;
        $matcherNotification->created_by = $reciver;

        if($status == 'ended'){

              $userNotification->message = '  has been ended Trial Request. '.$message;
              $matcherNotification->message = " ,Your Trial Request has been ended. ".$message;
        }

        if($status == 'auto_ended'){

              $userNotification->message = '  Your Trial Request has been Auto ended. Would you like to go on another Trial Date?'.$message;
              $matcherNotification->message = " ,Your Trial Request has been Auto ended. Would you like to go on another Trial Date?".$message;
        }

        if($status == 'accepted'){

            $userNotification->message = ' has been accepted your Trial Request successfully! '.$message;
            $matcherNotification->message = "You has been accepted the Trial date Request successfully! ".$message;

        }

        if($status == 'declined'){

            $userNotification->message = ' has been declined your Trail Request! Better Luck for next Time. '.$message;
            $matcherNotification->message = ' , You has been declined Trail Request!.'.$message;
        }

        if($status == 'maybe'){

            $userNotification->message = ' can reschedule or cancel the Trail Request in future! '.$message;
            $matcherNotification->message = " , You can reschedule or cancel the Trail Request in future! ".$message;
        }

        if($status == 'cancel'){
            $userNotification->message = ' has been cancelled your Trail Request! '.$message;
            $matcherNotification->message = ' , You has been cancelled the Trail Request! '.$message;
        }
        $userNotification->save();
        $matcherNotification->save();
    }

    public function matchquests(){
        $math_quest_categories = MatchQuestCategory::with('questions')->get();
        return view('matchquests', compact('math_quest_categories'));
}

}
