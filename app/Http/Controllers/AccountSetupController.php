<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Events\UserWasRegisteredAndVerified;
use App\FamilyRole;
use App\GenderRole;
use App\Helpers\ImageHelper;
use App\MyFun;
use App\Relationship;
use App\Occupation;
use App\Species;
use App\User;
use App\Usergroup;
use App\VerifyUser;
use App\UserMessage;
use App\Notification;
use App\trialPlans;
use App\userGroupPlan;
use App\Subscription;
use App\Plan;
use App\TrialExpires;
use App\Events\UserAllNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use App\Page;
use App\WordsSecurity;
use App\WebsiteSetting;
use App\EthnicityGroup;
use App\Hud;

class AccountSetupController extends Controller
{

    public function __construct()
    {

    }


    function clean($string) {
       // $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

       $replced =  preg_replace('/[^A-Za-z0-9\-]/', ' ', $string); // Removes special chars.
        // $final = explode(' ',$replced);
        return $replced;
    }


    public function userAvailabilityCheck(Request $request)
    {
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
            $max = '6';
        }

        $user_name="";
        if($request->has('user_name') && $request->get('user_name')!="")
            $user_name=$request->get('user_name');


        $user_id=0;
        if(Auth::check()) {
            $user=Auth::user();
            $user_id = Auth::user()->id;
        }


        $input_arr=array(
            'displayname'=>$user_name
        );
        $messages = [
            'displayname'  => 'Please provide unique username with min ' .$min.' and max '.$max.' characters',
        ];

        //bail rule - to stop running validation rules on an attribute after the first validation failure.

        $validator = Validator::make($input_arr, [
            'displayname' => 'bail|required|min:'.$min.'|max:'.$max.'|unique:users,displayname,'.$user_id,
        ],$messages);

