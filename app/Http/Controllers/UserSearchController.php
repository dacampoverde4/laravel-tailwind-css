<?php

namespace App\Http\Controllers;

use App\Species;
use Auth;
use App\User;
use App\Usergroup;
use Newsletter;
use App\SearchResult;
use Illuminate\Http\Request;
use App\WebsiteSetting;
use App\Features;
use App\Subscription;
use App\Plan;
use App\SeekingRole;
use App\EthnicityGroup;
use App\FamilyRole;
use App\GenderRole;
use App\Trials;
use Illuminate\Support\Arr;
use App\Reportblock;
use App\Visitor;
use App\Hud;

class UserSearchController extends Controller
{

    public function __construct()
    {

    }

    private function humanTiming ($time)
    {

        $time = time() - $time; // to get the time since that moment
        $time = ($time<1)? 1 : $time;
        $tokens = array (
            31536000 => 'year',
            2592000 => 'month',
            604800 => 'week',
            86400 => 'day',
            3600 => 'hour',
            60 => 'minute',
            1 => 'second'
        );

        foreach ($tokens as $unit => $text) {
            if ($time < $unit) continue;
            $numberOfUnits = floor($time / $unit);
            return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
        }

    }

    public function index(Request $request){

        $seacrhresult = '';
        if(Auth::user()){
            $seacrhresult = SearchResult::where('user_id',Auth::user()->id)->first();
        }

        $blockIds = getblockeduser();
        if($request->usergroup){
            if(isthisSubscribed()){
                $query = User::where('group',$request->usergroup)
                       ->where('gender',$request->gender)
                       ->whereBetween('age', [intval($request->minage), intval($request->maxage)])
                       ->orderBy('last_activity', 'DESC')
                       ->where('role_id', '!=',  1 )
                       ->whereNotIn('id', $blockIds)
                       ->where('id', '!=',  Auth::user()->id );
                       //->paginate(12);

                if($request->has('species') && $request->get('species')!='') {
                    $query->where('species_id', '=',  $request->get('species') );
                }

                $users=$query->paginate(12);

            }else{
                if(Auth::user()){
                    $users = User::where('group',$request->usergroup)->orderBy('last_activity', 'DESC')->where('role_id', '!=',  1 )->where('id', '!=',  Auth::user()->id )->whereNotIn('id', $blockIds)->paginate(12);
                }
                else{
                    $users = User::where('group',$request->usergroup)->orderBy('last_activity', 'DESC')->where('role_id', '!=',  1 )->paginate(12);
                }
            }

        }
        else{

            if(Auth::user()){
                $users = User::orderBy('last_activity', 'DESC')->where('role_id', '!=',  1 )->where('id', '!=',  Auth::user()->id )->whereNotIn('id', $blockIds)->paginate(12);
            }
            else{
                $users = User::orderBy('last_activity', 'DESC')->where('role_id', '!=',  1 )->paginate(12);
            }
        }

        $advanceSearchEnableorNot = 0;
        if(Auth::user()){
            $advanceSearchEnableorNot = Features::isUserAccessSearch();
        }
        $group = Usergroup::get();

        //$genders = GenderRole::get();
        if(Auth::user()){

          $userdata = Usergroup::find(Auth::user()->group);
          if($userdata){
            $data = json_decode($userdata->genderrole);
            $searchs = json_decode($userdata->searchs);
            //$genders = GenderRole::find($data);
            $group = Usergroup::find($searchs);
          }
          else{
            //$genders = GenderRole::get();
            $group = Usergroup::get();
          }

        }

        if(Auth::user()){

        /** get User Group All subscription plans **/
        $usergroup = Usergroup::find(Auth::user()->group);
        $memberShip_plans = json_decode( $usergroup->membership_plans );
        $getAllplans = Plan::whereIn('id', $memberShip_plans)->orderBy("price", "DESC")->first();

        // get current user's subscription plans
        $user_plans = Subscription::where('user_id', Auth::user()->id)->get();
        $getUserPLans = array();
        $checkPlan = 0;
        $upgradeStatus = 0;


        //If users have any subscription plan

        if($user_plans){

             foreach($user_plans as $plan){
                // get each User plan information
                $singlePlanInfo = Plan::where('plan_id', $plan->stripe_plan)->first();

                if($singlePlanInfo){
                    // check if user plan is related to current Membership Plans
                    if(in_array($singlePlanInfo->id, $memberShip_plans)){
                            $checkPlan++;
                            array_push($getUserPLans, $singlePlanInfo->id);
                    }
                }

            }

            if($checkPlan > 0){
                $getUsersPlan = Plan::whereIn('id', $getUserPLans)->orderBy("price", "DESC")->first();

                // comapre the plan if higher amount plan exists
                if($getAllplans->price > $getUsersPlan->price){
                    $upgradeStatus = 1;
                }else{
                    $upgradeStatus = 0;
                }
            }
        }else{

            $upgradeStatus = 1;
        }
      }
      else{

        $upgradeStatus = 0;

      }

        $allgroup = Usergroup::get();
        $seekingroles  = SeekingRole::get();
        $familyroles  = FamilyRole::get();
        $species  = Species::orderBy('id', 'asc')->get();
        $ethnicityGroups = EthnicityGroup::orderBy('id', 'asc')->get();
        return view('browse', compact('users', 'group', 'seacrhresult', 'advanceSearchEnableorNot','allgroup','species','upgradeStatus','seekingroles','ethnicityGroups','familyroles'));
    }

