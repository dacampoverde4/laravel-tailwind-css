<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use App\Trials;
use App\Match;
use App\Features;
use App\FeatureUses;
use App\Notification;
use App\Like;
use Session;
use App\Reportblock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use App\User;
use App\Events\UserAllNotification;
use App\FamilyRole;

class AdoptsController extends Controller
{

    public function __construct()
    {

    }

    //Display listning in user profile
    public function index(Request $request)
    {

      //get all adoptions data
      $allrequests = Trials::WhereRaw('((user_id = ' . Auth::user()->id.') OR (matcher_id = ' . Auth::user()->id .' ))')
              ->Where('is_sent', 1)
              ->Where('is_accepted', 1)
              ->Where('is_ended', 1)
              ->Where('is_success', 1)
              ->Where('agree', 1)
              ->Where('adoption_success', 1)
              ->Where('adopt_is_dissolve', 0)
              ->latest()
              ->paginate(10);


              // remove blocked users from the Trial
              foreach($allrequests as $key=>$value){

                      $blockIds = Reportblock::WhereRaw('( (user_id = ' . $value->user_id . ' && block_id = ' . $value->matcher_id . ' ) OR (user_id = ' . $value->matcher_id . ' && block_id = ' . $value->user_id . ' ))')->get()->first();

                      if($blockIds){
                        unset($allrequests[$key]);
                      }
              }

              $title_by_page = "Adoptions";

        return view('profile.adoptions', compact('allrequests', 'title_by_page'));
    }

    public function myAdoptions(Request $request)
    {
      //get all adoptions data
      $myadoptions = Trials::WhereRaw('((user_id = ' . Auth::user()->id.') OR (matcher_id = ' . Auth::user()->id .' ))')
              ->Where('adoption_success', 1)
              ->Where('adopt_is_accepted',1)
              ->Where('adopt_is_decline',0)
              ->latest()
              ->paginate(10);


              // remove blocked users from the Trial
              foreach($myadoptions as $key=>$value){

                      $blockIds = Reportblock::WhereRaw('( (user_id = ' . $value->user_id . ' && block_id = ' . $value->matcher_id . ' ) OR (user_id = ' . $value->matcher_id . ' && block_id = ' . $value->user_id . ' ))')->get()->first();

                      if($blockIds){
                        unset($myadoptions[$key]);
                      }
              }


              $title_by_page = "My Adoptions";

        return view('profile.my_adoptions', compact('myadoptions','title_by_page'));
    }

    public function certificates(Request $request)
    {
        //get all adoptions data
        $certificates = Trials::WhereRaw('((user_id = ' . Auth::user()->id.') OR (matcher_id = ' . Auth::user()->id .' ))')
                ->where('is_success', 1)
                ->where('adopt_is_accepted', 1)
                ->where('agree',1)
                ->paginate(10);


                // remove blocked users from the Trial
                foreach($certificates as $key=>$value){

                        $blockIds = Reportblock::WhereRaw('( (user_id = ' . $value->user_id . ' && block_id = ' . $value->matcher_id . ' ) OR (user_id = ' . $value->matcher_id . ' && block_id = ' . $value->user_id . ' ))')->get()->first();

                        if($blockIds){
                          unset($certificates[$key]);
                        }
                }


              $title_by_page = "Certificates";

        return view('profile.certificates', compact('certificates', 'title_by_page'));
    }

