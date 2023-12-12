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
use App\Reportblock;
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
use App\SeekingRole;
use App\GenderRole;
use App\Events\UserAllNotification;
// use App\Controllers\AdoptsController;
use App\Subscription;
use App\Plan;

class HomeController extends Controller
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
        // $upcoming_events=Events::savedByUser($user_id)
        //     ->upcoming()
        //     ->orderBy('date','asc')
        //     ->limit(10)
        //     ->get();
        $upcoming_events = Events::where('suspend', 0)
                    ->upcoming()
                    ->orderBy('date', 'ASC')
                    ->limit(10)
                    ->get();
        // dd($upcoming_events);

    		if( Auth::user()->displayname === NULL ){
    			//return redirect()->to('/screenname')->with('warning', trans('Set Screen Name'));
    		}

        // Update Trial Request $status

        $this->updateTrialRequestStatus();

          $first = Reportblock::select('block_id')->where('user_id',Auth::user()->id);
          $second = Reportblock::select('user_id')->where('block_id',Auth::user()->id)
            ->union($first)
            ->pluck('user_id')->toArray();


          $allaccepted = Trials::where('matcher_id', Auth::user()->id)
            ->whereNotIn('user_id',$second)
            ->where('is_sent', 1)
            ->where('is_accepted',0)
            ->where('is_decline',0)
            ->where('is_maybe',0)
            ->where('is_ended',0)
            ->orderBy('id', 'desc')
            ->get();



           $second =  implode( ',', $second );

           if(!$second){
              $whereAdoption = '((user_id = ' . Auth::user()->id.' ) OR (matcher_id = ' . Auth::user()->id .' ))';
           }else{
              $whereAdoption = '((user_id = ' . Auth::user()->id.' AND matcher_id NOT IN ('.$second.')) OR (matcher_id = ' . Auth::user()->id .'  AND user_id NOT IN ('.$second.') ))';
           }



        $allAdoptionRequest = Trials::WhereRaw($whereAdoption)
        ->where('adoption_success', 1)
        ->where('agree',1)
        ->where('adopt_is_accepted',0)
        ->where('adopt_is_decline',0)
        ->where('adopt_is_dissolve',0)
        ->where('adopted_by','!=',Auth::user()->id)
        ->orderBy('id', 'desc')
        ->get();


        $checkTrial = Trials::orWhereRaw( $whereAdoption )
        ->where('is_success', 0)
        ->where('is_accepted',1)
        ->first();


        $deleted = Session::get('key');
        Session::forget('key');
        $user_id = Auth::user()->id;
        $likedUserList = Auth::user()->getLikeUserList();
        $newusers = User::orderBy('last_activity', 'DESC')
                    ->where('role_id', '!=',  1 )
                    ->where('id', '!=',  $user_id )
                    ->whereNotIn('id', $likedUserList)
                    ->where('profile_pic', '!=',  'default.jpg' )
                    ->whereNotNull('gender')
                    ->whereNotNull('group')
                    ->with('isFeatureUser')->limit(9)->get();
        //echo '<pre>';print_r($newusers);die;
        $activeusers = User::whereNotIn('group', [1,3])->where('photo_status', 0)->where('is_online', 1)->limit(4)->orderBy('id', 'desc')->get();
        $likes = Like::where('isliked', 1)->where('user_id', $user_id )->limit(4)->orderBy('id', 'desc')->get();
        $hearts = Heart::where('wishlistedby', $user_id)->limit(4)->orderBy('id', 'desc')->get();
        $visitors = Visitor::where('user_id', $user_id)->limit(4)->orderBy('id', 'desc')->get();
        $matches = Match::WhereRaw( ' is_match = 1 AND ( user_id = ' . $user_id .' OR  matcher_id = ' . $user_id .' )' )->orderBy('id', 'desc')->limit(4)->get();
        $blog=DB::select('SELECT blogs.*,(select count(*) from blog_comments  where blog_id = blogs.id) as count  FROM blogs  GROUP BY id LIMIT 4');
        $events = Events::with('userSaved')->orderBy('id', 'desc')->get();

        //photo_ulbum
        $photo_ulbum = Photoalbum::where('user_id', '=', $user_id)->get();
        $termContent = Page::findOrFail(config('params.pages.terms'));
        $policyContent = Page::findOrFail(config('params.pages.policy'));
        $auth_user_profile = '';
        $auth_user = Auth::user();
        $auth_user_profile = $auth_user;
        $metaDatas = array();
        $plandata = array();
        $newmetaInfo = array();
        $usersubscription = Subscription::where('user_id', Auth::user()->id)->where('name', 'main')->first();
        if(isset($usersubscription) && !empty($usersubscription)) {
          $plandata = Plan::where('plan_id', $usersubscription->stripe_plan)->first();
          $metaDatas = WebsiteSetting::where('meta_id', $plandata->id)->get();
        }

        if ($metaDatas) {
            foreach ($metaDatas as $metaData) {
                $newmetaInfo[$metaData->meta_key] = $metaData->meta_value;
            }
        }


        if(Auth::user()->role_id == 1 || Auth::user()->role_id == 3){
          return view('home', compact('activeusers', 'likes', 'hearts', 'matches', 'visitors', 'allAdoptionRequest' , 'allaccepted', 'checkTrial','upcoming_events', 'dispname', 'photo_ulbum', 'termContent', 'policyContent', 'auth_user_profile', 'plandata', 'newmetaInfo'));
        }else{

            //return view('homeuser', compact('activeusers', 'activeusers', 'likes', 'hearts', 'matches', 'visitors', 'allaccepted', 'checkTrial','upcoming_events','deleted', 'dispname', 'allAdoptionRequest','photo_ulbum', 'termContent', 'policyContent', 'auth_user_profile', 'plandata', 'newmetaInfo'));

            return view('homeusernew', compact('activeusers', 'likes', 'hearts', 'matches', 'visitors', 'allaccepted', 'checkTrial','upcoming_events','deleted', 'dispname', 'allAdoptionRequest','photo_ulbum', 'termContent', 'policyContent', 'auth_user_profile', 'plandata', 'newmetaInfo','blog','events','auth_user','newusers'));

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
        $matcherInfo = User::find($user_id);

        //get Adopter family roles
        $getFamilyRoleInfo = UsersFamilyRole::where('user_id', Auth::user()->id)->pluck('family_role_id')->toArray();
        if (count($getFamilyRoleInfo) > 0) {
            $AdopterFamilyRoles = FamilyRole::whereIn('id', $getFamilyRoleInfo)->get();
        } else {
            $AdopterFamilyRoles = array();
        }

        //get Adoptee family roles
        $getFamilyRoleInfo = UsersFamilyRole::where('user_id', $user_id)->pluck('family_role_id')->toArray();
        if (count($getFamilyRoleInfo) > 0) {
            $AdopteeFamilyRoles = FamilyRole::whereIn('id', $getFamilyRoleInfo)->get();
        } else {
            $AdopteeFamilyRoles = array();
        }

        if($request->get('action') == 'sendTrial_Request')
        {

          // send Request Trial
          $currentUser = Auth::user();
          $matcher_id = $request->get("matcher_id");
          $trial_location_id = $request->get("trial_location_id");
          $trial_date = $request->get("trial_date");
          $trial_time = $request->get("trial_time");
          $family_role_id = $request->get("adopter_familyRole");
          $adoptee_familyrole = $request->get("adoptee_familyRole");

          $traildate = date("d F, Y",strtotime($trial_date));
          $trailtime = date("h:ia", strtotime($trial_time)) .' (SLT)';

          $flag = 1;

          // match seeking roles
          $seekingrole = SeekingRole::get();

          $adopterMatches = array();
          $adopteeMatches = array();
          // get Adopter & Adoptee matching roles
          foreach($seekingrole as $role){
              $seekingRoles = json_decode($role->seeking_roles);

              if($seekingRoles){
                for($i=0; $i<count($seekingRoles); $i++){
                  if($seekingRoles[$i] == $family_role_id){
                      array_push($adopterMatches, json_decode($role->seeking_roles));
                      array_push($adopteeMatches, json_decode($role->family_roles));
                  }
                }
              }
          }

          if($adopteeMatches){
            if(count(@$adopteeMatches[0]) > 0){
                //Match Adoptee family roles
                for($i=0; $i<count($adopteeMatches[0]); $i++){

                    if($adopteeMatches[0][$i] == $adoptee_familyrole){
                        $flag = 0;
                        break;
                    }
                }
            }
          }


          $userOtherdata = User::find($request->get("matcher_id"));
          $Otheruser_genderdata = GenderRole::where('id', '=', $userOtherdata->gender)->first();
          $other_he_she = "";
          $other_his_her = "";

          if($Otheruser_genderdata != null){
            if($Otheruser_genderdata->gender == "male"){
              $other_he_she = "he";
              $other_his_her = "his";
            }if($Otheruser_genderdata->gender == "female"){
              $other_he_she = "she";
              $other_his_her = "her";
            }
          }
          $trial_locations = TrialLocation::find($request->get("trial_location_id"));
          $current_usr_fam = FamilyRole::where('id', '=', $family_role_id)->first();
          $curr_user_fam_role = $current_usr_fam->title;

          $other_usr_fam = FamilyRole::where('id', '=', $adoptee_familyrole)->first();
          $other_user_fam_role = $other_usr_fam->title;

          $admin = User::where('role_id', '=', 1)->first();
          $admin_id = $admin->id;

          if($flag == 0)
          {
            //check if trial exists
            $checkReq = Trials::WhereRaw('( (user_id = ' . Auth::user()->id .' && matcher_id = ' . $matcher_id .' ) OR (user_id = ' . $matcher_id .' && matcher_id = ' . Auth::user()->id .' ))' )->get()->last();

            if($checkReq && $checkReq->adopt_is_dissolve == 0)
            {
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
                $trial->trail_sent_at = date('Y-m-d h:i:s',time());
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
              $trial->trail_sent_at = date('Y-m-d h:i:s',time());
              $trial->trial_time = $trial_time;
              $trial->trial_family_role = $family_role_id;
              $trial->adoptee_family_role = $adoptee_familyrole;
              $trial->trial_location_id = $trial_location_id;
              $trial->save();
            }

            //notifications start
              $triallink = '<a href="'.url('/trials').'">Trial date</a>';
              $location_link = '<a href="'.url($trial_locations->address).'" target="_blank">'.$trial_locations->name.'</a>';

              if($currentUser){

                $userdata = $currentUser;
                $message = $userdata->displayname.", you've successfully scheduled a Trial Date with ".$userOtherdata->displayname.". You'll be attending the trial date as (".$curr_user_fam_role.") & ".$userOtherdata->displayname." will attend as your (".$other_user_fam_role."), once ".$other_he_she." accepts your ".$triallink." request scheduled for: ".$traildate.", ".$trailtime.", at ".$location_link;


                $userdata = $currentUser;
                $message = $userdata->displayname.", you've successfully scheduled a Trial Date with ".$userOtherdata->displayname.". You'll be attending the trial date as (".$curr_user_fam_role.") & ".$userOtherdata->displayname." will attend as your (".$other_user_fam_role."), once ".$other_he_she." accepts your trial date request scheduled for: ".$traildate.", ".$trailtime.", at ".$location_link;

                $emaildata = array(
                  'email' => $userdata->email,
                  'displayname' => $userdata->displayname,
                  'email_message' => $message
                );

                $notficationdata = array(
                  'user_id' => $userdata->id,
                  'message' => $message,
                  'type' => 'Trial',
                  'created_by' => $admin_id
                );

                $sldata = array(
                  'uuid' => $userdata->uuid,
                  'message' => $message,
                  'type' => 'Trial'
                );

                $messagedata = array(
                  'user_id' => $admin_id,
                  'reciever_id' => $userdata->id,
                  'message' => $message,
                  'type' => 'message_notification'
                );

                $allnoticationdata = array(
                  'emailtype' =>$emaildata,
                  'messagetype' =>$messagedata,
                  'notificationtype' =>$notficationdata,
                  'sl_notificationtype' =>$sldata
                );
               \Event::fire(new UserAllNotification($allnoticationdata));

              }

              if($matcher_id){
                $auth_usergenderdata = GenderRole::where('id', '=', $currentUser->gender)->first();
                $auth_he_she = "";
                $auth_his_her = "";

                if($auth_usergenderdata != null){
                  if($auth_usergenderdata->gender == "male"){
                    $auth_he_she = "He";
                    $auth_his_her = "his";
                  }if($auth_usergenderdata->gender == "female"){
                    $auth_he_she = "She";
                    $auth_his_her = "her";
                  }
                }
                $userdata = User::find($matcher_id);
                $datetime = $trial_date." ".$trial_time;
                $newdate_time = date("d F, Y h:iA", strtotime($datetime));
                $message = "Great news ".$userOtherdata->displayname."! ".$currentUser->displayname." sent you a trial date request. ".$auth_he_she." will be attending the trial date as your <b>".$curr_user_fam_role."</b> and requested that you attend as ".$auth_his_her." <b>".$other_user_fam_role.".</b> The ".$triallink." is scheduled for: ".$newdate_time." (SLT), at ".$location_link;

                $emaildata = array(
                  'email' => $userdata->email,
                  'displayname' => $userdata->displayname,
                  'email_message' => $message
                );

                $notficationdata = array(
                  'user_id' => $userdata->id,
                  'message' => $message,
                  'type' => 'Trial',
                  'created_by' => $admin_id
                );

                $sldata = array(
                  'uuid' => $userdata->uuid,
                  'message' => $message,
                  'type' => 'Trial'
                );

                $messagedata = array(
                  'user_id' => $admin_id,
                  'reciever_id' => $userdata->id,
                  'message' => $message,
                  'type' => 'message_notification'
                );

                $allnoticationdata = array(
                  'emailtype' =>$emaildata,
                  'messagetype' =>$messagedata,
                  'notificationtype' =>$notficationdata,
                  'sl_notificationtype' =>$sldata
                );
                \Event::fire(new UserAllNotification($allnoticationdata));
              }


            //notifications end

            Session::flash('message', 'Awesome '.$currentUser->display_name_on_pages.'! You\'ve successfully sent a request for a Trial Date ;)');
            return redirect('/trials');
          }else{
            $rolesText = '';
            $numItems = count($AdopteeFamilyRoles);
            $i = 0;
            foreach($AdopteeFamilyRoles as $adopteeRole){
              $rolesText .= $adopteeRole->title;
              if(++$i != $numItems) {
                $rolesText .= ', ';
              }
            }
            return back()->with('warning', 'Due to Family Roles selection, '.$matcherInfo['displayname'].' is unavailable to attend a Trial Date with you at this time. '.$matcherInfo['displayname'].'\'s family roles are ('.$rolesText.')');
          }
        }

        $locations = TrialLocation::all();
        $user = User::find($user_id);
        return view('schedule',compact('user','locations','user_id','AdopterFamilyRoles','AdopteeFamilyRoles'));
    }


  public function checkTrialFamilyRole(Request $request){


    $family_role_id = $request->get("adopter_familyRole");
    $matcher_id = $request->get("matcher_id");
    $familyRoles  = array();
    $AdopteeFamilyRoles1 = array();
    $getMatcherFamilyRole = array();

    $matchUser = User::find($matcher_id);
    //get Adoptee family roles
    $getFamilyRoleInfo = UsersFamilyRole::where('user_id', $matcher_id)->pluck('family_role_id')->toArray();
    if (count($getFamilyRoleInfo) > 0) {
        $AdopteeFamilyRoles1 = FamilyRole::whereIn('id', $getFamilyRoleInfo)->get();
        $AdopteeFamilyRoles = $AdopteeFamilyRoles1->toArray();
    } else {
        $AdopteeFamilyRoles = array();
    }

    $rolesText = '';
    $numItems = count($AdopteeFamilyRoles1);
    $i = 0;
    foreach($AdopteeFamilyRoles1 as $adopteeRole){
        $rolesText .= $adopteeRole->title;
        if(++$i != $numItems) {
          $rolesText .= ', ';
        }
    }

    // match seeking roles
    $seekingrole = SeekingRole::get();


    if($seekingrole){
        $adopterMatches = array();
        $adopteeMatches = array();
        // get Adopter & Adoptee matching roles
        foreach($seekingrole as $role){
            $seekingRoles = json_decode($role->seeking_roles);
            if($seekingRoles){
              for($i=0; $i<count($seekingRoles); $i++){
                if($seekingRoles[$i] == $family_role_id){
                    array_push($adopterMatches, json_decode($role->seeking_roles));
                    array_push($adopteeMatches, json_decode($role->family_roles));
                }
              }
            }
        }

       if(!empty($adopteeMatches)) {
          if(count($adopteeMatches[0]) > 0){
              //Match Adoptee family roles
              for($i=0; $i<count($adopteeMatches); $i++){
                  $a = @$adopteeMatches[$i] ? : [];
                    foreach ($a  as $key => $value) {
                        if(in_array($value, $getFamilyRoleInfo)){
                            $getRoleInfo = FamilyRole::where('id', $value)->first();
                            $familyRoles[] = array(
                                'id' => $getRoleInfo->id,
                                'title' => $getRoleInfo->title
                            );
                        }
                    }
              }
          }
        }else{
          $response = array(
            'status' => 'error',
            'message' => 'There is no seeking role setup by admin.'
         );
      }

      if(!empty($familyRoles)){
            $response = array(
              'status' => 'success',
              'familyRoles' => $familyRoles
            );
      }else{
          $response = array(
            'status' => 'error',
            'message' => "Due to Family Roles selection, ".$matchUser->displayname." is unavailable to attend a Trial Date with you at this time. ".$matchUser->displayname."'s family roles are (".$rolesText.")"
          );
      }
  }else{
      $response = array(
        'status' => 'error',
        'message' => 'There is no seeking role setup by admin.'
     );
  }
  return response($response);
}

	public function support()
	{
    $users = DB::table('donations')->join('users', 'donations.user_id', '=', 'users.id')->where('donations.is_supporter',1)->get();
    return view('support', compact('users'));
	}

	public function certificate()
	{
      $title_by_page = "Adoption Certificate";
	     return view('certificate', compact("title_by_page"));
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
      $title_by_page = "Adoption Certificate";

       return view('certificate', compact('certificateInfo','getTrial','title_by_page'));
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
        $recentusers = User::where('photo_status',0)->orderBy('last_activity', 'DESC')->paginate(12);
         $latesevents = Events::orderBy('id', 'desc')->whereRaw('date >= CURDATE()')->orderBy('date', 'asc')->limit(3)->get();
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


        // // Compare with security words
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

    public function updateTrialRequestStatus()
    {
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
        $message .= '<br/><div class="location-detail"><b>Trial details: </b>';
        $message .= date("d F, Y",strtotime($accept->trial_date));
        $message .= ' ,'.date("h:ia", strtotime($accept->trial_time));
        $message .= ' <a href="'.$getLocation->address.'" class="label label-info" target="_blank"><i class="fa fa-map-marker" aria-hidden="true"></i> Location</a></div>';

        //

        if($accept->user_id == Auth::user()->id){
          $sender = $accept->user_id;
          $reciver = $accept->matcher_id;
        }

        if($accept->matcher_id == Auth::user()->id){
          $sender = $accept->matcher_id;
          $reciver = $accept->user_id;
        }


        $senderUrl = url("userprofile").'/'.base64_encode($accept->user_id);
        $senderName = $accept->userid->display_name_on_pages;

        $reciverUrl = url("userprofile").'/'.base64_encode($accept->matcher_id);
        $reciverName = $accept->matcherid->display_name_on_pages;

        $senderLink = '<a href="'.$senderUrl.'">'.$senderName.'</a>';
        $reciverLink = '<a href="'.$reciverUrl.'">'.$reciverName.'</a>';

        // current user notification
        $userNotification = new Notification();
        $userNotification->user_id = $reciver;
        $userNotification->type = 'like';
        $userNotification->is_seen = 1;
        $userNotification->created_by = $sender;

        // Matcher notification
        $matcherNotification = new Notification();
        $matcherNotification->user_id = $sender;
        $matcherNotification->type = 'like';
        $matcherNotification->is_seen = 1;
        $matcherNotification->created_by = $sender;

        $senderdata = User::find($sender);
        $reciverdata = User::find($reciver);
        $admin = User::where('role_id', '=', 1)->first();
        $admin_id = $admin->id;

        if($status == 'sent'){

              $userNotification->message    = "You've sent a Trial Date Request to ".$reciverLink.".".$message;
              $matcherNotification->message = "You've received ".$senderLink." Trial Date Request.".$message;
        }

        if($status == 'ended'){

              $userNotification->message    = $reciverLink.'  has ended Trial Date Request. '.$message;
              $matcherNotification->message = "You've ended Trial Date Request.  ".$message;
        }

        if($status == 'skip'){

              $userNotification->message    = $reciverLink.'  has skipped the Trial Date. '.$message;
              $matcherNotification->message = "You've skipped a Trial Date. ".$message;
        }

        if($status == 'auto_ended')
        {
            $notif_message = "Your trial date with ".$reciverLink." has ended. You may leave a review on ".$reciverLink."’s profile when ready. Reviews are permanent and it will add to ".$reciverLink."’s adoption history.";

            $emaildata = array(
              'email' => $senderdata->email,
              'displayname' => $senderdata->displayname,
              'email_message' => $notif_message
            );

            $notficationdata = array(
              'user_id' => $senderdata->id,
              'message' => $notif_message,
              'type' => 'Trial',
              'created_by' => $admin_id
            );

            $sldata = array(
              'uuid' => $senderdata->uuid,
              'message' => $notif_message,
              'type' => 'Trial'
            );

            $messagedata = array(
              'user_id' => $admin_id,
              'reciever_id' => $senderdata->id,
              'message' => $notif_message,
              'type' => 'message_notification'
            );

            $allnoticationdata = array(
              'emailtype' =>$emaildata,
              'messagetype' =>$messagedata,
              'notificationtype' =>$notficationdata,
              'sl_notificationtype' =>$sldata
            );
            \Event::fire(new UserAllNotification($allnoticationdata));

            //$matcherNotification->message = "Your Trial Request has been Auto ended. Would you like to go on another Trial Date?".$message;
            $userNotification->message    = 'Your Trial Request has been Auto ended. Would you like to go on another Trial Date?'.$message;
            $userNotification->save();
            return back();
        }

        if($status == 'accepted'){

            $userNotification->message    = $reciverLink.' has been accepted your Trial Date successfully! '.$message;
            $matcherNotification->message = "You've accepted ".$senderLink."'s Trial Date Request successfully! ".$message;

        }

        if($status == 'declined'){

            $userNotification->message    = $reciverLink.' has been declined your Trial Date! Better Luck for next Time. '.$message;
            $matcherNotification->message = 'You\'ve declined '.$senderLink.'\'s Trial Date!.'.$message;
        }

        if($status == 'maybe'){

            $userNotification->message    = $reciverLink.' can reschedule or cancel the Trial Date in future! '.$message;
            $matcherNotification->message = "You can reschedule or cancel the ".$senderLink."'s Trial Date in future! ".$message;
        }

        if($status == 'cancel'){
            $userNotification->message    = $reciverLink.' has been cancelled your Trial Date.'.$message;
            $matcherNotification->message = 'You\'ve cancelled '.$senderLink.'\'s Trial Date.'.$message;
        }

        $userNotification->save();
        $matcherNotification->save();
    }

    public function matchquests(){
        $math_quest_categories = MatchQuestCategory::with('questions')->get();
        return view('matchquests', compact('math_quest_categories'));
    }

    // SHOW MY VISTOR PAGE
    public function visitors(){
      $user_id = Auth::user()->id;
      $visitors = Visitor::where('user_id', $user_id)->pluck('visitor_id');
      return view('user.visitors', compact('visitors'));
    }



}