    public function featuredmembers(Request $request){
        $users = User::orderBy('last_activity', 'DESC')->where('role_id', '!=',  1 )->paginate(12);
        return view('featuredmembers', compact('users'));
    }

    public function newBrowse(Request $request){

      $ids = array();
      $newusers=array();
      $visitids= array();
      $huds = array();
      $timeDurations = [];
      // check if user has success adoption
        if(Auth::user()){
          $user = Auth::user();
          
          $huds = $user->usergroup->getHudsCollection();
            $checkAdoption = Trials::WhereRaw('((user_id = ' . Auth::user()->id.') OR (matcher_id = ' . Auth::user()->id.' ))')
                   ->where('adopt_is_accepted', 1)
                   ->where('adopt_is_dissolve', 0)
                   ->get();
            // get user ids
            if($checkAdoption){
                foreach($checkAdoption as $adoption){
                      if($adoption->user_id == Auth::user()->id){
                          array_push($ids, $adoption->matcher_id);
                      }else{
                          array_push($ids, $adoption->user_id);
                      }
                      array_push($ids, Auth::user()->id);
                }
            }

            // get blocked users
            $blockIds = Reportblock::WhereRaw('((user_id = ' . Auth::user()->id.') OR (block_id = ' . Auth::user()->id.' ))')->pluck('block_id')->toArray();

            if(count($blockIds) > 0){
                foreach($blockIds as $key => $value){
                    array_push($ids, $value);
                }
            }

            $visitorIds = Visitor::where('user_id',Auth::user()->id)->pluck('id')->toArray();

            if(count($visitorIds) > 0){
                foreach($visitorIds as $key => $value){
                    array_push($ids, $value);
                }
            }
            if(count($ids) > 0){
                $ids = array_unique($ids);
                $query = User::WhereHasRole(['Free User'])
                       ->Where('id','!=',Auth::user()->id)
                       ->Where('name','!=','')
                       ->whereNotIn('id', $ids);
                $newusers = User::WhereHasRole(['Free User'])->whereNotIn('id', $ids)->where('profile_pic', '!=', 'default.png')->where('profile_pic', '!=', 'default.jpg')->orderBy('id', 'desc')->paginate(10);
            }else{
                $query = User::Where('id','!=',Auth::user()->id)
                       ->Where('name','!=','')
                       ->WhereHasRole(['Free User']);
                $newusers = User::WhereHasRole(['Free User'])->orderBy('id', 'desc')->where('profile_pic', '!=', 'default.png')->where('profile_pic', '!=', 'default.jpg')->paginate(10);
            }
                  $hud_search = '';
                  foreach($huds as $hud){
                    if( isset($_GET['huds-'.$hud->id]) && !empty($_GET['huds-'.$hud->id]) ){
                      $hud_search .= "'".$hud->id."',";
                    }
                  }

                  $hud_search = rtrim($hud_search,',');

                   if($hud_search!='') {
                       $query->whereIn('huds', [$hud_search]);
                   }

                   if($request->has('family_role_search') && $request->get('family_role_search')!='') {
                       // $query->where('role_id', '=',  $request->get('family_role_search') );

                      $rr = $request->get('family_role_search');
                        $query->whereHas('familyRolesUser', function($q) use ($rr)
                        {
                            $q->where('family_role_id','=', $rr);
                        }); 
                   }

                   if($request->has('male') && $request->get('male')!='') {
                       $query->whereIn('gender', [1,5,7,10,17] );
                   }

                   if($request->has('female') && $request->get('female')!='') {
                       $query->whereIn('gender', [2,6,8,9,18] );
                   }



                   

                  if( ($request->has('com_match_quest') && $request->get('com_match_quest')!='') ) {
                      $mIds = array();
                     $matchComplete = Trials::WhereRaw('((user_id != ' . Auth::user()->id.') OR (matcher_id != ' . Auth::user()->id.' ))')
                       ->where('adopt_is_accepted', 1)
                       ->where('adopt_is_dissolve', 0)
                       ->get(); 


                       // print_r($matchComplete);exit;

                      if($matchComplete){
                        foreach($matchComplete as $matc){
                          array_push($mIds, $matc->matcher_id);
                          array_push($mIds, $matc->user_id);
                        }
                      }

                      if(count($mIds)>0){
                        $mIds = array_unique($mIds);
                        $query->whereIn('id', $mIds);
                      }


                  }

                   if( ($request->has('minage_search') && $request->get('minage_search')!='')
                   && ($request->has('maxage_search') && $request->get('maxage_search')!='') ) {
                       $query->whereBetween('age', [intval($request->get('minage_search')), intval($request->get('maxage_search'))]);
                   }

                  if($request->has('ethnicity_search') && $request->get('ethnicity_search')!='') {
                      $query->where('ethnicity_group_id', '=',  $request->get('ethnicity_search') );
                  }

                  if($request->has('premium_members') && $request->get('premium_members')!='') {
                      $query->where('role_id', '=',  $request->get('premium_members') );
                  }

                  if($request->has('pride_friendly') && $request->get('pride_friendly')!='') {
                      $query->where('pride_friendly', '=',  $request->get('pride_friendly') );
                  }

                  if($request->has('species_search') && $request->get('species_search')!='') {
                      $query->where('species_id', '=',  $request->get('species_search') );
                  }

                  if($request->has('verified_members') && $request->get('verified_members')!='') {
                      $query->where('verify', '=',  $request->get('verified_members') );
                  }

                  if($request->has('profile_pic') && $request->get('profile_pic')!='') {
                      $query->where('profile_pic', '!=', 'default.png')->where('profile_pic', '!=', 'default.jpg');
                  }

                  if($request->has('recent_active') && $request->get('recent_active')!='') {
                      $query->orderBy('last_activity', 'DESC');
                  }else{
                      $query->orderBy('last_activity', 'DESC');
                  }

                  // print_r($query->toSql());
                  // print_r($query->getBindings());exit;
                  $users=$query->paginate(20);


                  // print_r($users->toArray());exit;
                  

        }else{
          //  $users = User::orderBy('last_activity', 'DESC')->where('role_id', '!=',  1 )->with('isFeatureUser')->paginate(10);
          $query = User::where('role_id', '!=',  1 )
                  ->Where('name','!=','')
                  ->Where('id','!=',Auth::user()->id)
                 ->with('isFeatureUser');

                 if($request->has('male') && $request->get('male')!='') {
                     $query->whereIn('gender', [1,5,7,10,17] );
                 }

                 if($request->has('female') && $request->get('female')!='') {
                     $query->whereIn('gender', [2,6,8,9,18] );
                 }

                 if( ($request->has('minage_search') && $request->get('minage_search')!='')
                 && ($request->has('maxage_search') && $request->get('maxage_search')!='') ) {
                     $query->whereBetween('age', [intval($request->get('minage_search')), intval($request->get('maxage_search'))]);
                 }

                if($request->has('ethnicity_search') && $request->get('ethnicity_search')!='') {
                    $query->where('ethnicity_group_id', '=',  $request->get('ethnicity_search') );
                }

                if($request->has('premium_members') && $request->get('premium_members')!='') {
                    $query->where('role_id', '=',  $request->get('premium_members') );
                }

                if($request->has('pride_friendly') && $request->get('pride_friendly')!='') {
                    $query->where('pride_friendly', '=',  $request->get('pride_friendly') );
                }

                if($request->has('species_search') && $request->get('species_search')!='') {
                    $query->where('species_id', '=',  $request->get('species_search') );
                }

                if($request->has('verified_members') && $request->get('verified_members')!='') {
                    $query->where('verify', '=',  $request->get('verified_members') );
                }

                if($request->has('profile_pic') && $request->get('profile_pic')!='') {
                      $query->where('profile_pic', '!=', 'default.png')->where('profile_pic', '!=', 'default.jpg');
                }

                if($request->has('recent_active') && $request->get('recent_active')!='') {
                    $query->orderBy('last_activity', 'DESC');
                }else{
                    $query->orderBy('last_activity', 'DESC');
                }


                $users=$query->paginate(20);
                $newusers = User::WhereHasRole(['Free User'])->where('profile_pic', '!=', 'default.png')->where('profile_pic', '!=', 'default.jpg')->orderBy('id', 'desc')->paginate(10);

        }
        
        $divs_per_row = 4;
        $allgroup = Usergroup::get();
        $seekingroles  = SeekingRole::get();
        $advanceSearchEnableorNot = 0;
        if(Auth::user()){
            $advanceSearchEnableorNot = Features::isUserAccessSearch();
        }
        $species  = Species::orderBy('id', 'asc')->get();
        if(Auth::user()){
            
            $usergroup = Usergroup::find(Auth::user()->group);
            $memberShip_plans = json_decode( $usergroup->membership_plans );
            $getAllplans = Plan::whereIn('id', $memberShip_plans)->orderBy("price", "DESC")->first();
            $user_plans = Subscription::where('user_id', Auth::user()->id)->get();
            $getUserPLans = array();
            $checkPlan = 0;
            $upgradeStatus = 0;

            if($user_plans){
                foreach($user_plans as $plan){
                    $singlePlanInfo = Plan::where('plan_id', $plan->stripe_plan)->first();
                    if($singlePlanInfo){
                        if(in_array($singlePlanInfo->id, $memberShip_plans)){
                        $checkPlan++;
                            array_push($getUserPLans, $singlePlanInfo->id);
                        }
                    }
                }
                if($checkPlan > 0){
                    $getUsersPlan = Plan::whereIn('id', $getUserPLans)->orderBy("price", "DESC")->first();
                    if($getAllplans->price > $getUsersPlan->price){
                        $upgradeStatus = 1;
                    }else{
                        $upgradeStatus = 0;
                    }
                }
            }else{
                $upgradeStatus = 1;
            }
        }else{
            $upgradeStatus = 0;
        }
        $randomUser = User::with('isFeatureUser')->inRandomOrder()->take(3)->get();
        //$randomUser = User::orderBy('last_activity', 'DESC')->where('role_id', '!=',  1 )->take(3)->get();
        $genders = GenderRole::get();
        $familyroles  = FamilyRole::get();
        $ethnicityGroups = EthnicityGroup::orderBy('id', 'asc')->get();
        $subscription = Subscription::where('user_id', Auth::user())->where('name', 'main')->first();
        
        if(count($users) > 0){
            $noresult = "";
        }else{
            $noresult = "Your search has no result. However, here are some of our active members.";

            $users = User::orderBy('last_activity', 'DESC')->where('role_id', '!=',  1 )->with('isFeatureUser')->paginate(20);
            $newusers = User::WhereHasRole(['Free User'])->where('photo_status',0)->orderBy('id', 'desc')->paginate(10);

        }
        foreach($users as $eachRecord){
            $timeDuration = $this->humanTiming(strtotime($eachRecord->last_activity));
            array_push($timeDurations, $timeDuration);
        }
    


        return view('featuredmembers-new', compact('users', 'huds', 'divs_per_row','allgroup','seekingroles','advanceSearchEnableorNot',
        'species','upgradeStatus','randomUser','familyroles','genders','ethnicityGroups',
        'subscription', 'noresult','newusers','timeDurations'));
    }

