<?php

namespace App\Http\Controllers;
use App\Events\UsersWasMatched;
use App\Events\UserWasLiked;
use App\Events\UserAllNotification;
use Auth;
use App\Like;
use App\Match;
use App\GenderRole;
use App\UserMessage;
use App\User;
use App\Trials;
use App\WebsiteSetting;
use App\UsersBanner;
use App\AdsSubscriptions;
use App\Advertisement;
use App\TargetAudience;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\MatchController;
use Illuminate\Http\Request;

class LikeController extends Controller
{

    public function index( $user_id = 0 ){
        $likes = array();
        if( !$user_id ){
            $user_id = Auth::user()->id;
        }
        $displaylike = 0;
        if(Auth::user()){
          if(isthisSubscribed()){
             $getSubscriptionsLikes = WebsiteSetting::where('meta_key','sub_view_my_likes_'.getCurrentUserPlan()->id)->first();
             $displaylike = $getSubscriptionsLikes->meta_value;
          }
          if(Auth::user()->role_id=='1'){
            $displaylike = 1000;
          }
        }
        //$liked_by = Like::where('isliked', 1)->where('user_id', $user_id )->pluck('liked_by')->take($displaylike)->toArray();
        //$mylikes = Like::where('isliked', 1)->where('liked_by', $user_id )->pluck('user_id')->take($displaylike)->toArray();
		    $title_by_page = "My Likes";
        /*if( $liked_by ){
            $collection = collect($liked_by);
            $collection = $collection->merge($mylikes);
            $likes =  $collection->unique();
        }*/

        //userbanners start
          $activeads = AdsSubscriptions::where('status', 'Active')->get()->toArray();            
          $userbanners = UsersBanner::join('ads_subscriptions', 'user_banners.ads_subscription_id', '=', 'ads_subscriptions.id')->where('ads_subscriptions.status', '=', 'Active')->join('banners', 'user_banners.banners_id', '=', 'banners.id')->get()->toArray();
          $loginusergroup = '';
          if(Auth::user()){
            $loginuserdata = Auth::user();                        
            $loginusergroup = $loginuserdata->group;
          }            

          $userbanner_160_600 = array();
          foreach($userbanners as $key=>$value)
          {
            if($value['banner_width'] == 160 && $value['banner_height'] == 600)
            {
              $userbanner_160_600[] = $value;
            }  
          }

          $taraud_160_600 = array();
          foreach ($userbanner_160_600 as $key => $value) 
          {
            if($value['target_audience_id'])
            {
              $taud_ids = explode(',', $value['target_audience_id']);
              $taud_data = TargetAudience::whereIn('id', $taud_ids)->get()->toArray();                    
                    
              foreach ($taud_data as $keyt => $valuet) {
                $usergroupids = explode(',', $valuet['usergroup_ids']);
                $taraud_160_600 = array_merge($taraud_160_600, $usergroupids);
              }
            }
          } 
        //userbanners end
        $who_I_liked = Like::where('isliked', 1)->where('liked_by', $user_id )->with("userWhomLiked")->get();
        $who_likes_me = Like::where('isliked', 1)->where('user_id', $user_id )->with("userWhoLiked")->get();
        return view('user.myLikes', compact('likes','title_by_page', 'userbanner_160_600', 'taraud_160_600', 'loginusergroup', 'who_I_liked', 'who_likes_me') );
    }


