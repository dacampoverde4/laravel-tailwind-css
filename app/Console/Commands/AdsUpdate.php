<?php

namespace App\Console\Commands;
use Carbon\Carbon;
use App\User;
use DB;
use App\Banner;
use App\Usergroup;
use App\TargetAudience;
use App\UsersBanner;
use App\Advertisement;
use App\AdsSubscriptions;
use App\Events\UserAllNotification;
use Illuminate\Console\Command;

class AdsUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'AdsUpdate:adsupdate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ads auto ends';

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
        $data_client = array(
            'name' => 'webdev tst',
            'emailmessage' => 'hello testing'
        );        
        $to_client = 'websitedesignanddeveloper@gmail.com';

        $mail = \Mail::send('emails.emailnotification', compact('data_client'), function ($message) use ($data_client, $to_client) {
            $message->to($to_client)->subject('Avdopt Notification');
            $message->from('avdopt@info.com','Avdopt');
        });

        /*$adssubscriptions = AdsSubscriptions::get();        

        foreach($adssubscriptions as $key=>$value)
        {            
            $value->adevertisementlist = Advertisement::where('id', $value->ads_id)->first();
            $value->userbanners = UsersBanner::where('ads_id', $value->adevertisementlist->id)->get()->toArray();

            $end_date = ''; 
            $senderUserdata = User::find($value->user_id);
            $senderProfileLink = '<a href="'.url("userprofile").'/'.base64_encode($senderUserdata->id).'">'.$senderUserdata->displayname.'</a>';

            $admin = User::where('role_id', '=', 1)->first();
            $admin_id = $admin->id;

            if($value->approve == 1){
                $start_time = $value->start_at;
                $bannerplan = $value->adevertisementlist['banner_plan'];
                $planperiod = $value->adevertisementlist['plan_period'];
                
                if($bannerplan == 'weekly'){
                    $end_date = date('Y-m-d H:i:s', strtotime($start_time . '+'.$planperiod.' week'));
                }
                if($bannerplan == 'monthly'){
                    $end_date = date('Y-m-d H:i:s', strtotime($start_time . '+'.$planperiod.' month'));
                }

                $cdate = date("Y-m-d H:i:s");
                $tdate = date("Y-m-d H:i:s", strtotime($end_date)); 
                $diff = abs(strtotime($tdate) - strtotime($cdate))/3600;
                
                if($diff == 0 && $cdate == $end_date)
                {
                    $updatedata = [
                        'status' => 'Ended',
                        'ended_at' => $end_date,
                        'updated_at' => $cdate
                    ];
                    AdsSubscriptions::where('id', $value->id)->update($updatedata);

                    $notification_message = $senderProfileLink." your Advertisement for ".$value->adevertisementlist->title." - ".$value->adevertisementlist->total_amt."/".$value->adevertisementlist->banner_plan." has successfully ended at ".$tdate;

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
                        'type' => 'Advertisement',
                        'created_by' => $admin_id
                    );

                    $sldata = array(
                        'uuid' => $senderUserdata->uuid,
                        'message' => $notification_message,
                        'type' => 'Advertisement'
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
        }*/
    }
}
