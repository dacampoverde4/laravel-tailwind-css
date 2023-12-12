<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Plan;
use App\Subscription;
use DB;
use Carbon\Carbon;
use App\Events\UserAllNotification;
use Auth;

class MembershipAutoPayAutoRenew extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'MembershipAutoPayAutoRenew:membershipautopayautorenew';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Membership Auto Pay and Auto Renew';

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
        $allsubscriptions = Subscription::where('name', 'main')->where('quantity', '1')->orderBy('id', 'desc')->get();
        $now = Carbon::now();
        foreach ($allsubscriptions as $key => $value) {
            $user_id = $value->user_id;
            $stripe_plan = $value->stripe_plan;
            $ends_at = $value->ends_at;

            $user = User::find($user_id);

            if ($now > $ends_at) {
                $walletsdata = DB::table('wallets')->where('user_id', $user_id)->first();
                $wallet_amount = 0;
                if ($walletsdata != '') {
                    $wallet_amount = $walletsdata->balance;
                }

                $plandata = Plan::where('plan_id', $stripe_plan)->first();
                $amount = $plandata->price;
                $planname = $plandata->name;

                $userid = $user->id;

                $walletsdata = DB::table('wallets')->where('user_id',$userid)->first();
                $wallet_amount = 0;
                if($walletsdata != ''){
                    $wallet_amount = $walletsdata->balance;
                    $balance = ($wallet_amount - $amount);
                }


                $description = array('description' => 'Your current plan : ' . $planname . ' of amount ' . $amount . ' is auto renewed using your wallet balance.', 'balance' => $balance);

                if ($stripe_plan) {
                    if ($wallet_amount >= $amount) {
                        $user = User::find($user_id);
                        $expiry_date = getExpiryDate($stripe_plan);

                        if ($newplanbuy == 1) {
                            $subscription = new Subscription();
                            $subscription->user_id = $user_id;
                            $subscription->name = 'main';
                            $subscription->stripe_plan = $stripe_plan;
                            $subscription->quantity = '1';
                            $subscription->ends_at = $expiry_date;
                            $subscription->save();
                        } else {
                            if ($user->subscribedPlan('main')) {
                                Subscription::where('user_id', $user_id)->where('name', 'main')
                                    ->update(['stripe_plan' => $stripe_plan, 'ends_at' => $expiry_date]);
                            }
                        }

                        $user->withdraw($amount, 'withdraw', $description);

                        //NOTIFICATIONS START
                        $admin = User::where('role_id', '=', 1)->first();
                        $admin_id = $admin->id;

                        $message = 'Congratulation ' . $user->displayname . '! Your current plan ' . $planname . ' successfully renewd by auto from wallet.Your payment of ' . $amount . ' Tokens was successfully received.';

                        $user_email = $user->user_email;
                        if (!$user_email) {
                            $emaildata = array();
                        } else {
                            $emaildata = array(
                                'email' => $user->user_email,
                                'displayname' => $user->displayname,
                                'email_message' => $message,
                            );
                        }

                        $messagedata = array(
                            'user_id' => $admin_id,
                            'reciever_id' => $user->id,
                            'message' => $message,
                            'type' => 'message_notification',
                        );

                        $notficationdata = array(
                            'user_id' => $user->id,
                            'message' => $message,
                            'type' => 'payment_deposite',
                            'created_by' => $admin_id,
                        );

                        $sldata = array(
                            'uuid' => $user->uuid,
                            'message' => $message,
                            'type' => 'Payment Notification',
                        );

                        $allnoticationdata = array(
                            'emailtype' => $emaildata,
                            'messagetype' => $messagedata,
                            'notificationtype' => $notficationdata,
                            'sl_notificationtype' => $sldata,
                        );

                        \Event::fire(new UserAllNotification($allnoticationdata));
                        //NOTIFICATIONS END
                    } else {
                        //NOTIFICATIONS START
                        $admin = User::where('role_id', '=', 1)->first();
                        $admin_id = $admin->id;

                        $message = '' . $user->displayname . '! Your current plan ' . $planname . ' is expired and you have not enough tokens in your wallet for auto renew. Please pay your bill of ' . $amount . ' to renew your plan.';

                        $user_email = $user->user_email;
                        if (!$user_email) {
                            $emaildata = array();
                        } else {
                            $emaildata = array(
                                'email' => $user->user_email,
                                'displayname' => $user->displayname,
                                'email_message' => $message,
                            );
                        }

                        $messagedata = array(
                            'user_id' => $admin_id,
                            'reciever_id' => $user->id,
                            'message' => $message,
                            'type' => 'message_notification',
                        );

                        $notficationdata = array(
                            'user_id' => $user->id,
                            'message' => $message,
                            'type' => 'payment_pending',
                            'created_by' => $admin_id,
                        );

                        $sldata = array(
                            'uuid' => $user->uuid,
                            'message' => $message,
                            'type' => 'Payment Notification',
                        );

                        $allnoticationdata = array(
                            'emailtype' => $emaildata,
                            'messagetype' => $messagedata,
                            'notificationtype' => $notficationdata,
                            'sl_notificationtype' => $sldata,
                        );

                        \Event::fire(new UserAllNotification($allnoticationdata));
                        //NOTIFICATIONS END
                    }
                }
            }
        }
    }
}
