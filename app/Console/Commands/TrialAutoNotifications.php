<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Trials;
use App\Match;
use Carbon\Carbon;
use App\User;
use App\TrialLocation;
use App\FamilyRole;
use App\Events\UserAllNotification;

class TrialAutoNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'TrialAutoNotifications:trialautonotifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Trial Auto Notifications';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $alltrials = Trials::where('is_accepted', '=', 1)->where('is_success', '=', 0)->orderBy('id', 'desc')->get();
        foreach($alltrials as $key=>$value)
        {
            $sender = $value->user_id;
            $reciver = $value->matcher_id;

            $trialDateTime = $value->trial_date.' '.$value->trial_time;
            $cdate = date("Y-m-d g:iA");
            $tdate = date("Y-m-d g:iA", strtotime($trialDateTime)); 
            $diff = abs(strtotime($tdate) - strtotime($cdate))/3600;

            $planInfo = getUserPlan($value->user_id);
            $planInfo = json_decode($planInfo);
            $planTrialDays = $planInfo->trial_period;
            $trialDTm = $value->trial_date.' '.$value->trial_time;

            if($planTrialDays != null){
              $newTrialDate = date("Y-m-d H:i", strtotime('+'.$planTrialDays.' days', strtotime($trialDTm)));
            }else{
              $newTrialDate = date("Y-m-d H:i", strtotime('+24 hours', strtotime($trialDTm)));
            }
            $autoEndTrialDate = date("Y-m-d g:iA", strtotime($newTrialDate)); 
            $autoenddiff = abs(strtotime($autoEndTrialDate) - strtotime($cdate))/3600;

            //sender user data 
            $senderUserdata = User::find($sender);
            //reciever user data
            $reciverUserdata = User::find($reciver);

            $trial_locations = TrialLocation::find($value->trial_location_id);
            $datetime = $value->trial_date." ".$value->trial_time;
            $newdate_time = date("Y-m-d g:iA", strtotime($datetime));
            $location_link = '<a href="'.url($trial_locations->address).'">'.$trial_locations->address.'</a>';
            $learn_morebtn = '<a href="'.url('/cms/trialdates').'" class="btn btn-xs btn-primary lrn_mrbtn">Learn More</a>';
            $admin = User::where('role_id', '=', 1)->first();
            $admin_id = $admin->id;

            $senderProfileLink = '<a href="'.url("userprofile").'/'.base64_encode($senderUserdata->id).'">'.$senderUserdata->displayname.'</a>';
            $reciverProfileLink = '<a href="'.url("userprofile").'/'.base64_encode($reciverUserdata->id).'">'.$reciverUserdata->displayname.'</a>';

            if($diff == 2 && $cdate < $tdate)
            {
                if($senderUserdata){
                    $notification_message = $senderProfileLink.", your Trial Date with ".$reciverProfileLink." begins in 2 hours. Here are the details: SL Name: ".$reciverUserdata->sl_username.", ".$newdate_time." SLT, ".$location_link;

                    $user_email = $senderUserdata->user_email;
                    if(!$user_email){
                        $emaildata = array();
                    }else{
                        $emaildata = array(
                            'email' => $senderUserdata->user_email,
                            'displayname' => $senderUserdata->displayname,
                            'email_message' => $notification_message
                        );
                    }                    

                    $notficationdata = array(
                        'user_id' => $senderUserdata->id,
                        'message' => $notification_message,
                        'type' => 'Trial',
                        'created_by' => $admin_id
                    );

                    $sldata = array(
                        'uuid' => $senderUserdata->uuid,
                        'message' => $notification_message,
                        'type' => 'Trial'
                    );

                    $messagedata = array(
                        'user_id' => $admin_id,
                        'reciever_id' => $senderUserdata->id,
                        'message' => $notification_message,
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

                if($reciverUserdata){
                    $notification_message = $reciverProfileLink.", your Trial Date with ".$senderProfileLink." begins in 2 hours. Here are the details: SL Name: ".$senderUserdata->sl_username.", ".$newdate_time." SLT, ".$location_link;

                    $user_email = $reciverUserdata->user_email;
                    if(!$user_email){
                        $emaildata = array();
                    }else{
                        $emaildata = array(
                            'email' => $reciverUserdata->user_email,
                            'displayname' => $reciverUserdata->displayname,
                            'email_message' => $notification_message
                        );
                    }                    

                    $notficationdata = array(
                        'user_id' => $reciverUserdata->id,
                        'message' => $notification_message,
                        'type' => 'Trial',
                        'created_by' => $admin_id
                    );

                    $sldata = array(
                        'uuid' => $reciverUserdata->uuid,
                        'message' => $notification_message,
                        'type' => 'Trial'
                    );

                    $messagedata = array(
                        'user_id' => $admin_id,
                        'reciever_id' => $reciverUserdata->id,
                        'message' => $notification_message,
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

            if($autoenddiff == 0 && $cdate == $autoEndTrialDate)
            {       
                if($senderUserdata)
                { 
                    //trail end notification msg
                    $notification_message = "Here's to a fresh start ".$senderProfileLink."! We at AvDopt wish you all the best on your trial date with ".$reciverProfileLink."! ".$learn_morebtn;

                    //trail end Adopt notification msg
                    $notification_message2 = $senderProfileLink.", you may now adopt ".$reciverProfileLink;

                    $msg_array = array($notification_message, $notification_message2);

                    foreach ($msg_array as $key => $value) {

                        $user_email = $senderUserdata->user_email;
                        if(!$user_email){
                            $emaildata = array();
                        }else{
                            $emaildata = array(
                                'email' => $senderUserdata->user_email,
                                'displayname' => $senderUserdata->displayname,
                                'email_message' => $value
                            );
                        }

                        $notficationdata = array(
                            'user_id' => $senderUserdata->id,
                            'message' => $value,
                            'type' => 'Trial',
                            'created_by' => $admin_id
                        );

                        $sldata = array(
                            'uuid' => $senderUserdata->uuid,
                            'message' => $value,
                            'type' => 'Trial'
                        );

                        $messagedata = array(
                            'user_id' => $admin_id,
                            'reciever_id' => $senderUserdata->id,
                            'message' => $value,
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
                
                if($reciverUserdata)
                {   
                    //trial end notification on auto trial end                 
                    $notification_message = "Here's to a fresh start ".$reciverProfileLink."! We at AvDopt wish you all the best on your trial date with ".$senderProfileLink."! ".$learn_morebtn;
                    
                    //adoption notification on auto trial end
                    $notification_message2 = $reciverProfileLink.", you may now request adoption from ".$senderProfileLink;

                    $msg_array = array($notification_message, $notification_message2);

                    foreach ($msg_array as $key => $value)
                    {
                        $user_email = $reciverUserdata->user_email;
                        if(!$user_email){
                            $emaildata = array();
                        }else{
                            $emaildata = array(
                                'email' => $reciverUserdata->user_email,
                                'displayname' => $reciverUserdata->displayname,
                                'email_message' => $value
                            );
                        }                    

                        $notficationdata = array(
                            'user_id' => $reciverUserdata->id,
                            'message' => $value,
                            'type' => 'Trial',
                            'created_by' => $admin_id
                        );

                        $sldata = array(
                            'uuid' => $reciverUserdata->uuid,
                            'message' => $value,
                            'type' => 'Trial'
                        );

                        $messagedata = array(
                            'user_id' => $admin_id,
                            'reciever_id' => $reciverUserdata->id,
                            'message' => $value,
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
            }
        }

        $alltrialsnotended = Trials::where('is_accepted', '=', 1)->where('is_success', '=', 0)->where('is_ended', '=', 0)->orderBy('id', 'desc')->get();
        foreach($alltrialsnotended as $key=>$value)
        {
            $sender = $value->user_id;
            $reciver = $value->matcher_id;

            $trialDateTime = $value->trial_date.' '.$value->trial_time;
            $cdate = date("Y-m-d g:iA");
            $tdate = date("Y-m-d g:iA", strtotime($trialDateTime)); 
            $diff = abs(strtotime($tdate) - strtotime($cdate))/3600;

            //sender user data 
            $senderUserdata = User::find($sender);
            //reciever user data
            $reciverUserdata = User::find($reciver);

            $trial_locations = TrialLocation::find($value->trial_location_id);
            $datetime = $value->trial_date." ".$value->trial_time;
            $newdate_time = date("Y-m-d g:iA", strtotime($datetime));
            $location_link = '<a href="'.url($trial_locations->address).'">'.$trial_locations->address.'</a>';
            $learn_morebtn = '<a href="'.url('/cms/trialdates').'" class="btn btn-xs btn-primary lrn_mrbtn">Learn More</a>';
            $admin = User::where('role_id', '=', 1)->first();
            $admin_id = $admin->id;

            $notification_message = "";

            if($diff == 24 && $cdate > $tdate)
            {
                $notification_message = "Hello ".$senderUserdata->displayname.", we hope that your trial date with ".$reciverUserdata->displayname." started great yesterday! Although trial dates begins at AvDopt, you may venture to other public places In-World for the remainder of your trial date. Trial dates usually lasts 72 hours so you've got 48 hours of excitement to go! ".$learn_morebtn;
            }

            if($diff == 48 && $cdate > $tdate)
            {            
                $notification_message = "Almost there ".$senderUserdata->displayname."! You've made it past your second milestone on your trial date with ".$reciverUserdata->displayname."! We're definitely keeping our fingers crossed that ".$reciverUserdata->displayname." could be the one... Lets find that out in the next 24 hours! ".$learn_morebtn;
            }

            if($diff == 65 && $cdate > $tdate)
            {          
                $notification_message = "Wow! look at you go ".$senderUserdata->displayname.". We are routing for you & ".$reciverUserdata->displayname." at AvDopt, and we hope that after your trial date you'll proceed with an adoption. ".$learn_morebtn;
            }
               
            if($notification_message)
            {
                if($senderUserdata)
                {      
                    $user_email = $senderUserdata->user_email;
                    if(!$user_email){
                        $emaildata = array();
                    }else{
                        $emaildata = array(
                            'email' => $senderUserdata->user_email,
                            'displayname' => $senderUserdata->displayname,
                            'email_message' => $notification_message
                        );
                    }                    

                    $notficationdata = array(
                        'user_id' => $senderUserdata->id,
                        'message' => $notification_message,
                        'type' => 'Trial',
                        'created_by' => $admin_id
                    );

                    $sldata = array(
                        'uuid' => $senderUserdata->uuid,
                        'message' => $notification_message,
                        'type' => 'Trial'
                    );

                    $messagedata = array(
                        'user_id' => $admin_id,
                        'reciever_id' => $senderUserdata->id,
                        'message' => $notification_message,
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
        }
    }
}
