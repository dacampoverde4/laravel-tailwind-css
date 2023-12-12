<?php
namespace App\Http\Controllers;
use Auth;
use DB;
use App\Trials;
use App\Match;
use App\Features;
use App\Reportblock;
use App\FamilyRole;
use App\FeatureUses;
use App\Notification;
use App\TrialLocation;
use App\CreateReasons;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use App\User;
use App\Events\UserAllNotification;
class TrialsController extends Controller
{
    public function __construct()
    {
    }
    public function store(Request $request)
    {
        $reposnse = array('status' => 0 );
        $checktrialrequest = Trials::where('is_sent','1')
            ->where('is_accepted','0')
            ->where('is_decline','0')
            ->whereRaw('( user_id = '. Auth::user()->id .' AND matcher_id = ' . request('macherid') . ' ) OR ( user_id = '. request('macherid') .' AND matcher_id = '. Auth::user()->id .')')
            ->first();
        if( !$checktrialrequest ){
            if( !Features::isHeCanSendThisTrail() ){
                $reposnse = ['status' => 0, 'msg' => 'Your monthly connections are over. Please buy more connections.'];
                return json_encode($reposnse);
            }
            $trials = new Trials;
            $trials->user_id = Auth::user()->id;
            $trials->matcher_id = request('macherid');
            $datetime = date('Y-m-d h:i:s',strtotime(request('datetime')));
            $trials->trial_date = $datetime;
            $trials->is_sent = 1;
            $trials->trail_sent_at = date('Y-m-d h:i:s',strtotime(time()));
            $trials->save();
            $mid = request('trialid');
            $match = Match::find($mid);
            $match->is_trial = 1;
            $match->save();
            FeatureUses::storeFeatureUsase('sub_trial_token_');
            $reposnse['status'] = 1;
            $reposnse['msg'] = 'Trial request send successfully';
            return json_encode($reposnse);
        }
        $reposnse['msg'] = 'Your trial is already processed. Check trial request';
        return json_encode($reposnse);
    }
    //Display listning in user profile
    public function index(Request $request)
    {
        if($request->get('submitSuccess') != null){
            $trial_id = $request->get('trial_id');
            //check its success status
            $getTrial = Trials::find($trial_id);
            if($getTrial->is_success == 1){
              return back()->with('message', 'Your Adoption trial already succeeded!');
            }
            $getTrial->is_success = $request->get('is_success');
            $getTrial->agree = $request->get('agree');
            $successDate = date("Y-m-d H:i:s");
            $getTrial->success_date = $successDate;
            $getTrial->save();
            //get user profile link for adoption
            if($getTrial->user_id ==  Auth::user()->id){
              $html = '<a href="'.url('userprofile').'/'.base64_encode($getTrial->matcher_id).'">'.$getTrial->matcherid->display_name_on_pages.'\'s </a>';
            }else{
              $html = '<a href="'.url('userprofile').'/'.base64_encode($getTrial->user_id).'">'.$getTrial->userid->display_name_on_pages.'\'s </a>';
            }
            if($request->get('is_success') == 1){
                return back()->with('message', 'Thanks! Your Trial Date has succeeded. Please continue to Adopt request from '.$html.' profile.');
            }else{
                return back()->with('warning', 'Sorry! Your Trial Date has not succeeded.');
            }
        }
        //check end Trials
        $this->updateTrialRequestStatus();


        $allRequests = Trials::WhereRaw('((user_id = ' . Auth::user()->id.') OR (matcher_id = ' . Auth::user()->id .' ))')
        ->where('is_success', 0)
        ->orderby('updated_at', 'DESC')
        ->paginate(10);


        foreach($allRequests as $key=>$value){

              $blockIds = Reportblock::WhereRaw('( (user_id = ' . $value->user_id . ' && block_id = ' . $value->matcher_id . ' ) OR (user_id = ' . $value->matcher_id . ' && block_id = ' . $value->user_id . ' ))')->get()->first();

              if($blockIds){

                unset($allRequests[$key]);
              }
        }

        // get end reasons
        $endReasons = CreateReasons::get();
        $ratings = DB::table('rating')->where('user_id',Auth::user()->id)->get();
        $title_by_page = "Trials";
        return view('profile.trials', compact('allRequests','ratings','title_by_page','endReasons'));
    }
    /**
    *
    *  Sent Trials
    **/
    public function sentTrialsIndex(Request $request)
    {
        //check end Trials
        $this->updateTrialRequestStatus();
        // get sent trials
        $sent = Trials::where('user_id',Auth::user()->id)
                ->where('is_sent', 1)
                ->paginate(10);


      foreach($sent as $key=>$value){

              $blockIds = Reportblock::WhereRaw('( (user_id = ' . $value->user_id . ' && block_id = ' . $value->matcher_id . ' ) OR (user_id = ' . $value->matcher_id . ' && block_id = ' . $value->user_id . ' ))')->get()->first();

              if($blockIds){

                unset($sent[$key]);
              }
        }

        $title_by_page = "Sent Trials";
        return view('profile.sentTrials', compact('sent', 'title_by_page'));
    }
    /**
    * Active Trial function
    *
    **/
    public function activeTrialsIndex(Request $request)
    {
        //check end Trials
        $this->updateTrialRequestStatus();
        // get Active trials
        $accepted = Trials::WhereRaw('((user_id = ' . Auth::user()->id.') OR (matcher_id = ' . Auth::user()->id .' ))')
        ->where('is_success',0)
        ->where('is_ended',0)
        ->where('auto_ended',0)
        ->where(function($query) {
          $query->where('is_accepted', 1)
            ->orWhere('is_accepted', 0);
        })->paginate(10);

        // remove blocked users from the Trial
        foreach($accepted as $key=>$value){

                $blockIds = Reportblock::WhereRaw('( (user_id = ' . $value->user_id . ' && block_id = ' . $value->matcher_id . ' ) OR (user_id = ' . $value->matcher_id . ' && block_id = ' . $value->user_id . ' ))')->get()->first();

                if($blockIds){
                  unset($accepted[$key]);
                }
        }

        $title_by_page = "Active Trials";
        $endReasons = CreateReasons::get();
        return view('profile.activeTrials', compact('accepted','title_by_page','endReasons'));
    }
    /**
    * Expired Trial function
    *
    **/
    public function expiredTrialsIndex(Request $request)
    {
      if($request->get('submitSuccess') != null){
          $trial_id = $request->get('trial_id');
          //check its success status
          $getTrial = Trials::find($trial_id);
          if($getTrial->is_success == 1){
            return back()->with('message', 'Your Adoption trial already succeeded!');
          }
          $getTrial->is_success = $request->get('is_success');
          $getTrial->agree = $request->get('agree');
          $successDate = date("Y-m-d H:i:s");
          $getTrial->success_date = $successDate;
          $getTrial->save();
          //get user profile link for adoption
          if($getTrial->user_id ==  Auth::user()->id){
            $html = '<a href="'.url('userprofile').'/'.base64_encode($getTrial->matcher_id).'">'.$getTrial->matcherid->display_name_on_pages.'\'s </a>';
          }else{
            $html = '<a href="'.url('userprofile').'/'.base64_encode($getTrial->user_id).'">'.$getTrial->userid->display_name_on_pages.'\'s </a>';
          }
          if($request->get('is_success') == 1){
              return back()->with('message', 'Thanks! Your Trial Date has successful. Please continue to Adopt request from '.$html.' profile.');
          }else{
              return back()->with('warning', 'Sorry! Your Trial Date has not succeeded.');
          }
      }
        //check end Trials
        $this->updateTrialRequestStatus();
        // get Active trials
        $expired = Trials::WhereRaw('((user_id = ' . Auth::user()->id.') OR (matcher_id = ' . Auth::user()->id .' ))')
                    ->where("is_success", 0)
                    ->where(function($query) {
                      $query->where('is_ended', 1)
                        ->orWhere('is_ended', 0);
                    })->where(function($query) {
                      $query->where('auto_ended', 1)
                        ->orWhere('auto_ended', 0);
                    })->where(function($query) {
                      $query->where('is_decline', 1)
                        ->orWhere('is_decline', 0);
                    })->paginate(10);

                    // remove blocked users from the Trial
                    foreach($expired as $key=>$value){

                            $blockIds = Reportblock::WhereRaw('( (user_id = ' . $value->user_id . ' && block_id = ' . $value->matcher_id . ' ) OR (user_id = ' . $value->matcher_id . ' && block_id = ' . $value->user_id . ' ))')->get()->first();

                            if($blockIds){
                              unset($expired[$key]);
                            }
                    }

        $title_by_page = "Expired Trials";
        return view('profile.expiredTrials', compact('expired','title_by_page'));
    }
    public function decline( $id )
    {
    
        $accept = Trials::findorfail($id);
        $accept->is_accepted = 0;
        $accept->is_sent = 1;
        $accept->is_decline = 1;
        $accept->is_maybe = 0;
        $accept->trail_accepted_at = date('Y-m-d h:i:s',time());
        $accept->save();
        $this->sendNotification($id, 'declined');
        return back()->with('message', 'You have Declined the '.$accept->userid->display_name_on_pages.' Trial Request');
    }
    public function maybe( $id )
    {
        $accept = Trials::findorfail($id);
        $accept->is_accepted = 0;
        $accept->is_sent = 1;
        $accept->is_decline = 0;
        $accept->is_maybe = 1;
        // $accept->trail_accept_decline_at = date('Y-m-d h:i:s',time());
        $accept->save();
        $this->sendNotification($id, 'maybe');
        return back()->with('message', 'You can Reschedule the '.$accept->userid->display_name_on_pages.' Trial Request.');
    }
    public function accept( $id )
    {
        $accept = Trials::findorfail($id);
        $accept->is_accepted = 1;
        $accept->is_sent = 1;
        $accept->is_decline = 0;
        $accept->is_maybe = 0;
        $accept->trail_accepted_at = date('Y-m-d h:i:s',time());
        // $accept->trail_success_at = date('Y-m-d h:i:s',strtotime(time()));
        $accept->save();
        $this->sendNotification($id, 'accepted');
        return back()->with('message', 'You have accepted '.$accept->userid->display_name_on_pages.' Trial date request');
    }
    public function success( Request $request, $id )
    {
        $accept = Trials::findorfail($id);
        $accept->is_success = 1;
        $accept->save();
        $time = Carbon::now();
        DB::table('rating')->insert(
            ['rating' => request('rating'), 'user_id' => Auth::user()->id, 'comment' => request('comment'), 'created_at' => $time, 'updated_at' => $time]
        );
        return back()->with('message', 'Success request');
    }
    public function endTrial( Request $request)
    {
        // print_r( $request->all());exit;
        if($request->get('trial_id') != null){
            $trial_id = $request->get('trial_id');
            $reason_id = $request->get('trial_end_reason');
              // get reason title and save into database
              $getReason = CreateReasons::findorfail($reason_id);
              $reasonTitle = $getReason->title;
              //get Trial to save the end status
              $getTrial = Trials::findorfail($trial_id);
              $trailEnd = array(
                'user_id' => Auth::user()->id,
                'reason_id' => $reason_id,
                'reason_title' => $reasonTitle,
                'end_date' => date('Y-m-d H:i:s')
              );
              // check Trial End Status
              if($getReason->status == 'cancel'){
                $this->sendNotification($trial_id, 'cancel', $reasonTitle);
                $getTrial->delete();
                return back()->with('message', 'Trial Request cancelled successfully!');
              }
              // Proceed to Adoption
              if($getReason->status == 'adoption'){
                  $getTrial->trial_end_reason = json_encode($trailEnd);
                  $getTrial->is_ended = 1;
                  $getTrial->is_success = 1;
                  $getTrial->trail_end_at = date('Y-m-d h:i:s',time());
                  $getTrial->auto_ended = 0;
                  $getTrial->save();
                  $this->sendNotification($trial_id, 'ended');
                  //get user profile link for adoption
                  if($getTrial->user_id ==  Auth::user()->id){
                    $html = '<a href="'.url('userprofile').'/'.base64_encode($getTrial->matcher_id).'">'.$getTrial->matcherid->display_name_on_pages.'\'s </a>';
                  }else{
                    $html = '<a href="'.url('userprofile').'/'.base64_encode($getTrial->user_id).'">'.$getTrial->userid->display_name_on_pages.'\'s </a>';
                  }

                  $message  = $this->getAdoptionMessage($trial_id);

                  return back()->with('adoption_trail_id',$trial_id)->with('done_status',"adoption")->with('adoption_message',$message)->with('message', 'Thanks! Your Trial has been successful. Please continue to Adopt request from '.$html.' profile.');
              }
              // skip adoption
              if(!empty($getTrial->trial_end_reason)){
                // delete skip Trial Date
                $getTrialEnd = json_decode($getTrial->trial_end_reason);
                  if($getTrialEnd->user_id == Auth::user()->id && $getTrial->user_id == Auth::user()->id){
                    return back()->with('message', 'You already skipped a Trial Date Request. Please wait for "'.$getTrial->matcherid->display_name_on_pages.'" response');
                  }elseif($getTrialEnd->user_id == Auth::user()->id && $getTrial->macther_id == Auth::user()->id){
                    return back()->with('message', 'You already skipped a Trial Date Request. Please wait for "'.$getTrial->userid->display_name_on_pages.'" response');
                  }else{
                    $this->sendNotification($trial_id, 'cancel');
                    $getTrial->delete();
                    return back()->with('message', 'You has permanently cancel the skipped Trial Date Request.');
                  }
              }else{
                $getTrial->trial_end_reason = json_encode($trailEnd);
                $getTrial->save();
                $this->sendNotification($trial_id, 'skip');
                return back()->with('message', 'You has skipped the Trial Date Request.');
              }
        }
    }
    public function cancelrequest( $id )
    {
        $accept = Trials::findorfail($id);
        $this->sendNotification($id, 'cancel');
        $accept->delete();
        return back()->with('message', 'Trial Request has been Cancelled');
    }
    public function sendNotification($trialId, $status, $reason="")
    {
        $accept = Trials::findorfail($trialId);
        $message = '';
        $getLocation = TrialLocation::find(  $accept->trial_location_id);
        // print_r($getLocation);exit;

        $message .= '<br/><div class="location-detail"><b>Trial details: </b>';
        $message .= date("d F, Y",strtotime($accept->trial_date));
        $message .= ' ,'.date("h:ia", strtotime($accept->trial_time)).' (SLT)';
        $message .= ' at <a href=" '.$getLocation->address.'" class="label label-info" target="_blank"><i class="fa fa-map-marker" aria-hidden="true"></i> Location</a></div>';
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


        if($status == 'ended'){

          if(Auth::user()->id == $accept->matcher_id ){
            $senderUrl = url("userprofile").'/'.base64_encode($accept->matcher_id);
            $senderName = $accept->matcherid->display_name_on_pages;
            $reciverUrl = url("userprofile").'/'.base64_encode($accept->user_id);
            $reciverName = $accept->userid->display_name_on_pages;
            $senderLink = '<a href="'.$senderUrl.'">'.$senderName.'</a>';
            $reciverLink = '<a href="'.$reciverUrl.'">'.$reciverName.'</a>';
          }else{
            $senderUrl = url("userprofile").'/'.base64_encode($accept->user_id);
            $senderName = $accept->userid->display_name_on_pages;
            $reciverUrl = url("userprofile").'/'.base64_encode($accept->matcher_id);
            $reciverName = $accept->matcherid->display_name_on_pages;
            $senderLink = '<a href="'.$senderUrl.'">'.$senderName.'</a>';
            $reciverLink = '<a href="'.$reciverUrl.'">'.$reciverName.'</a>';

          }
        }

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
        $traildate = date("d F, Y",strtotime($accept->trial_date));
        $trailtime = date("h:ia", strtotime($accept->trial_time)) .' (SLT)';

        $admin = User::where('role_id', '=', 1)->first();
        $admin_id = $admin->id;
        $triallink = '<a href="'.url('/trials').'">Trial Date</a>';
        $location_link = '<a href="'.url($getLocation->address).'" target="_blank">'.$getLocation->name.'</a>';
        $browse_link = '<a href="'.url('/browse').'">browse</a>';
        $locationname = $getLocation->name;

        $senderdata = User::find($sender);
        $reciverdata = User::find($reciver);

        if($status == 'ended'){
          // get end reason
          $reason = json_decode($accept->trial_end_reason);
          $userNotification->message    = $senderLink.'  has ended Trial Date with a reason "'.$reason->reason_title.'". '.$message;
          $matcherNotification->message = 'You\'ve ended Trial Request with a reason "'.$reason->reason_title.'".'.$message;
        }
        if($status == 'skip'){
            $userNotification->message = $reciverLink.'  has skipped the Trial Date. '.$message;
            $matcherNotification->message = "Your Trial Date has skipped. ".$message;
        }
        if($status == 'accepted')
        {
            //$userNotification->message = $reciverLink.' has been accepted your Trial Date successfully! '.$message;
            //$matcherNotification->message = "You has been accepted the ".$senderLink."'s Trial Date Request successfully! ".$message;
            $user_message_notification = $senderLink.", it just keeps getting better! ".$reciverLink." accepted your ".$triallink." request. Here are the details: ".$traildate.", ".$trailtime.", at ".$location_link;
            $userdata = User::find($reciver);
            $emaildata = array(
                'email' => $userdata->email,
                'displayname' => $userdata->displayname,
                'email_message' => $user_message_notification
            );
            $notficationdata = array(
                'user_id' => $userdata->id,
                'message' => $user_message_notification,
                'type' => 'Trial',
                'created_by' => $admin_id
            );
            $sldata = array(
                'uuid' => $userdata->uuid,
                'message' => $user_message_notification,
                'sl_msg' => "try1",
                'type' => 'Trial'
            );
            $messagedata = array(
                'user_id' => $admin_id,
                'reciever_id' => $userdata->id,
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
            //return redirect('/home');
            //$userNotification->message    = $reciverLink.' has been accepted your Trial Date successfully! '.$message;
            $matcherNotification->message = "You've accepted ".$senderLink."'s Trial Date Request successfully! ".$message;

            $matcherNotification->save();
            return back();
        }
        if($status == 'skip'){
              $userNotification->message    = $senderLink.'  has skipped the Trial Date. '.$message;
              $matcherNotification->message = "You've skipped a Trial Date. ".$message;
        }
        if($status == 'auto_ended'){

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
        if($status == 'declined'){
            //$userNotification->message = $reciverLink.' has been declined your Trial Date! Better Luck for next Time. '.$message;
            //$matcherNotification->message = 'You has been declined '.$senderLink.'\'s Trial Date!.'.$message;
            $user_message_notification = $senderLink.", unfortunately ".$reciverLink." decided not to go on a ".$triallink." with you. However, it’s not the end of the virtual world! Lets ".$browse_link." more members";
            $userdata = User::find($reciver);
            $emaildata = array(
                'email' => $userdata->email,
                'displayname' => $userdata->displayname,
                'email_message' => $user_message_notification
            );
            $notficationdata = array(
                'user_id' => $userdata->id,
                'message' => $user_message_notification,
                'type' => 'Trial',
                'created_by' => $admin_id
            );
            $sldata = array(
                'uuid' => $userdata->uuid,
                'message' => $user_message_notification,
                'type' => 'Trial'
            );
            $messagedata = array(
                'user_id' => $admin_id,
                'reciever_id' => $userdata->id,
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
            //return redirect('/home');
            //$userNotification->message    = $reciverLink.' has been declined your Trial Date! Better Luck for next Time. '.$message;
            $matcherNotification->message = 'You\'ve declined '.$senderLink.'\'s Trial Date!.'.$message;
            $matcherNotification->save();
            return back();
        }
        if($status == 'maybe'){
            $userNotification->message    = 'You can reschedule or cancel the Trial Date with '.$reciverLink.' in future! '.$message;
            $matcherNotification->message = "You can reschedule or cancel the ".$senderLink."'s Trial Date in future! ".$message;
        }

        if($status == 'cancel')
        {
            if($sender)
            {
              $notif_message = "You've successfully ended the trial date between you and ".$reciverLink.". You've chosen to end the trial date because: ".$reason.". You may leave a review on ".$reciverLink." profile when ready. Reviews are permanent and it will add to ".$reciverLink."’s adoption history.";

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
            }

            if($reciver)
            {
              $notif_message = $senderLink." has ended the trial date. Here's why: ".$reason.". You may leave a review on ".$senderLink."’s profile when ready. Reviews are permanent and it will add to ".$senderLink."’s adoption history.";

              $emaildata = array(
                'email' => $reciverdata->email,
                'displayname' => $reciverdata->displayname,
                'email_message' => $notif_message
              );

              $notficationdata = array(
                'user_id' => $reciverdata->id,
                'message' => $notif_message,
                'type' => 'Trial',
                'created_by' => $admin_id
              );

              $sldata = array(
                'uuid' => $reciverdata->uuid,
                'message' => $notif_message,
                'type' => 'Trial'
              );

              $messagedata = array(
                'user_id' => $admin_id,
                'reciever_id' => $reciverdata->id,
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
            }
            return back();
            //$userNotification->message    = $reciverLink.' has been cancelled your Trial Date.'.$message;
            //$matcherNotification->message = 'You\'ve cancelled '.$senderLink.'\'s Trial Date.'.$message;
        }

        $userNotification->save();
        $matcherNotification->save();
    }
    public function adminindex(Request $request){
        $allTrialRequests = Trials::all();

        return view('admin.trialrequests', compact('allTrialRequests'));
    }
    public function adminCancelRequest( $id )
    {

        $accept = Trials::findorfail($id);
        //echo '<pre>';print_r($accept);die;
        $accept->delete();
        return  redirect()->back()->with('message', 'Trial Request has been Cancelled');
    }

    // GET ADOPTION CONCENT MESSAGE
    public function getAdoptionMessage($id){
        $checkReq = Trials::find($id);

            if($checkReq){

            $adopter_family_role = FamilyRole::find($checkReq->trial_family_role)->title;
            $adopter_family_gender = (FamilyRole::find($checkReq->trial_family_role)->gender == 'female')  ? "she" : "he" ;
            $adoptee_family_role = FamilyRole::find($checkReq->adoptee_family_role)->title;
            $adoptee_family_gender = (FamilyRole::find($checkReq->adoptee_family_role)->gender == 'female')? "she" : "he";

            if(Auth::user()->id == $checkReq->user_id){


                $reciverUrl = url("userprofile").'/'.base64_encode($checkReq->matcher_id);
                $reciverName = $checkReq->matcherid->display_name_on_pages;
                $reciverLink = '<a href="'.$reciverUrl.'">'.$reciverName.'</a>';

                return $adopt_message = "By signing this certificate, you promise to give ".$reciverLink." all of the love and care that ".$adoptee_family_gender."  require in return, your ".$adoptee_family_role." will give you all the love, comfort and attention you need. Failure to meet adoption requirements herein, may result in dissolution. ";
            }else{
                $reciverUrl = url("userprofile").'/'.base64_encode($checkReq->user_id);
                $reciverName = $checkReq->userid->display_name_on_pages;
                $reciverLink = '<a href="'.$reciverUrl.'">'.$reciverName.'</a>';

                return $adopt_message = "By signing this certificate, you promise to give ".$reciverLink." all of the love and care that ".$adopter_family_gender." require in return, your ".$adopter_family_role." will give you all the love, comfort and attention you need. Failure to meet adoption requirements herein, may result in dissolution. ";
            }
        }
    }


    public function updateTrialRequestStatus(){
      // get all Trails and check their end dates
      $all = Trials::all();
      foreach($all as $trial){
        // Ends the trials after 24 hours automatically
        if($trial->is_ended != 1){
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
            if($timediff >= 0){
                  DB::table('trials')
                  ->where('id', $trial->id)
                  ->update([
                    'is_ended' => 1,
                    'auto_ended' => 1
                  ]);
                  // send notification
                  $this->sendNotification($trial->id, 'auto_ended');
            }
        }
      }
    }
    }
}