    public function newsletter(Request $request){
        $response = array('status' => 0 );
        $email = $request->email;
        if($email){
            Newsletter::subscribe($email);
            $response = array('status' => 1 );
        }
        return json_encode($response);
    }

    public function userSeekingroleDrop(Request $request){
        $seekingroles  = SeekingRole::get();
        $adopterMatches = array();
        // get Adopter matching roles
        foreach($seekingroles as $role){
            $seekingRoles = json_decode($role->usergroups);
            if($seekingRoles){
              for($i=0; $i<count($seekingRoles); $i++){
                if($seekingRoles[$i] == $request->group_id){
                    array_push($adopterMatches, $role->id);
                }
              }
            }
        }

        foreach($adopterMatches as $seekingrole_id){
              $plt=SeekingRole::find($seekingrole_id);
              $plta[]=$plt;
        }

        return $plta;

    }


    public function userSeekingHudsDrop(Request $request){

        // json_decode($request)
        // print_r(json_decode($request->get('user_groups')));exit;

        $minage = json_decode($request->get('minage'));
        $maxage = json_decode($request->get('maxage'));
        $hudsToShow =  array();

        $ug = Usergroup::where('minage','>=',$minage)->where('maxage','<=',$maxage)->get();

        // print_r($ug->toArray());exit;

        foreach ($ug as $key => $value) {
            // print($value);exit;
           
            $huds = json_decode($value->huds);
            foreach ($huds as $key => $hud) {
              $hudTitle = Hud::find($hud)->title;
                if(!in_array($hudTitle, $hudsToShow)){
                  $hudsToShow[$hud] = $hudTitle;
                }
            }
        }
        
        
        return $hudsToShow;

    }

