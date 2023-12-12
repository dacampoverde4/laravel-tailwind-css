<?php

namespace App\Http\Controllers;

use DB;
use App\Message;
use App\User;
use App\Like;
use App\Match;
use App\Trials;
use App\Features;
use App\FeatureUses;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Auth;
use App\WordsSecurity;
use Mail;
use App\Reportblock;
use App\Reason;
use App\GenderRole;
use App\FamilyRole;
use App\Events\UserAllNotification;


class ChatsController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
	}


	/**
	 * Show chats
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$message = '';
		if(isthisSubscribed()){
			$column = 'sub_monthly_connection_'.getCurrentUserPlan()->id;
			if($column){
				$usedchat = \App\WebsiteSetting::where('meta_key',$column)->first();
				$conmessage = '.';
				if(usedUserChat() && count(usedUserChat())!=0){
					$conmessage = ' and you used '.count(usedUserChat()).'.';
				}
				if($usedchat->meta_value=='-1'){
					$text = 'unlimited';
				}else{
					$text = $usedchat->meta_value;
				}
				$message = '<b>'.Auth::user()->name.'</b> your <b>"'.getCurrentUserPlan()->name.'"</b> membership allows you to start unlimited conversions. Manage your subscription today';
			}
		}
        $title_by_page = "Chat";
		if(Auth::user()->role_id == 1 || Auth::user()->role_id == 3){
			$message = 'you can chat with unlimited persons';
			return view('chat',compact('message','title_by_page'));
		 }else{
		     return view('chatuser',compact('message','title_by_page'));
		 }
	}

	/**
	 * Fetch all messages
	 *
	 * @return Message
	 */
	public function fetchMessages( $reciever )
	{
		$bid = base64_encode($reciever);
		$messageInfo = array();
    	$adopt_message = '';
		$messages = Message::where( [ 'reciever_id' => $reciever, 'user_id' => Auth::user()->id ] )
				->orWhereRaw( ' ( reciever_id = ' . Auth::user()->id .' AND  user_id = ' . $reciever .' )' )
				->with('user')
				->orderBy('created_at', 'asc')
				->get();


    // check match

    if (Auth::check()) {

        $matches = Match::WhereRaw(' is_match = 1 AND ( (user_id = ' . Auth::user()->id . '   && matcher_id = ' . $reciever . ' ) OR (user_id = ' . $reciever . '   && matcher_id = ' . Auth::user()->id . ' ))')->get()->count();

        if ($matches > 0) {

          //check trial
          $checkReq = Trials::WhereRaw('( (user_id = ' . Auth::user()->id . ' && matcher_id = ' . $reciever . ' ) OR (user_id = ' . $reciever . ' && matcher_id = ' . Auth::user()->id . ' ))')->get()->last();

          if($checkReq){

            $adopter_family_role = FamilyRole::find($checkReq->trial_family_role)->title;
            $adopter_family_gender = (FamilyRole::find($checkReq->trial_family_role)->gender == 'female')  ? "she" : "he" ;
            $adoptee_family_role = FamilyRole::find($checkReq->adoptee_family_role)->title;
            $adoptee_family_gender = (FamilyRole::find($checkReq->adoptee_family_role)->gender == 'female')? "she" : "he";

              //check & send Adopt request
              if($checkReq->is_success == 1 && $checkReq->adoption_success == 0 && $checkReq->adopt_is_dissolve == 0){
                  $messageInfo['adoptionInfo'] = '<a class="btn btn-success" data-toggle="modal" id="btnModal'.$checkReq->id.'" data-target="#sendRequestBtn'.$checkReq->id.'">Adopt</a>';

                  $messageInfo['trialInfo'] = $checkReq->id;


                  if(Auth::user()->id == $checkReq->user_id){

                      $reciverUrl = url("userprofile").'/'.base64_encode($checkReq->matcher_id);
                      $reciverName = $checkReq->matcherid->display_name_on_pages;
                      $reciverLink = '<a href="'.$reciverUrl.'">'.$reciverName.'</a>';

                      $adopt_message = "By signing this certificate, you promise to give ".$reciverLink." all of the love and care that ".$adoptee_family_gender."  require in return, your ".$adoptee_family_role." will give you all the love, comfort and attention you need. Failure to meet adoption requirements herein, may result in dissolution. ";
                  }else{
                      $reciverUrl = url("userprofile").'/'.base64_encode($checkReq->user_id);
                      $reciverName = $checkReq->userid->display_name_on_pages;
                      $reciverLink = '<a href="'.$reciverUrl.'">'.$reciverName.'</a>';

                      $adopt_message = "By signing this certificate, you promise to give ".$reciverLink." all of the love and care that ".$adopter_family_gender." require in return, your ".$adopter_family_role." will give you all the love, comfort and attention you need. Failure to meet adoption requirements herein, may result in dissolution. ";
                  }
                  $messageInfo['adopt_message'] = $adopt_message;
              }

              if($checkReq->adopt_is_dissolve == 1){
                $messageInfo['adoptionInfo'] = '<a href="'.url('schedule').'/'.base64_encode($reciever).'" class="btn btn-success">Trial Date</a>';
              }

          }else{
            //send Trial Request
                $messageInfo['adoptionInfo'] = '<a href="'.url('schedule').'/'.base64_encode($reciever).'" class="btn btn-success">Trial Date</a>';

          }
        }
    }


		if( count( $messages ) ){
			Message::where('reciever_id', '=', Auth::user()->id)->where('user_id', '=', $reciever)->update(['is_seen' => 0]);
			$messages->transform(function ($item, $key) {
				if( $item->created_at ){
					$date2 = Carbon::parse($item->created_at);
					$item->newdate =  $date2->diffForHumans();
					$item->fileurl = '';
					if( $item->is_attachment == 1 ){
						$item->fileurl = url('/uploads/messages'). '/' . $item->message;
					}
					if( @$item->user->id ){
						$colors = getGroupTagColors( $item->user->id );
						$item->primary_color = $colors['primary_color'];
						$item->secondary_color = $colors['secondary_color'];
						$item->title = $colors['title'];
					}
          @$item->user->name=@$item->user->display_name_on_pages;
					return $item;
				}
			});
		}


		$messageInfo['messages'] = $messages;
        $user=User::find($reciever);
        if($user){
        	$user->name=$user->display_name_on_pages;
    	}
		$messageInfo['recieverInfo'] = $user;
		$messageInfo['recieverbid'] = $bid ;



		return json_encode($messageInfo);
	}

	public function fetchusers()
	{
		$blockIds = getblockeduser();
		if(Auth::user()->role_id == 1)
		{
			$users = User::where('id', '!=',  Auth::user()->id )->whereNotIn('id', $blockIds)->get();
			return $users;
		}
		if( $blockIds ){

            $users=User::where('id', '!=',  Auth::user()->id )->where('role_id', '!=',  1 )->whereNotIn('id', $blockIds)->get();
            foreach($users as $k=>$user)
            {
                $users[$k]->name=$users[$k]->display_name_on_pages;
            }

	    	return $users;
	    }

        $liked=Like::with('userWhoLiked')->where('isliked', 1)->where('user_id', Auth::user()->id )->get();
        $users = $liked->pluck('userWhoLiked')->where('id', '!=',  Auth::user()->id )->filter();
        foreach($users as $k=>$user)
        {
            $users[$k]->name=$users[$k]->display_name_on_pages;
        }
		return $users;
	}

	public function fetchstaffadmins()
	{
		$blockIds = getblockeduser();
		if(Auth::user()->role_id == 1)
		{
			$users = User::where('id', '!=',  Auth::user()->id)->where('role_id',3)->whereNotIn('id', $blockIds)->get();
			return $users;
		}
		if( $blockIds ){

            $users=User::where('id', '!=',  Auth::user()->id )->where('role_id', '!=',  1 )->whereNotIn('id', $blockIds)->get();
            foreach($users as $k=>$user)
            {
                $users[$k]->name=$users[$k]->display_name_on_pages;
            }

	    	return $users;
	    }

        $users=User::whereIn('role_id', [1,3])->where('id', '!=',  Auth::user()->id )->get();
        foreach($users as $k=>$user)
        {
            $users[$k]->name=$users[$k]->display_name_on_pages;
        }
		return $users;
	}

	public function fetchchattingusers()
	{
		$userinfo = $validation  = array();
		$query = '';
		$blockIds = getblockeduser();
		if( $blockIds ){
	    	$blockusers = implode(', ', $blockIds);
	    	$query = "AND `reciever_id` NOT IN($blockusers)";
	    }
		$messages =	DB::select('select * from `messages` WHERE id IN (
				    SELECT MAX(id)
				    FROM messages
				    where  ( reciever_id = ' . Auth::user()->id .' OR  user_id = ' . Auth::user()->id .' )
				    '.$query.'
				    GROUP BY reciever_id
				) order by id DESC');
		if( $messages ){
			$i = 0;
			foreach( $messages as $message ){
				$user_id = $message->reciever_id;
				$bid = base64_encode($user_id);
				if( Auth::user()->id == $message->reciever_id ){
					$user_id = $message->user_id;
				}
				if ( !in_array($user_id, $validation ) ) {
					$userdata = User::find($user_id);
					if( $userdata ){
                        $userdata->name=$userdata->display_name_on_pages;
						$date = Carbon::now();
						$date2 = Carbon::parse($message->created_at);
						$message->newdate =  $date->diffForHumans($date2, true, true, 1);
						$message->message = str_limit( $message->message, 20 );
						$validation[] = $user_id;
						$userinfo[$i]['message'] = $message;
						$userinfo[$i]['recieverbid'] = $bid;
						$userinfo[$i]['user'] = $userdata;
						$userinfo[$i]['seen'] = $ttlcount = Message::where(['is_seen' => 1, 'user_id' => $user_id, 'reciever_id' => Auth::user()->id ])->count();
						$i++;
					}
				}
			}
		}

		return json_encode( $userinfo );
	}


	/**
	 * Persist message to database
	 *
	 * @param  Request $request
	 * @return Response
	 */
	public function sendMessage(Request $request)
	{
		$getWords = WordsSecurity::pluck('title')->toArray();
    	$userid = Auth::user()->id;
    	$user = User::with('species')->find($userid);


		$messageInfo = $request->input('message');
		$reciever_id = $request->input('reciever');

		if( $messageInfo['message'] ){
			$user = Auth::user();
			$isnewuser = Message::where( [ 'reciever_id' => $reciever_id, 'user_id' => Auth::user()->id ] )
				->orWhereRaw( ' ( reciever_id = ' . Auth::user()->id .' AND  user_id = ' . $reciever_id .' )' )
				->count();
			$messageContent = $messageInfo['message'];

      		$user_second_life_full_name = explode(',',preg_replace('/\s+/',' ',$user->second_life_full_name));
      		$getWords = array_merge($getWords,$user_second_life_full_name);

			if($getWords){
        		$messageContent = preg_replace('/\b(\w*' . strtolower(implode('|', $getWords)) . '\w*)\b/', '******', strtolower($messageInfo['message']));
			}

			if( !$isnewuser ){
				$isfeature = Features::isHeCanChatWithNewConnection();
				if( !$isfeature ){
					return ['status' => 'Error', 'erroMsg' => 'Your monthly connections are over. Please buy more connections.'];
				}
			}


			$message = $user->messages()->create([
				'is_seen' => 1,
				'reciever_id' => $request->input('reciever'),
				'message' => $messageContent,
			]);


			if($isnewuser == 0){
				$url = url('/userprofile/'.$userid);
                $senderprofile_link = '<a href="'.$url.'">'.$user->displayname.'</a>';
				$chat_url = '<a href="'.url('chat?id='.$userid).'">chat</a>';
				$genderdata = GenderRole::where('id', '=', $user->gender)->first();
		        $him_her = "";

		        if($genderdata != null){
		          if($genderdata->gender == "male"){
		            $him_her = "him";
		          }if($genderdata->gender == "female"){
		            $him_her = "her";
		          }
		        }

		        $recieverdata = User::find($reciever_id);

				$reciever_msg_notification = $senderprofile_link." started a chat with you. Lets join ".$him_her." in ".$chat_url."!";
				$admin = User::where('role_id', '=', 1)->first();
                $admin_id = $admin->id;

                $emaildata = array(
                  'email' => $recieverdata->email,
                  'displayname' => $recieverdata->displayname,
                  'email_message' => $reciever_msg_notification
                );

                $notficationdata = array(
                  'user_id' => $recieverdata->id,
                  'message' => $reciever_msg_notification,
                  'type' => 'chat',
                  'created_by' => $admin_id
                );

                $sldata = array(
                  'uuid' => $recieverdata->uuid,
                  'message' => $reciever_msg_notification,
                  'type' => 'chat'
                );

                $messagedata = array(
                  'user_id' => $admin_id,
                  'reciever_id' => $recieverdata->id,
                  'message' => $reciever_msg_notification,
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

			$date = Carbon::now();
			$date2 = Carbon::parse($message->created_at);
			$message->newdate =  $date->diffForHumans($date2, true, true, 1);
			if( !$isnewuser ){
				$feature = 'sub_monthly_connection_';
				if( $isfeature == 2 ){
					$feature = 'token_monthly_connection_';
				}
				FeatureUses::storeFeatureUsase( $feature, $isfeature );
			}

			broadcast(new MessageSent($user, $message))->toOthers();

			return ['status' => 'Message Sent!'];
		}
	}

	public function getCurrntuserdata(){
		$reciever_id = 0;
		$query = '';
		$blockIds = getblockeduser();
		if( $blockIds ){
	    	$blockusers = implode(', ', $blockIds);
	    	$query = "AND `reciever_id` NOT IN($blockusers)";
	    }
		$message =	DB::select('select * from `messages` WHERE id IN (
				    SELECT MAX(id)
				    FROM messages
				    where  ( reciever_id = ' . Auth::user()->id .' OR  user_id = ' . Auth::user()->id .' )
				    '.$query.'
				    GROUP BY reciever_id
				) order by id DESC limit 0, 1');
		if( count( $message ) ){
			$reciever_id = $message[0]->reciever_id;
			if( Auth::user()->id == $message[0]->reciever_id ){
				$reciever_id = $message[0]->user_id;
			}
		}
		return ['rid' => $reciever_id, 'cid' => Auth::user()->id];
	}

	public function messageAttachments( Request $request ){
		$reciever_id = $request->input('reciever');
		if( $reciever_id ){
			$extention = $request->file->getClientOriginalExtension();
			$imageName = $request->file->getClientOriginalName();
			$newfilename = md5( date('h:i:s').$imageName ).'.'.$extention;
			$request->file->move( public_path() . '/uploads/messages/', $newfilename );
			if( $newfilename ){
				$user = Auth::user();
				$message = $user->messages()->create([
					'is_seen' => 1,
					'reciever_id' => $request->input('reciever'),
					'message' => $newfilename,
					'is_attachment' => 1,
				]);
				$date = Carbon::now();
				$date2 = Carbon::parse($message->created_at);
				$message->newdate =  $date->diffForHumans($date2, true, true, 1);
				broadcast(new MessageSent($user, $message))->toOthers();
				return ['status' => 'Message Sent!'];
			}
		}
		return ['status' => 'Message Not Sent!'];

	}
	public function testfunction(){
        return view('testTimezone');
	}

	public function deleteChat(Request $request)
	{
		$ids = Message::where('user_id',Auth::user()->id)->where('reciever_id',$request->id)->delete();
		$senderdel = Message::where('reciever_id',Auth::user()->id)->where('user_id',$request->id)->delete();
		return ['deletemsg' => 'Chat deleted Sucessfully!'];
	}

	public function userBlock(Request $request)
    {
        $user = new Reportblock;
        $user->user_id = Auth::user()->id;
        $user->block_id = $request->blockid;
        $user->type = 'block';
        $reason = Reason::find($request->reason);
        $user->reason = $reason->name;
        $user->description = $request->description;
        $user->save();
        return ['deletemsg' => 'User Blocked Sucessfully!'];
    }


}
