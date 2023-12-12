<?php

namespace App\Http\Controllers;
use App\User;
use App\UserMessage;
use Illuminate\Http\Request;
use Auth;
use Validator;
use App\Events\UserAllNotification;

class UserMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        UserMessage::where('reciever_id', Auth::user()->id)->update(['is_seen' => 0]);
        $inboxmessages = UserMessage::where('reciever_id', Auth::user()->id)
            ->where('is_reciever_deleted', '0')
            ->latest()
            ->paginate(10);

        $sentmessages = UserMessage::where('user_id', Auth::user()->id)
            ->where('is_sender_deleted', '0')
            ->where('is_sent', '1')
            ->latest()
            ->paginate(10);

        $trashmessages = UserMessage::WhereRaw('reciever_id = ' . Auth::user()->id . ' AND is_reciever_deleted = 1')
            ->orWhereRaw('user_id = ' . Auth::user()->id . ' AND is_sender_deleted = 1')
            ->latest()
            ->paginate(10);
        return view('message.index', compact('inboxmessages', 'sentmessages', 'trashmessages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $sender = new UserMessage;
      $sender->user_id = Auth::user()->id;

      $user = User::with('species')->find($sender->user_id);

      $compareMessageContentSLName = preg_replace('/\b('.strtolower($user->second_life_full_name).')\b/','******',strtolower($request->note));
      $compareMessageContentSLNameStrcmp = strcmp(strtolower($compareMessageContentSLName), strtolower($request->note));

      if($compareMessageContentSLNameStrcmp != 0)
      {
        $request->note = $compareMessageContentSLName;
      }

      $sender->reciever_id = $request->reciever_id;
      $sender->message = $request->note;
      $sender->is_seen = 1;
      $sender->save();

      if($compareMessageContentSLNameStrcmp != 0)
      {
        return back()->with('warning', 'You have used your name that is not allowed; to share on the platform');
      }

      
      $userdata = User::find($request->reciever_id);
      $authuser_data = User::where('id', '=', Auth::user()->id)->first();
      $auth_username = $authuser_data->displayname;

      $encodeid = base64_encode($authuser_data->id); 
      $url = url('/userprofile/'.$encodeid);               
      $userprofilelink = '<a href="'.$url.'">'.$auth_username.'</a>';

      $read_url = '<a href="'.url('/messages').'">Read</a>';

      $message = $userprofilelink." passed you a note. ".$read_url." the note.";
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
        'type' => 'Message Notification',
        'created_by' => $admin_id
      );

      $sldata = array(
        'uuid' => $userdata->uuid,
        'message' => $message,
        'type' => 'Message Notification'
      );

      $messagedata = array(
        /*'user_id' => $admin_id,
        'reciever_id' => $userdata->id,
        'message' => $message,
        'type' => 'message_notification'*/
      );

      $allnoticationdata = array(
        'emailtype' =>$emaildata,
        'messagetype' =>$messagedata,
        'notificationtype' =>$notficationdata,
        'sl_notificationtype' =>$sldata
      );
      \Event::fire(new UserAllNotification($allnoticationdata));

      return back()->with('message', 'Note sent successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\UserMessage $userMessage
     * @return \Illuminate\Http\Response
     */
    public function show(UserMessage $userMessage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\UserMessage $userMessage
     * @return \Illuminate\Http\Response
     */
    public function edit(UserMessage $userMessage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\UserMessage $userMessage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserMessage $userMessage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\UserMessage $userMessage
     * @return \Illuminate\Http\Response
     */

    public function deletemessages(Request $request)
    {
        $ids = explode(',', $request->ids);
        if ($request->getcolumn == '1') {
            $trash = UserMessage::whereIn('id', $ids)->update(['is_reciever_deleted' => 1]);
            $message = 'Messages Deleted';

        }
        if ($request->getcolumn == '2') {
            $trash = UserMessage::whereIn('id', $ids)->update(['is_sender_deleted' => 1]);
            $message = 'Messages Deleted';
        }
        if ($request->getcolumn == '3') {
            $trash = UserMessage::whereIn('id', $ids)->update(['is_sender_deleted' => 0, 'is_reciever_deleted' => 0]);
            $message = 'Messages Restored';
        }

        return back()->with('message', $message);
    }

    public function deletesinglemsg(Request $request, $id = null)
    {
      if($usermessage = UserMessage::find($id))
      {        
        $usermessage->delete();
        return redirect()->back()->with('message', 'Note has been deleted.');
      }else{
        return redirect()->back()->with('errors', 'Note not found');
      }
    }

    public function usermessage(Request $request)
    {
        $recievers = $request->input('id');
        $rowid = $request->input('rowid');
        $response = array('status' => 0);
        if ($recievers) {
            foreach ($recievers as $reciever) {
                $message = UserMessage::find($rowid);
                $message->user_id = Auth::user()->id;
                $user = User::with('species')->find($message->user_id);

                $compareMessageContentSLName = preg_replace('/\b('.strtolower($user->second_life_full_name).')\b/','******',strtolower($request->input('message')));
                $compareMessageContentSLNameStrcmp = strcmp(strtolower($compareMessageContentSLName), strtolower($request->input('message')));

                if($compareMessageContentSLNameStrcmp != 0)
                {
                    $messageFiltered = $compareMessageContentSLName;

                }

                $message->reciever_id = $reciever;
                $message->is_draft = 0;
                $message->is_sent = 1;
                $message->message = $messageFiltered;
                $message->is_seen = 1;
                $message->save();
                $response['status'] = $message->id;
            }
        }
        return $response['status'];
        return $response;
    }

    public function draftmessage(Request $request)
    {
        $recievers = $request->input('id');
        $response = array('status' => 0);
        if ($recievers) {
            foreach ($recievers as $reciever) {
                $message = new UserMessage;
                $message->user_id = Auth::user()->id;
                $user = User::with('species')->find($message->user_id);
                $compareMessageContentSLName = preg_replace('/\b('.strtolower($user->second_life_full_name).')\b/','******',strtolower($request->input('message')));
                $compareMessageContentSLNameStrcmp = strcmp(strtolower($compareMessageContentSLName), strtolower($request->input('message')));

                if($compareMessageContentSLNameStrcmp != 0)
                {
                    $messageFiltered = $compareMessageContentSLName;

                }
                $message->reciever_id = $reciever;
                $message->is_draft = 1;
                $message->is_sent = 0;
                $message->is_seen = 1;
                $message->message = $messageFiltered;
                $message->save();
                $response['status'] = $message->id;
            }
        }
        return $response['status'];
    }

    public function replyMessage(Request $request)
    {        
        $validator = Validator::make($request->all(), [
            'parent_id' => 'required|integer',
            'sender_id' => 'required|integer',
            'reciever_id' => 'required|integer',
            'note' => 'required',
        ]);

        // if ($validator::fails()) {
        //     return $validator;
        // }

        $message = new UserMessage;
        $message->user_id = Auth::user()->id;
        $message->reciever_id = $request->sender_id;
        $message->parent_id = $request->parent_id;
        $message->message = $request->note;
        $message->is_sent = 1;
        $message->is_draft = 0;
        $message->is_reciever_deleted = 0;
        $message->is_sender_deleted = 0;
        $message->is_seen = 1;
        try {
            $message->save();

            // notifications start
              $userdata = User::find($request->sender_id);
              
              $authuser_data = User::where('id', '=', Auth::user()->id)->first();
              $auth_username = $authuser_data->displayname;

              $encodeid = base64_encode($authuser_data->id); 
              $url = url('/userprofile/'.$encodeid);               
              $userprofilelink = '<a href="'.$url.'">'.$auth_username.'</a>';

              $read_url = '<a href="'.url('/messages').'">Read</a>';

              $message_notification = $userprofilelink." passed you a note. ".$read_url." the note.";
              $admin = User::where('role_id', '=', 1)->first();
              $admin_id = $admin->id;
              $emaildata = array(
                'email' => $userdata->email,
                'displayname' => $userdata->displayname,
                'email_message' => $message_notification
              );

              $notficationdata = array(
                'user_id' => $userdata->id,
                'message' => $message_notification,
                'type' => 'Message Notification',
                'created_by' => $admin_id
              );

              $sldata = array(
                'uuid' => $userdata->uuid,
                'message' => $message_notification,
                'type' => 'Message Notification'
              );

              $messagedata = array();

              $allnoticationdata = array(
                'emailtype' =>$emaildata,
                'messagetype' =>$messagedata,
                'notificationtype' =>$notficationdata,
                'sl_notificationtype' =>$sldata
              );              
              \Event::fire(new UserAllNotification($allnoticationdata));
            // notifications end

            return redirect()->back()->with('success', 'Reply has been sent.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Reply has not been sent.');
        }
    }
}