    public function filteruser( Request $request ){


        $response = array('status' => 0);
        $group = $request->input('group');
        $gender = $request->input('gender');
        $users = User::where('group', $group)->where('gender', $gender)->get();
        if( count( $users ) ){
            ob_start();
            foreach( $users as $user ){
                ?>
                <div class="col-sm-3 col-md-3 text-center usercolumn">
                    <?php
                        $profilepic = ( $user->profile_pic )? 'uploads/'.$user->profile_pic : 'images/default.png';
                    ?>
                    <a href="<?php echo route('viewprofile', base64_encode( $user->id )); ?>">
                        <img src="<?php echo url( $profilepic ); ?>" alt="<?php echo $user->name ?>">
                        <h3><?php echo @$user->name; ?> </h3>
                        <span><?php echo @$user->usergroup->title; ?></span>
                    </a>
                </div>
            <?php
            }
            $response['htmlinfo'] =  ob_get_clean();
        }else{
            $response['htmlinfo'] =  "<span class='no_result_found'>No result found</span>";
        }
        $response['status'] =  1;
        return json_encode( $response );
    }
    public function saveSearchResult( Request $request){


        $seacrhresult = SearchResult::where('user_id',Auth::user()->id)->first();
        if($seacrhresult){
            $search = SearchResult::find($seacrhresult->id);
        }
        else{
            $search = new SearchResult;
        }

        $search->user_id = Auth::user()->id;
        $search->usergroup = Auth::user()->group;
        $search->seeking_role = $request->input('seeking_role_search');
        $search->family_role = $request->input('family_role_search');
        $search->species_id = $request->input('species_search');
        $search->minage = $request->input('minage_search');
        $search->maxage = $request->input('maxage_search');
        $search->gender = $request->input('family_role_search');

        $search->save();
        $response['status'] =  1;
        return json_encode( $response );
    }

}