    public function decline( $id )
    {
        $accept = Trials::findorfail($id);
        $message = '';

        //
        $sender = $accept->user_id;
        $reciver = $accept->matcher_id;

        $senderUrl = url("userprofile").'/'.base64_encode($accept->user_id);
        $senderName = $accept->userid->display_name_on_pages;

        $reciverUrl = url("userprofile").'/'.base64_encode($accept->matcher_id);
        $reciverName = $accept->matcherid->display_name_on_pages;

        $senderLink = '<a href="'.$senderUrl.'">'.$senderName.'</a>';
        $reciverLink = '<a href="'.$reciverUrl.'">'.$reciverName.'</a>';

        $accept = Trials::findorfail($id);
        // $this->sendNotification($id, 'declined');
        // $accept->delete();



        $accept->adopt_is_accepted = 0;
        $accept->adopt_is_decline = 2;
        $accept->adoption_accept_decline_at = date('Y-m-d h:i:s',strtotime(time()));
        $accept->save();

         // print_r($accept);exit;
        $this->sendNotification($id, 'declined');
        return back()->with('message', 'You Declined the '.$reciverLink.' Adoption Request');
    }


    public function accept( $id )
    {

        $accept = Trials::findorfail($id);

        $matcher =  $accept->matcher_id;
        $matcher_id = $accept->matcherid->display_name_on_pages;
        if($matcher == Auth::user()->id){
            $matcher_id = $accept->userid->display_name_on_pages;
        }
        $accept->adoption_accept_decline_at = date('Y-m-d h:i:s',time());

        $accept->adopt_is_accepted = 1;
        $accept->adopt_is_decline = 0;
        $accept->save();
        $this->sendNotification($id, 'accepted');

        return back()->with('message', 'You have accepted '.$matcher_id.' \'s Adoption request');
    }

    public function success( Request $request, $id )
    {
        $accept = Trials::findorfail($id);
        $accept->adoption_success = 1;
        $successDate = date("Y-m-d H:i:s");
        $accept->adoption_send_at = date('Y-m-d h:i:s',time());
        $accept->success_date = $successDate;
        $this->sendNotification($id, 'store');
        $accept->save();
        return back()->with('message', 'Success request');
    }

    public function dissolverequest( $id )
    {
        $user = Auth::user();
        $accept = Trials::findorfail($id);
        //$accept->adopt_is_accepted = 0;
        $accept->adopt_is_dissolve = 1;
        $accept->adopt_dissolve_by = $user->id;

        // unlike the other user profile
        if($accept->user_id == $user->id){
            $liked_by = $accept->user_id;
            $user_id  = $accept->matcher_id;
        }else{
            $user_id = $accept->user_id;
            $liked_by  = $accept->matcher_id;
        }


        // remove like
        Like::where('user_id' ,$user_id)->where('liked_by', $liked_by)->delete();
        Like::where('liked_by' ,$user_id)->where('user_id', $liked_by)->delete();
        // remove the match
        Match::whereRaw('( user_id = '. $accept->user_id .' AND matcher_id = ' . $accept->matcher_id . ' ) OR ( user_id = '. $accept->matcher_id .' AND matcher_id = '. $accept->user_id .')')->delete();

        $accept->save();

        $this->sendNotification($id, 'dissolve');
        return back()->with('message', 'Adoption has been Dissolved.');
    }

    public function cancelrequest( $id )
    {
        $accept = Trials::findorfail($id);
        $this->sendNotification($id, 'cancel');
        $accept->delete();
        return back()->with('message', 'Adoption Request has been Cancelled');
    }