        if ($validator->fails()) {

            if($request->ajax())
            {
                return Response::json(array(
                    'success' => false,
                    'errors' => $messages

                ), 200); //422

            }

            return redirect()->back()->withErrors($validator)->withInput();

        } else {

          $compareUsernameDisplaynameStrcmp = '';

            # $user_second_life_full_name = explode(',',preg_replace('/\s+/',' ',$user->second_life_full_name));
            $user_explode  =  $this->clean($user->second_life_full_name);
            $user_explode = explode(' ', $user_explode);

            // print_r($user_explode);exit;

            $getWords = array_merge($getWords,$user_explode);
            $getWords = strtolower(implode('|', $getWords));


          if(preg_match('('.$getWords.')', strtolower($user_name)) === 1) {
                $display_name_arr=array(
                  'displayname'=>$user_name
              );

              $display_messages = [
                  'displayname'  => 'Sorry, that username is not allowed; please choose another username.'
                  ];

              $validator = Validator::make($display_name_arr, [
                  'displayname' => 'bail|required|min:'.$min.'|max:'.$max.'|unique:users,displayname,'.$user_id,
              ],$display_messages);


                  if($request->ajax())
                  {
                      return Response::json(array(
                          'success' => false,
                          'errors' => $display_messages

                      ), 200); //422

                  }

                  return redirect()->back()->withErrors($validator)->withInput();
            }else{
                return Response::json(array(
                  'success' => true,
                  'message' => "Username available"
              ), 200);
            }


        }

    }

    public function accountSetupGetUserByToken(Request $request,$token){

        $user_return=0;

        if($request->has('user_return') && $request->get('user_return')==1)
        {
            $user_return=1;
        }

        //Session::forget('user_return_for_account_setup');

        $verify_user = VerifyUser::where('token', $token)->first();

        if($verify_user) {

            if(Auth::check()) {
                $user = Auth::user();
                auth()->logout();
            }

            $user= Auth::loginUsingId($verify_user->user_id, true);
            //$user= Auth::login($user);
            if($user){

                Session::put('user_return_for_account_setup', $user_return);

                //return redirect()->to('/admin/dashboard');
            }
            else
            {
                //user not found
            }
        }
        else
        {
            //verify not found
        }

        return redirect()->to('/admin/dashboard');

    }


    public function updateAccountSetupStepOne(Request $request)
    {

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
          $max = '5';
      }

        if(!Auth::check()) {
            return Response::json(array(
                'success' => false,
                'error' =>'Please refresh page and login.'

            ), 200); //422
        }

        $user_id=0;
        if(Auth::check()) {
            $user_id = Auth::user()->id;
        }

        $user=Auth::user();

        $user_name="";
        if($request->has('user_name') && $request->get('user_name')!="")
            $user_name=$request->get('user_name');

        $user_group="";
        if($request->has('user_group') && $request->get('user_group')!="")
            $user_group=$request->get('user_group');

        $gender="";
        if($request->has('gender') && $request->get('gender')!="")
            $gender=$request->get('gender');

        $age="";
        if($request->has('age') && $request->get('age')!="")
            $age=$request->get('age');

        $species="";
        if($request->has('species') && $request->get('species')!="")
            $species=$request->get('species');

        $ethnicity_group_id="";
            if($request->has('ethnicity_group_id') && $request->get('ethnicity_group_id')!="")
                $ethnicity_group_id=$request->get('ethnicity_group_id');

        $family_roles=array();
        if($request->has('family_roles') && $request->get('family_roles')!="")
            $family_roles=$request->get('family_roles');

        if($request->has('user_email') && $request->get('user_email')!="")
            $user_email=$request->get('user_email');







        $input_arr['displayname']=$user_name;
        $input_arr['group']=$user_group;
        $input_arr['gender']=$gender;
        $input_arr['age']=$age;
        $input_arr['family_roles']=$family_roles;
        $input_arr['species_id']=$species;
        $input_arr['ethnicity_group_id']=$ethnicity_group_id;
        if($request->has('user_email') && $request->get('user_email')!="")
        $input_arr['user_email']=$user_email;
        // $input_arr['is_account_setup']=1;

        $messages = [
            'group.required'  => 'Please choose user group.',
            'displayname.required'  => 'Please provide username.',
            'displayname.unique'  => 'Username not available.',
            'gender.required'  => 'Please select gender.',
            'age.required'  => 'Please select age.',
            'family_roles.required'  => 'Please select at least one family role.',
            'species_id.required'  => 'Please select species.',
            'ethnicity_group_id.required'  => 'Please select ethnicity.',
        ];

        //bail rule - to stop running validation rules on an attribute after the first validation failure.

        $validator = Validator::make($input_arr, [
             //'user_email' => 'email|unique:users,email,'.$user_id,
            'group' => 'bail|required',
            'displayname' => 'bail|required|min:'.$min.'|max:'.$max.'|unique:users,displayname,'.$user_id,
            'gender' => 'bail|required',
            'age' => 'bail|required',
            'family_roles' => 'bail|required',
            'species_id' => 'bail|required',
            'ethnicity_group_id' => 'bail|required',


        ],$messages);

        if ($validator->fails())
        {
            if($request->ajax())
            {
                return Response::json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()

                ), 200); //422

            }
            return Redirect::back()->withErrors($validator)->withInput();

        }

        $checkGroup = User::where('id',$user->id)->first();
        /*print_r($checkGroup->group);
        print_r($user_group);*/
        if($checkGroup->group !=$user_group){
            $userGroup = userGroupPlan::where('user_group_id',$user_group)->first();
                
                if(!empty($userGroup)){
                    $trial = trialPlans::where('id',$userGroup->trial_plan_id)->where('status',1)->first();
                    
                if($trial){
                   
                    $days = $trial->days;
                    $subscription_id = $trial->subscription_id;
                    $plan = Plan::where('id',$subscription_id)->first();
                    $date = Carbon::now();
                    $end_date = $date->addDays($days);

                    $subscription = Subscription::where('user_id',$user_id)->where('name','main')->where('isTrial',1)->first();
                        if($subscription){
                            $data1 = new TrialExpires;
                            $data1->user_id =  $user->id;
                            $data1->name = 'main';
                            $data1->stripe_id = '';
                            $data1->stripe_plan = $subscription->stripe_plan;
                            $data1->quantity = 1;
                            $data1->isTrial =$subscription->isTrial;
                            $data1->save();

                        /*********remove entry from subscription if plan has been changed********/
                        $del = Subscription::where('user_id',$user_id)->where('name','main')->where('isTrial',1)->delete();
                            $data = new Subscription;
                            $data->user_id = $user->id;
                            $data->name = 'main';
                            $data->stripe_id = '';
                            $data->stripe_plan = $plan->plan_id;
                            $data->quantity = 1;
                            $data->isTrial = 1;
                            $data->ends_at = $end_date;
                           
                            $data->save();
                        }else{
                            $data = new Subscription;
                            $data->user_id = $user->id;
                            $data->name = 'main';
                            $data->stripe_id = '';
                            $data->stripe_plan = $plan->plan_id;
                            $data->quantity = 1;
                            $data->isTrial = 1;
                            $data->ends_at = $end_date;
                            $data->save();
                        }
                            //$plan_end = Subscription::where('user_id',$user->id)->first();
                            $end_at = new Carbon($subscription->ends_at);
                            $now = Carbon::now();
                            $days = ($end_at->diff($now)->days);
                            $messageprc='';
                            
                            $admin = User::where('role_id', '=', 1)->first();
                            $admin_id = $admin->id;
                            $message = "Congratulation ".$user_name."! Your's  new plan ".$plan->name." has been successfully activated";
                            $messageprc = $message;
                            print_r($messageprc);exit;
                            /*$user_email = $data->email;
                                if(!$user_email){
                                    $emaildata = array();
                                }else{
                                    $emaildata = array(
                                        'email' => $data->email,
                                        'displayname' => $data->displayname,
                                        'email_message' => $message
                                    );
                                }

                                $messagedata = array(
                                    'user_id' => $admin_id,
                                    'reciever_id' => $id,
                                    'message' => $message,
                                    'type' => 'message_notification'
                                );

                                $notficationdata = array(
                                    'user_id' => $id,
                                    'message' => $message,
                                    'type' => 'plan_activated',
                                    'created_by' => $admin_id
                                );

                                $sldata = array(
                                    'uuid' => $data->uuid,
                                    'message' => $message,
                                    'type' => 'Plan Activated'
                                );

                                $allnoticationdata = array(
                                   'emailtype' =>$emaildata,
                                    'messagetype' =>$messagedata,
                                    'notificationtype' =>$notficationdata,
                                    'sl_notificationtype' =>$sldata
                                );

                                \Event::fire(new UserAllNotification($allnoticationdata));*/

                    }
                }
        }



         // update into db
        $user->fill($input_arr)->save();

         $user->familyRoles()->sync($family_roles);

        return Response::json(array(
            'success' => true,
            'message' => "Account updated successfully."
        ), 200);


    }


    public function updateAccountSetupStepTwo(Request $request)
    {



      $getWords = WordsSecurity::pluck('title')->toArray();

        if(!Auth::check()) {
            return Response::json(array(
                'success' => false,
                'error' =>'Please refresh page and login.'

            ), 200); //422
        }

        $user_id=0;
        if(Auth::check()) {
            $user_id = Auth::user()->id;
        }

        $user=Auth::user();

        $about="";
        if($request->has('about') && $request->get('about')!="")
            $about=$request->get('about');


            $compareAboutWordsStrcmp = '';



            $user_second_life_full_name = explode(',',preg_replace('/\s+/',' ',$user->second_life_full_name));
            if(request('name'))
            $user_second_life_full_name[] = request('name');

            $getWords = array_merge($getWords,$user_second_life_full_name);
            // print_r($getWords);exit;

            // print_r($getWords);exit;
            $compareAboutWords = preg_replace('/\b(\w*' . strtolower(implode('|', $getWords)) . '\w*)\b/', '******', strtolower(request('about')));
            $search = "******"  ;
            if (strpos($compareAboutWords, $search) !== false) {
                $compareAboutWordsStrcmp = 1;
            }


            // $compareAboutWordsStrcmp = '';

            // $user_second_life_full_name = explode(',',preg_replace('/\s+/',' ',$user->second_life_full_name));
            // $getWords = array_merge($getWords,$user_second_life_full_name);

            //   $compareAboutWords = preg_replace('/\b(\w*' . strtolower(implode('|', $getWords)) . '\w*)\b/', '', strtolower($about));
            //   if(!empty($compareAboutWords)){

            //     $compareAboutWordsStrcmp = strcmp(strtolower(preg_replace('/\s+/','',$about)), strtolower(preg_replace('/\s+/','',$compareAboutWords)));
            //   }else{
            //     $compareAboutWordsStrcmp = '-1';
            //   }

              $about = $compareAboutWords;


        $my_funs=array();
        if($request->has('my_funs') && $request->get('my_funs')!="")
            $my_funs=$request->get('my_funs');

        $relationships = null;
        if(request('relationships') && request('relationships')!="")
            $relationships=request('relationships');
        $occupations = null;
        if(request('occupations') && request('occupations')!="")
            $occupations=request('occupations');
        $terms = 0;
            if($request->has('agree') && $request->get('agree')!="")
                $terms=1;

        $pride_friendly = 0;
            if($request->has('pride_friendly') && $request->get('pride_friendly')!="")
                $pride_friendly=$request->get('pride_friendly');

        $huds=array();
            if($request->has('huds') && $request->get('huds')!="")
                $huds=$request->get('huds');

        $input_arr['about_me']=$about;
        $input_arr['myfuns']=$my_funs;
        $input_arr['relationship']=$relationships;
        $input_arr['occupation']=$occupations;
        $input_arr['agree'] = $terms;
        $input_arr['pride_friendly'] = $pride_friendly;
        $input_arr['huds'] = $huds;
        $input_arr['is_account_setup_profile'] = 1;

        $messages = [
            'about_me.required'  => 'Please provide about text.',
            'about_me.min'  => 'Please enter at least three characters for about text.',
            'my_funs.required'  => 'Please select at least one fun.',
            'huds.required'  => 'Please select at least one hud.'
        ];

        //bail rule - to stop running validation rules on an attribute after the first validation failure.
        $validator = Validator::make($input_arr, [
            'agree' =>'accepted',
            'about_me' => 'bail|required|min:3',
            'myfuns' => 'bail|required',
            'huds' => 'bail|required'


        ],$messages);

        if ($validator->fails())
        {
            if($request->ajax())
            {

              // print_r($validator->getMessageBag()->toArray());exit;
                return Response::json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()

                ), 200); //422

            }
            return Redirect::back()->withErrors($validator)->withInput();

        }
        $input_arr['myfuns']=json_encode($input_arr['myfuns']);
        $input_arr['huds']=json_encode($input_arr['huds']);
        $input_arr['verified']=1;
        
        $user->relationship = $relationships;
        $user->occupation = $occupations;
        $user->save();
        // update into db
        $user->fill($input_arr)->save();


            
        

        \Event::fire(new UserWasRegisteredAndVerified($user));

        if ($compareAboutWordsStrcmp !=0 ) {
          return Response::json(array(
              'success' => true,
              'message' => "Account updated successfully. You have used a word that is not allowed; we have filtered it!, Please remove the ****** from about for next time."
          ), 200);
        }else {
          return Response::json(array(
              'success' => true,
              'message' => "Account updated successfully."
          ), 200);
        }

    }


    public function accountSetupStepOne()
    {

        $user_id=0;
        $user=null;
        $gender_roles = null;
        $family_roles = null;
        $min_max_age_arr=null;
        $user_family_roles_id_arr=array();




        if(Auth::check()) {

            if(Auth::user()->is_account_setup == 1){
                return redirect()->route('account-setup-profile-info');
            };

            $user=Auth::user();
            $user_id = $user->id;

            if($user->group) {
                 /********get  user group*********/

                
                   

                 /**************end**********************************/   
                if ($user->usergroup) {

                    $gender_roles = $user->usergroup->getGenderRoleCollection();

                    if (count($gender_roles) > 0) {
                        $family_roles = $user->usergroup->getFamilyRoleCollection();
                        $min_max_age_arr  = $user->usergroup->getMinMaxAgeRangeArray();

                        $user_family_roles = $user->familyRoles()->get();

                        if(count($user_family_roles)>0)
                            $user_family_roles_id_arr=$user_family_roles->pluck('id')->toArray();


                        if ($user->male_female) {
                            $family_roles = $family_roles->filter(function ($item) use ($user) {
                                return $item->gender == $user->male_female;
                            })->values();
                        } else {

                            $family_roles = $family_roles->filter(function ($item) use ($gender_roles) {
                                return $item->gender == $gender_roles[0]->gender;
                            })->values();

                        }
                    } else {
                        $gender_roles = null;
                        $family_roles = null;
                    }

                }
            }
        }

        $species = Species::orderBy('id', 'asc')->get();

        $user_groups=Usergroup::allWithGenderRolesAndFamilyRoles();

        $user_groups_arr=$user_groups->toArray();

        foreach($user_groups_arr  as $k=>$user_group )
        {

            $user_groups_arr[$k]['gender_role_arr']=$user_group['gender_role_collection']->toArray();
            unset($user_groups_arr[$k]['gender_role_collection']);

            $user_groups_arr[$k]['family_role_arr']=$user_group['family_role_collection']->toArray();
            unset($user_groups_arr[$k]['family_role_collection']);

        }

        $user_groups_gender_family_roles_arr=array();

        for($i=0;$i<count($user_groups_arr);$i++)
        {

            $user_group=$user_groups_arr[$i];

            $user_group_gender_roles_arr=array();

            for($j=0;$j<count($user_group['gender_role_arr']);$j++)
            {
                $gender_role=$user_group['gender_role_arr'][$j];
                $user_group_gender_roles_arr['gender_role_'.$gender_role['id']] = array(
                    'id'=>$gender_role['id'],
                    'title'=>$gender_role['title'],
                    'gender'=>$gender_role['gender'],
                );
            }

            $user_group_family_roles_arr = array();

            for($j=0;$j<count($user_group['family_role_arr']);$j++)
            {
                $family_role=$user_group['family_role_arr'][$j];
                $user_group_family_roles_arr['family_role_'.$family_role['id']] = array(
                    'id'=>$family_role['id'],
                    'title'=>$family_role['title'],
                    'gender'=>$family_role['gender'],
                );;
            }

            $user_groups_gender_family_roles_arr['user_group_'.$user_group['id']]=array(
                'id'=>$user_group['id'],
                'title'=>$user_group['title'],
                'minage'=>$user_group['minage'],
                'maxage'=>$user_group['maxage'],
                'gender_roles'=>$user_group_gender_roles_arr,
                'family_roles'=>$user_group_family_roles_arr
            );
        }

        $user_groups_gender_family_roles_json=json_encode($user_groups_gender_family_roles_arr);

        $user_return=0;

        //user return for account setup
        if(Session::get('user_return_for_account_setup',0)==1) {
            //Session::forget('user_return_for_account_setup');
        }
        else{

        }

        $ethnicityGroups = EthnicityGroup::all();
        //die();
        $useremail = '';
        if($user && !empty($user->email)){
            $useremail = $user->email;
        }else if($user && !empty($user->user_email)){
            $useremail = $user->user_email;
        }
        $user_username = '';
        if($user && !empty($user->sl_username)){
            $user_username = $user->sl_username;
        }else if($user && !empty($user->displayname)){
            $user_username = $user->displayname;
        }

        return view('account-setup',compact(['user_id','user','user_family_roles_id_arr','user_groups','species','gender_roles','family_roles','ethnicityGroups',
            'min_max_age_arr',
            'user_groups_gender_family_roles_json', 'useremail', 'user_username']));
    }

    public function accountSetupStepTwo(){
        $user_id=0;
        $user=null;
        if(Auth::check()) {
            if(Auth::user()->is_account_setup == 1){
                return redirect()->route('home');
            };
            $user = Auth::user();
            $user_id = $user->id;
        }
        $selUserGroup = Usergroup::find($user->group);    
        $selRelationships = $selUserGroup->relationships;
        $selOccupations = $selUserGroup->occupations;
        $my_funs = MyFun::all();
        
        $occupations = Occupation::all();
        $huds = $user->usergroup->getHudsCollection();
        $termContent = Page::findOrFail(config('params.pages.terms'));
        $policyContent = Page::findOrFail(config('params.pages.policy'));
        return view('account-setup-profile-info',compact(['user_id','user','my_funs','termContent','policyContent','huds','selRelationships','occupations','selUserGroup','selOccupations']));
    }

    public function uploadProfileImageByString(Request $request)
    {
        if(!Auth::check()) {
            return Response::json(array(
                'success' => false,
                'error' =>'Please refresh page and login.'

            ), 200); //422
        }

        $user=Auth::user();

        $upload_path = public_path('/uploads');
        $user_profile_images_folder_path=$upload_path;

        if (!File::exists($user_profile_images_folder_path))
        {
            $result = File::makeDirectory($user_profile_images_folder_path, 0775, true, true);
        }

        //get all posted values
        $input_all = $request->all();

        if($request->has('image') && $request->get('image')!="") {

            $image_helper = new ImageHelper();

            $original_name=$request->get('selected_file_name');

            $data =$request->get('image');

            $original_name_without_ext=$image_helper->getImageNameWithoutExtension($original_name);

            $original_ext = $image_helper->getImageExtension($original_name);

            $filename = $image_helper->sanitize($original_name_without_ext);

            $allowed_filename = $image_helper->createUniqueFilename($filename, 'png', $user_profile_images_folder_path);

            $filename_ext = $allowed_filename . '.png' ;

            $img = Image::make($data)->save($user_profile_images_folder_path . '/' . $filename_ext);

            $original_name=$original_name_without_ext.'.png';

            //$input['original_image'] = $original_name;
            $input['profile_pic'] = $filename_ext;

            // update into db
            $user->fill($input)->save();

            return Response::json(array(
                'success' => true,
                'message' => "Profile image updated successfully.",
                'image_path'=>$user->profile_pic
            ), 200);
        }
    }


}
