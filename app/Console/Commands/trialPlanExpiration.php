<?php

namespace App\Console\Commands;
use App\Subscription;
use Carbon\Carbon;
use App\User;
use Illuminate\Console\Command;
use App\Events\UserAllNotification;

class trialPlanExpiration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'TrialPlanExpireNotification:trialplanexpirenotification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Trial Plan expires Notification';

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
       
        $data =  Subscription::where('isTrial',1)->get();
        foreach($data as $dt){
            $expirationDate = $dt->ends_at;
            
            $Days3BeforeExpirationDate = Carbon::parse($expirationDate)->subDay(3)->toDateString();

            $Days2BeforeExpirationDate = Carbon::parse($expirationDate)->subDay(2)->toDateString();

            $Day1BeforeExpirationDate = Carbon::parse($expirationDate)->subDay(1)->toDateString();

            $currentDate = Carbon::today()->toDateString();
             
            if($currentDate != $Days3BeforeExpirationDate){
                
                $notification_message = "Your Trial plan is expired on ".$Days3BeforeExpirationDate."";

            }elseif($currentDate != $Days2BeforeExpirationDate) {
                
                $notification_message = "Your Trial plan is expired on ".$Days2BeforeExpirationDate."";

            }elseif ($currentDate != $Day1BeforeExpirationDate){

               $notification_message = "Your Trial plan is expired on ".$Day1BeforeExpirationDate."";
            }
                    $admin = User::where('role_id', '=', 1)->first();
                    $admin_id = $admin->id;
                    $user = User::where('id',$dt->user_id)->get();
                        foreach($user as $users){
                            $user_email = $users->user_email;
                            if(!$user_email){
                                $emaildata = array();
                            }else{
                                $emaildata = array(
                                    'email' => $users->user_email,
                                    'displayname' => $users->displayname,
                                    'email_message' => $notification_message
                                );
                            }                    

                            $notficationdata = array(
                                'user_id' => $users->id,
                                'message' => $notification_message,
                                'type' => 'Trial',
                                'created_by' => $admin_id
                            );

                            $sldata = array(
                                'uuid' => $users->uuid,
                                'message' => $notification_message,
                                'type' => 'Trial'
                            );

                            $messagedata = array(
                                'user_id' => $admin_id,
                                'reciever_id' => $users->id,
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