    public function sendNotification($trialId, $status){//$trialId, $status
        // $trialId = 1; $status = 'accepted';
        $accept = Trials::findorfail($trialId);
        $message = '';

        //
        $sender = $accept->user_id;
        $reciver = $accept->matcher_id;

        $senderUrl = url("userprofile").'/'.base64_encode($accept->user_id);
        $senderName = $accept->userid->display_name_on_pages;

        $reciverUrl = url("userprofile").'/'.base64_encode($accept->matcher_id);
        $reciverName = $accept->matcherid->display_name_on_pages;




        if($status == 'accepted' || $status == 'declined'){
            if($accept->adopted_by == $accept->user_id){
               $sender = $accept->matcher_id;
               $reciver = $accept->user_id;
               $senderUrl = url("userprofile").'/'.base64_encode($accept->matcher_id);
               $senderName = $accept->matcherid->display_name_on_pages;
               $reciverUrl = url("userprofile").'/'.base64_encode($accept->user_id);
               $reciverName = $accept->userid->display_name_on_pages;
           }else{
               $sender = $accept->user_id;
               $reciver = $accept->matcher_id;
               $senderUrl = url("userprofile").'/'.base64_encode($accept->user_id);
               $senderName = $accept->userid->display_name_on_pages;
               $reciverUrl = url("userprofile").'/'.base64_encode($accept->matcher_id);
               $reciverName = $accept->matcherid->display_name_on_pages;
           }
        }

        if($status == 'store'){
            if($accept->adopted_by == $accept->user_id){
               $sender = $accept->user_id;
               $reciver = $accept->matcher_id;
               $senderUrl = url("userprofile").'/'.base64_encode($accept->user_id);
               $senderName = $accept->userid->display_name_on_pages;
               $reciverUrl = url("userprofile").'/'.base64_encode($accept->matcher_id);
               $reciverName = $accept->matcherid->display_name_on_pages;
           }else{
               $sender = $accept->matcher_id;
               $reciver = $accept->user_id;
               $senderUrl = url("userprofile").'/'.base64_encode($accept->matcher_id);
               $senderName = $accept->matcherid->display_name_on_pages;
               $reciverUrl = url("userprofile").'/'.base64_encode($accept->user_id);
               $reciverName = $accept->userid->display_name_on_pages;
           }
        }

        if($status == 'dissolve'){

          $other_user = ($accept->user_id == $accept->adopt_dissolve_by) ? $accept->matcher_id : $accept->user_id;
          $sender = $accept->adopt_dissolve_by;
          $reciver = $other_user;


          if(Auth::user()->id == $accept->user_id){
            $senderUrl = url("userprofile").'/'.base64_encode($accept->user_id);
            $senderName = $accept->userid->display_name_on_pages;
            $reciverUrl = url("userprofile").'/'.base64_encode($accept->matcher_id);
            $reciverName = $accept->matcherid->display_name_on_pages;
          }else{
            $senderUrl = url("userprofile").'/'.base64_encode($accept->matcher_id);
            $senderName = $accept->matcherid->display_name_on_pages;
            $reciverUrl = url("userprofile").'/'.base64_encode($accept->user_id);
            $reciverName = $accept->userid->display_name_on_pages;
        }

      }

        $senderLink = '<a href="'.$senderUrl.'">'.$senderName.'</a>';
        $reciverLink = '<a href="'.$reciverUrl.'">'.$reciverName.'</a>';


        // echo "$reciverLink";exit;
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


        $admin = User::where('role_id', '=', 1)->first();
        $admin_id = $admin->id;
        $senderdata = User::find($sender);
        $reciverdata = User::find($reciver);

        $certificate_link = '<a href='.url('certificate').'/'.base64_encode($accept->id).'>Certificates</a>';
        $sender_profile_url = '<a href='.url("userprofile").'/'.base64_encode($senderdata->id).'>'.$senderdata->displayname.'</a>';
        $reciver_profile_url = '<a href='.url("userprofile").'/'.base64_encode($reciverdata->id).'>'.$reciverdata->displayname.'</a>';


        if($status == 'accepted')
        {
            if($sender)
            {
                $user_message_notification = $sender_profile_url.", your adoption certificate is ready! Download & share it with the world... ".$certificate_link;

                $user_email = $senderdata->user_email;
                if(!$user_email){
                    $emaildata = array();
                }else{
                    $emaildata = array(
                        'email' => $senderdata->user_email,
                        'displayname' => $senderdata->displayname,
                        'email_message' => $user_message_notification
                    );
                }

                $notficationdata = array(
                    'user_id' => $senderdata->id,
                    'message' => $user_message_notification,
                    'type' => 'adopt',
                    'created_by' => $admin_id
                );
                $sldata = array(
                    'uuid' => $senderdata->uuid,
                    'message' => $user_message_notification,
                    'type' => 'adopt'
                );
                $messagedata = array(
                    'user_id' => $admin_id,
                    'reciever_id' => $senderdata->id,
                    'message' => $user_message_notification,
                    'type' => 'message_notification'
                );
                $allnoticationdata = array(
                    'emailtype' =>$emaildata,
                    'messagetype' =>$messagedata,
                    'notificationtype' =>$notficationdata,
                    'sl_notificationtype' =>$sldata
                );
                \Event::fire(new UserAllNotification($allnoticationdata));
                //$matcherNotification->message = "You've accepted ".$reciverLink."'s adoption request ".$message;
            }

            if($reciver)
            {
                $user_message_notification = $reciver_profile_url.", this is the moment we’ve been waiting for… Your adoption process with ".$sender_profile_url." is successful. However, this doesn’t mean that our journey ends here… We’d love to stay in the loop and make sure that your adoption experience goes well. You may leave a review on ".$sender_profile_url."’s profile when ready. Reviews are permanent and it will add to ".$sender_profile_url."’s adoption History.";

                $user_email = $reciverdata->user_email;
                if(!$user_email){
                    $emaildata = array();
                }else{
                    $emaildata = array(
                        'email' => $reciverdata->user_email,
                        'displayname' => $reciverdata->displayname,
                        'email_message' => $user_message_notification
                    );
                }

                $notficationdata = array(
                    'user_id' => $reciverdata->id,
                    'message' => $user_message_notification,
                    'type' => 'adopt',
                    'created_by' => $admin_id
                );
                $sldata = array(
                    'uuid' => $reciverdata->uuid,
                    'message' => $user_message_notification,
                    'type' => 'adopt'
                );
                $messagedata = array(
                    'user_id' => $admin_id,
                    'reciever_id' => $reciverdata->id,
                    'message' => $user_message_notification,
                    'type' => 'message_notification'
                );
                $allnoticationdata = array(
                    'emailtype' =>$emaildata,
                    'messagetype' =>$messagedata,
                    'notificationtype' =>$notficationdata,
                    'sl_notificationtype' =>$sldata
                );
                \Event::fire(new UserAllNotification($allnoticationdata));
                //$userNotification->message = $senderLink.' accepted your adoption request ';
            }
            return back();
        }

        if($status == 'declined')
        {
            $browseLink = '<a href="'.url("browse").'">Browse more members </a>';
            $user_message_notification = $reciver_profile_url.", it seems ".$sender_profile_url." skipped out on the adoption process. Let's find someone else to match with. ".$browseLink;

            $user_email = $reciverdata->user_email;
            if(!$user_email){
                $emaildata = array();
            }else{
                $emaildata = array(
                    'email' => $reciverdata->user_email,
                    'displayname' => $reciverdata->displayname,
                    'email_message' => $user_message_notification
                );
            }

            $notficationdata = array(
                'user_id' => $reciverdata->id,
                'message' => $user_message_notification,
                'type' => 'adopt',
                'created_by' => $admin_id
            );
            $sldata = array(
                'uuid' => $reciverdata->uuid,
                'message' => $user_message_notification,
                'type' => 'adopt'
            );
            $messagedata = array(
                'user_id' => $admin_id,
                'reciever_id' => $reciverdata->id,
                'message' => $user_message_notification,
                'type' => 'message_notification'
            );
            $allnoticationdata = array(
                'emailtype' =>$emaildata,
                'messagetype' =>$messagedata,
                'notificationtype' =>$notficationdata,
                'sl_notificationtype' =>$sldata
            );
            \Event::fire(new UserAllNotification($allnoticationdata));

            //$userNotification->message = $senderLink.' declined your adoption request! Better Luck for next Time. '. $browseLink;
            $matcherNotification->message =   "You've successfully declined ".$reciverLink."'s adoption request.";
            $matcherNotification->save();
            return back();
        }

        if($status == 'cancel'){
            $matcherNotification->message = $senderLink.' cancelled your Adoption';
            $userNotification->message = "You has been cancelled the Adoption";
        }

        if($status == 'dissolve')
        {
            $sender_dissolvedata = User::find($sender);
            $reciever_dissolvedata = User::find($reciver);
            $senderProfileLink = '<a href="'.url("userprofile").'/'.base64_encode($sender_dissolvedata->id).'">'.$sender_dissolvedata->displayname.'</a>';
            $reciverProfileLink = '<a href="'.url("userprofile").'/'.base64_encode($reciever_dissolvedata->id).'">'.$reciever_dissolvedata->displayname.'</a>';

            if($sender)
            {
                if($reciver == $accept->matcher_id)
                {
                    $reciver_fam_role =  FamilyRole::find($accept->adoptee_family_role)->title;
                    $reciver_gender =  FamilyRole::find($accept->adoptee_family_role)->gender;
                }else{
                    $reciver_fam_role =  FamilyRole::find($accept->trial_family_role)->title;
                    $reciver_gender =  FamilyRole::find($accept->trial_family_role)->gender;
                }

                $he_she = "";
                if($reciver_gender == "male")
                {
                    $he_she = "he";
                }
                if($reciver_gender == "female")
                {
                    $he_she = "she";
                }

                $msg_notification = $senderProfileLink." you've successfully dissolved the adoption of ".$reciverProfileLink." and ".$he_she." is no longer your ".$reciver_fam_role.". Would you like to leave an adoption review for ".$reciverProfileLink."?";

                $user_email = $sender_dissolvedata->user_email;
                if(!$user_email){
                    $emaildata = array();
                }else{
                    $emaildata = array(
                        'email' => $sender_dissolvedata->user_email,
                        'displayname' => $sender_dissolvedata->displayname,
                        'email_message' => $msg_notification
                    );
                }

                $notficationdata = array(
                    'user_id' => $sender_dissolvedata->id,
                    'message' => $msg_notification,
                    'type' => 'adopt',
                    'created_by' => $admin_id
                );
                $sldata = array(
                    'uuid' => $sender_dissolvedata->uuid,
                    'message' => $msg_notification,
                    'type' => 'adopt'
                );
                $messagedata = array(
                    'user_id' => $admin_id,
                    'reciever_id' => $sender_dissolvedata->id,
                    'message' => $msg_notification,
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

            if($reciver)
            {
                if($reciver == $accept->matcher_id)
                {
                    $reciver_fam_role =  FamilyRole::find($accept->trial_family_role)->title;
                    $reciver_gender =  FamilyRole::find($accept->trial_family_role)->gender;
                }else{
                    $reciver_fam_role =  FamilyRole::find($accept->adoptee_family_role)->title;
                    $reciver_gender =  FamilyRole::find($accept->adoptee_family_role)->gender;
                }

                $he_she = "";
                if($reciver_gender == "male")
                {
                    $he_she = "he";
                }
                if($reciver_gender == "female")
                {
                    $he_she = "she";
                }

                $msg_notification = $senderProfileLink.", dissolved your adoption and ".$he_she." is no longer your ".$reciver_fam_role.". Would you like to leave an adoption review for ".$senderProfileLink."?";

                $user_email = $reciever_dissolvedata->user_email;
                if(!$user_email){
                    $emaildata = array();
                }else{
                    $emaildata = array(
                        'email' => $reciever_dissolvedata->user_email,
                        'displayname' => $reciever_dissolvedata->displayname,
                        'email_message' => $msg_notification
                    );
                }

                $notficationdata = array(
                    'user_id' => $reciever_dissolvedata->id,
                    'message' => $msg_notification,
                    'type' => 'adopt',
                    'created_by' => $admin_id
                );
                $sldata = array(
                    'uuid' => $reciever_dissolvedata->uuid,
                    'message' => $msg_notification,
                    'type' => 'adopt'
                );
                $messagedata = array(
                    'user_id' => $admin_id,
                    'reciever_id' => $reciever_dissolvedata->id,
                    'message' => $msg_notification,
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
            /*$userNotification->message = $senderLink.' dissolved your Adoption';
            $matcherNotification->message = "You've dissolved an adoption with ".$reciverLink;*/
            return back();
        }

        if($status == 'store')
        {
            $login_id = Auth::user()->id;
            if($login_id == $sender){
                $request_user = $sender;
                $reciever_user = $reciver;
            }else{
                $request_user = $reciver;
                $reciever_user = $sender;
            }

            $request_userdata = User::find($request_user);
            $reciever_userdata = User::find($reciever_user);
            $adoptLink = '<a href="'.url("adopts").'">Adopt</a>';

            if($request_user)
            {
                if($reciever_user == $accept->matcher_id)
                {
                    $reciver_fam_role =  FamilyRole::find($accept->adoptee_family_role)->title;
                    $reciver_gender =  FamilyRole::find($accept->adoptee_family_role)->gender;
                }else{
                    $reciver_fam_role =  FamilyRole::find($accept->trial_family_role)->title;
                    $reciver_gender =  FamilyRole::find($accept->trial_family_role)->gender;
                }

                $he_she = "";
                if($reciver_gender == "male")
                {
                    $he_she = "he";
                }
                if($reciver_gender == "female")
                {
                    $he_she = "she";
                }

                $msg_notification = $request_userdata->displayname.", would you like to adopt ".$reciever_userdata->displayname." as your ".$reciver_fam_role."? ".$he_she." is requesting to be adopted by you. ".$adoptLink;
                $user_email = $request_userdata->user_email;
                if(!$user_email){
                    $emaildata = array();
                }else{
                    $emaildata = array(
                        'email' => $request_userdata->user_email,
                        'displayname' => $request_userdata->displayname,
                        'email_message' => $msg_notification
                    );
                }

                $notficationdata = array(
                    'user_id' => $request_userdata->id,
                    'message' => $msg_notification,
                    'type' => 'adopt',
                    'created_by' => $admin_id
                );
                $sldata = array(
                    'uuid' => $request_userdata->uuid,
                    'message' => $msg_notification,
                    'type' => 'adopt'
                );
                $messagedata = array(
                    'user_id' => $admin_id,
                    'reciever_id' => $request_userdata->id,
                    'message' => $msg_notification,
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

            if($reciever_user)
            {
                if($reciever_user == $accept->matcher_id)
                {
                    $reciver_fam_role =  FamilyRole::find($accept->trial_family_role)->title;
                    $reciver_gender =  FamilyRole::find($accept->trial_family_role)->gender;
                }else{
                    $reciver_fam_role =  FamilyRole::find($accept->adoptee_family_role)->title;
                    $reciver_gender =  FamilyRole::find($accept->adoptee_family_role)->gender;
                }

                $he_she = "";
                if($reciver_gender == "male")
                {
                    $he_she = "he";
                }
                if($reciver_gender == "female")
                {
                    $he_she = "she";
                }

                $msg_notification = $reciever_userdata->displayname.", would you like to be your ".$reciver_fam_role.". Do you want to be adopted by ".$request_userdata->displayname."? ".$adoptLink;

                $user_email = $reciever_userdata->user_email;
                if(!$user_email){
                    $emaildata = array();
                }else{
                    $emaildata = array(
                        'email' => $reciever_userdata->user_email,
                        'displayname' => $reciever_userdata->displayname,
                        'email_message' => $msg_notification
                    );
                }

                $notficationdata = array(
                    'user_id' => $reciever_userdata->id,
                    'message' => $msg_notification,
                    'type' => 'adopt',
                    'created_by' => $admin_id
                );
                $sldata = array(
                    'uuid' => $reciever_userdata->uuid,
                    'message' => $msg_notification,
                    'type' => 'adopt'
                );
                $messagedata = array(
                    'user_id' => $admin_id,
                    'reciever_id' => $reciever_userdata->id,
                    'message' => $msg_notification,
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
            /*$userNotification->message = $senderLink.' sent you an Adoption';
            $matcherNotification->message = "You've sent adoption to ".$reciverLink;*/
            return back();
        }


        $userNotification->save();
        $matcherNotification->save();
    }

    public function adminindex(Request $request){
        $allAdoptRequests = Trials::where('adoption_success', 1)->get();
        return view('admin.adoptrequests', compact('allAdoptRequests'));
    }
    public function adminCancelRequest( $id )
    {
        $accept = Trials::findorfail($id);
        $accept->delete();
        return back()->with('message', 'Adoption Request has been Cancelled');
    }

    public function adoptAdopteeRequest(Request $request)
    {
        $agree="";
        if($request->has('agree') && $request->get('agree')!=null)
        {
            $agree = $request->get('agree');
        }

        if(!$agree){
            $data = new \stdClass();
            $data->status = 400;
            $data->message = "Please check terms and conditions.";
            return response()->json($data);exit;
        }

        $trial="";
        if($request->has('trial') && $request->get('trial')!=null)
        {
            $id = $request->get('trial');
        }


          if($id){
            $accept = Trials::findorfail($id);
            $accept->success_date = date("Y-m-d H:i:s");
            $accept->agree = $agree;
            $accept->adoption_send_at = date('Y-m-d h:i:s',time());
            $accept->adopted_by = Auth::user()->id;
            $accept->adoption_success = 1;
            // $accept->adoptee_family_role = $adoptee_family_role;
            if($accept->is_success != 1){
              $accept->is_success = 1;
            }
            $accept->save();

            $data = new \stdClass();
            $data->status = 200;
            $data->message = "Adoption request is sent successfully.";


            $this->sendNotification($id, 'store');
            Session::flash("success","Adoption request Sent.");

            return response()->json($data);exit;

          }else{
            $data = new \stdClass();
            $data->status = 0;
            $data->message = "Unable to send Adoption request.";

           return response()->json($data);exit;
          }
   }


    public function ajax_accept(Request $request )
    {

        // print_r($id);exit;
        $accept = Trials::find($request->get('trial'));

        if(!$accept){

            $data = new \stdClass();
            $data->status = 400;
            $data->message = "Something went wrongs.";
             return response()->json($data);exit;

        }

        // print_r($accept);exit;

        $matcher =  $accept->matcher_id;
        $matcher_id = $accept->matcherid->display_name_on_pages;
        if($matcher == Auth::user()->id){
            $matcher_id = $accept->userid->display_name_on_pages;
        }



        $accept->adopt_is_accepted = 1;
        $accept->adoption_accept_decline_at = date('Y-m-d h:i:s',time());
        $accept->adopt_is_decline = 0;
        $accept->save();
        $this->sendNotification($request->get('trial'), 'accepted');
        $data = new \stdClass();
        $data->status = 200;
        $data->message = 'You have accepted '.$matcher_id.' \'s Adoption request';

        $user = Auth::user();
        // unlike the other user profile
        if($accept->user_id == $user->id){
            $liked_by = $accept->user_id;
            $user_id  = $accept->matcher_id;
        }else{
            $user_id = $accept->user_id;
            $liked_by  = $accept->matcher_id;
        }


        // remove like
        Like::where('user_id' ,$user_id)->where('liked_by', $liked_by)->delete();
        Like::where('liked_by' ,$user_id)->where('user_id', $liked_by)->delete();
        // remove the match
        Match::whereRaw('( user_id = '. $accept->user_id .' AND matcher_id = ' . $accept->matcher_id . ' ) OR ( user_id = '. $accept->matcher_id .' AND matcher_id = '. $accept->user_id .')')->delete();


        return response()->json($data);exit;
        // return back()->with('message', 'You have accepted '.$matcher_id.' \'s Adoption request');
    }



}
