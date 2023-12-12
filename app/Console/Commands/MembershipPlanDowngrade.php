<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Plan;
use App\Usergroup;
use App\Subscription;
use DB;
use Carbon\Carbon;
use App\Events\UserAllNotification;

class MembershipPlanDowngrade extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'MembershipPlanDowngrade:membershipplandowngrade';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Membership Plan Downgrade';

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
      $allsubscriptions = Subscription::where('user_id', Auth::user()->id)->where('name', 'main')->where('quantity', '1')->first();

      $now = Carbon::now();
      $nextsubscription = '';
      $messageprc = '';

      foreach($allsubscriptions as $key=>$value)
      {
        $user_id = $value->user_id;
        $subscription_id = $value->id;
        $stripe_plan = $value->stripe_plan;
        $ends_at = $value->ends_at;

        $user = User::find($user_id);

          if($now > $ends_at){

                $nextsubscription = Subscription::where('user_id', $user_id)->where('name', 'main')->where('quantity', '0')->first();

                if(isset($nextsubscription) && !empty($nextsubscription)){

                  $oldsubscriptiondata = Subscription::find($subscription_id);
                  $oldsubscriptiondata->delete();

                  Subscription::where('user_id', $user_id)->where('name', 'main')->where('quantity', '0')->update(['quantity' => '1', 'ends_at' => $now]);

                  $subscription = Subscription::where('user_id', $user_id)->where('name', 'main')->where('quantity', '1')->first();

                  $newplandata = Plan::where('plan_id', $subscription->stripe_plan)->first();

                  //NOTIFICATIONS START
                  $admin = User::where('role_id', '=', 1)->first();
                  $admin_id = $admin->id;
                  if($subscription->stripe_plan == 'plan_DGPRyjNYWH0Y1h'){
                    $message = "Congratulation ".$user->displayname."! Your's new plan Free is successfully activated";
                  }else{
                    $message = "Congratulation ".$user->displayname."! Your's new plan ".$newplandata->name." is successfully activated and you needs to pay due amount for plan ".$newplandata->name.".";
                  }
                  $messageprc = $message;
                  $user_email = $user->user_email;
                  if(!$user_email){
                      $emaildata = array();
                  }else{
                      $emaildata = array(
                          'email' => $user->user_email,
                          'displayname' => $user->displayname,
                          'email_message' => $message
                      );
                  }

                  $messagedata = array(
                      'user_id' => $admin_id,
                      'reciever_id' => $user->id,
                      'message' => $message,
                      'type' => 'message_notification'
                  );

                  $notficationdata = array(
                      'user_id' => $user->id,
                      'message' => $message,
                      'type' => 'plan_activated',
                      'created_by' => $admin_id
                  );

                  $sldata = array(
                      'uuid' => $user->uuid,
                      'message' => $message,
                      'type' => 'Plan Activated'
                  );

                  $allnoticationdata = array(
                      'emailtype' =>$emaildata,
                      'messagetype' =>$messagedata,
                      'notificationtype' =>$notficationdata,
                      'sl_notificationtype' =>$sldata
                  );

                  \Event::fire(new UserAllNotification($allnoticationdata));
                  //NOTIFICATIONS END
                }

              }

      } //End Foreach

    }


}