   public function dolike(Request $request){


       $response = array('status' => 0 );
       $user = $request->input('user');

       $authuser = $request->input('authuser');
       $authuser_id = base64_decode($authuser);

       if($request->get('action') != null){
          $userid = $request->get('user');
          //get trial id
          $checkReq = Trials::WhereRaw('( (user_id = ' . Auth::user()->id .' && matcher_id = ' . $userid .' ) OR (user_id = ' . $userid .' && matcher_id = ' . Auth::user()->id .' ))' )->get()->first();

          if($checkReq){
            $accept = Trials::findorfail($checkReq->id);
            $accept->delete();
          }
       }else{
         $userid = base64_decode($user);
       }
       $userdata = User::find($userid);

       $authuser_data = User::where('id', '=', Auth::user()->id)->first();

       $genderdata = GenderRole::where('id', '=', $authuser_data->gender)->first();

       $gender = "his/her";

       if($genderdata != null){
         if($genderdata->gender == "male"){
           $gender = "his";
         }if($genderdata->gender == "female"){
           $gender = "her";
         }
       }


       $auth_username = $authuser_data->displayname;

       if( $userdata ){
           $data = Like::where('liked_by', Auth::user()->id )->where('user_id', $userid )->first();
           if( !$data ){
               $data = new Like;
               $response['like'] = $data->isliked = 1;
               //\Event::fire(new UserWasLiked($userdata, Auth::user()));

                $datalikeeother = Like::where('liked_by', $userid )->where('user_id',Auth::user()->id  )->first();
                if($datalikeeother){
                  $user_A = $userdata;
                  $user_B = Auth::user();
                  $this->sendMatchNotificationToBothUsers($user_A, $user_B);
                }else{
                  $encodeid = base64_encode($authuser_data->id); 
                  $url = url('/userprofile/'.$encodeid);               
                  $userprofilelink = '<a href="'.$url.'">'.$auth_username.'</a>';
                  
                  $message = $userprofilelink." liked your profile. Like ".$gender." profile and you’ll have a potential match!";
                  $admin = User::where('role_id', '=', 1)->first();
                  $admin_id = $admin->id;

                  $emaildata = array(
                    'email' => $userdata->email,
                    'displayname' => $userdata->displayname,
                    'email_message' => $message
                  );

                  $notficationdata = array(
                    'user_id' => $userdata->id,
                    'message' => $message,
                    'type' => 'like',
                    'created_by' => $admin_id
                  );

                  $sldata = array(
                    'uuid' => $userdata->uuid,
                    'message' => $message,
                    'sl_msg' => "try1",
                    'type' => 'Like Notification'
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
            }else{
               if( $data->isliked ){
                   $response['like'] = $data->isliked = 0;
               }else{
                  $response['like'] = $data->isliked = 1;
                  //\Event::fire(new UserWasLiked($userdata, Auth::user()));
                  
                  $encodeid = base64_encode($authuser_data->id); 
                  $url = url('/userprofile/'.$encodeid);               
                  $userprofilelink = '<a href="'.$url.'">'.$auth_username.'</a>';
                  $slPL="[".$url." ".$auth_username."]";
                  
                  $message = $userprofilelink." liked your profile again! Since you already liked ".$gender.", ";
                  $message .= "this is an opportunity for a second chance match! Would you like to go on a Trial Date with ".$auth_username."? please visit url: ";
                  $message .= '<a href="'.url('/trials').'">Trial Date</a>';

                  $slMsg = $slPL." liked your profile again! Since you already liked ".$gender.", ";
                  $slMsg .= "this is an opportunity for a second chance match! Would you like to go on a Trial Date with ".$auth_username."? please visit url: ";
                  $slMsg .= "[".url('/trials')." Trial Date]";

                  $admin = User::where('role_id', '=', 1)->first();
                  $admin_id = $admin->id;

                  $emaildata = array(
                    'email' => $userdata->email,
                    'displayname' => $userdata->displayname,
                    'email_message' => $message
                  );

                  $notficationdata = array(
                    'user_id' => $userdata->id,
                    'message' => $message,
                    'type' => 'like',
                    'created_by' => $admin_id
                  );

                  $sldata = array(
                    'uuid' => $userdata->uuid,
                    'message' => $message,
                    'sl_msg' => $slMsg,
                    'type' => 'Like Notification'
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
           }
           $data->user_id = $userid;
           $data->liked_by = Auth::user()->id;
           $data->save();
           $response['status'] = 1;
           $notification = array();
           if( $response['like'] ){

           }

           $ismatch = Match::checkMatch($userid);
           $matchdata = array();
           if( $ismatch ){
              $matchdata['user_id'] = $userid;
              $matchdata['is_match'] = ( $ismatch == 2 )? 1 : 0;
               MatchController::doMatch($matchdata);
               if($ismatch == 2)
               {
                  \Event::fire(new UsersWasMatched($userdata, Auth::user()));
               }
           }

       }
       $likecount = Like::where('isliked', 1)->where('user_id', $userid )->count();
       $response['likecount'] = $likecount;
       $response['matchcount'] = Match::matchCount($userid);
       return json_encode($response);
   }

  public function sendMatchNotificationToBothUsers($user_A, $user_B){
    $chat_url = route("chatindex");
    $chat_label = "<a href='".$chat_url."'>Chat</a>";

    $trials_url = route("trials.index");
    $trials_label = "<a href='".$trials_url."'>Trial Date</a>";

    //User A Data
    $encodeid = base64_encode($user_A->id); 
    $url = url('/userprofile/'.$encodeid);               
    $user_A_profile_link = '<a href="'.$url.'">'.$user_A->displayname.'</a>';
    $user_A_gender_noun = "He/She";
    $user_A_gender = "him/her";
    $user_A_genderdata = GenderRole::where('id', '=', $user_A->gender)->first();
    if($user_A_genderdata != null){
      if($user_A_genderdata->gender == "male"){
        $user_A_gender_noun = "He";
        $user_A_gender = "him";
      }if($user_A_genderdata->gender == "female"){
        $user_A_gender_noun = "She";
        $user_A_gender = "her";
      }
    }

    //User B Data
    $encodeid = base64_encode($user_B->id); 
    $url = url('/userprofile/'.$encodeid);               
    $user_B_profile_link = '<a href="'.$url.'">'.$user_B->displayname.'</a>';
    $user_B_gender_noun = "He/She";
    $user_B_gender = "him/her";
    $user_B_genderdata = GenderRole::where('id', '=', $user_B->gender)->first();
    if($user_B_genderdata != null){
      if($user_B_genderdata->gender == "male"){
        $user_B_gender_noun = "He";
        $user_B_gender = "him";
      }if($user_B_genderdata->gender == "female"){
        $user_B_gender_noun = "She";
        $user_B_gender = "her";
      }
    }

    $message = 'Congratulations '.$user_A_profile_link.'! '.$user_B_gender_noun.' Likes you too… '.$user_B_profile_link.' is a match! Join '.$user_B_gender.' in a '.$chat_label.' or schedule a '.$trials_label.'! ';
    $this->sendAllNotification($user_A, $message);

    $message = 'Congratulations '.$user_B_profile_link.'! Now that you and '.$user_A_profile_link.' are a match, Join '.$user_A_gender.' in a '.$chat_label.' or schedule a '.$trials_label.'!';
    $this->sendAllNotification($user_B, $message);
  }

  public function sendAllNotification($userdata, $message){
    $admin = User::where('role_id', '=', 1)->first();
    $admin_id = $admin->id;
    $emaildata = array(
      'email' => $userdata->email,
      'displayname' => $userdata->displayname,
      'email_message' => $message
    );

    $notficationdata = array(
      'user_id' => $userdata->id,
      'message' => $message,
      'type' => 'like',
      'created_by' => $admin_id
    );

    $sldata = array(
      'uuid' => $userdata->uuid,
      'message' => $message,
      'sl_msg' => "try3",
      'type' => 'Like Notification'
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
}
