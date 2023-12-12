<?php

namespace App\Http\Controllers\Api;
use Carbon\Carbon;
use App\Plan;
use App\Subscription;
use App\User;
use Auth;
use App\UserMessage;
use App\FeatureSetting;
use App\Tokens;
use App\VerifyUser;
use App\Donation;
use App\Notification;
use App\Advertisement;
use App\Models\CheckoutModel;
use App\SecondLifeUsersNotification;
use App\AdsSubscriptions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use App\Events\UserAllNotification;
use DB;
use App\Wallet;
use App\Models\Coupon;
use App\Prepurches;
use Hash;
class SecondLifeApiPaymentController extends SecondLifeApiBaseController
{


    public function __construct()
    {
        parent::__construct();
    }


    public function addBalanceToUser(Request $request)
    {   
        $uuid="";
        if($request->has('uuid') && $request->get('uuid')!=null)
        {
            $uuid=$request->get('uuid');
        }

        if(!$uuid)
        {
            return $this->sendErrorResponse('Please provide UUID.');
        }

        $user = User::where('uuid', '=', $uuid)
            ->first();

        if ($user === null) {
            return $this->sendErrorResponse('UUID not found.');
        }

        $amount=0;
        if($request->has('amount') && $request->get('amount')!=null)
        {
            $amount=intval($request->get('amount'));
        }

        if(!$amount)
        {
            return $this->sendErrorResponse('Please provide amount.');
        }


        //   $checkout = new CheckoutModel;
        //   $checkout->uuid = $uuid;
        //   $checkout->transction_type = 'addbalancetouser';
        //   $checkout->amount = $amount;
        //   $checkout->status = 0;
        //   $checkout->save();
        $user->deposit($amount, 'deposit', ['description' => 'You deposited '.$amount]);

        //Notifications start
                $new_wallet = DB::table('wallets')->where('user_id',$user->id)->first();
                $wallet_amount = $new_wallet->balance;
                $admin = User::where('role_id', '=', 1)->first();
                $admin_id = $admin->id;



            $message = $user->displayname." your deposit of ".$amount." Tokens was successful. Your wallet balance is: ".$wallet_amount." Tokens.";

            $emaildata = array(
                'email' => $user->email,
                'displayname' => $user->displayname,
                'email_message' => $message
            );

            $messagedata = array(
                'user_id' => $admin_id,
                'reciever_id' => $user->id,
                'message' => $message,
                'type' => 'message_notification'
            );

            $notficationdata = array(
                'user_id' => $user->id,
                'message' => $message,
                'type' => 'payment_deposite',
                'created_by' => $admin_id
            );

            $sl_notificationdata = array(
                'uuid' => $uuid,
                'message' => $message,
                'type' => 'Payment Notification'
            );

            $allnoticationdata = array(
                'emailtype' =>$emaildata,
                'messagetype' =>$messagedata,
                'notificationtype' =>$notficationdata,
                'sl_notificationtype' =>$sl_notificationdata
            );

             \Event::fire(new UserAllNotification($allnoticationdata));
        //Notifications end
        $response_json = $this->sendSuccessResponse(array($allnoticationdata),'Balance added successfully.');

        return $response_json;

    }
    public function payCheckout(Request $request){
        $uuid="";
        if($request->has('uuid') && $request->get('uuid')!=null)
        {
            $uuid=$request->get('uuid');
        }

        if(!$uuid)
        {
            return $this->sendErrorResponse('Please provide UUID.');
        }

        $user = User::where('uuid', '=', $uuid)
            ->first();
        if ($user === null) {
            return $this->sendErrorResponse('UUID not found.');
        }
        $amount=0;
        if($request->has('amount') && $request->get('amount')!=null)
        {
            $amount=intval($request->get('amount'));
        }

        if(!$amount)
        {
            return $this->sendErrorResponse('Please provide amount.');
        }
        $checkout = CheckoutModel::where('uuid', '=', $uuid)->where('status', '=', 0)->first();   
        if($checkout){
            if($checkout->transction_type == 'addbalancetouser'){
            $user->deposit($amount, 'deposit', ['description' => 'You deposited '.$amount]);
            $Checkout = $checkout->status = 1;
            $checkout->save();
        
        $new_wallet = DB::table('wallets')->where('user_id',$user->id)->first();
        $wallet_amount = $new_wallet->balance;
        $admin = User::where('role_id', '=', 1)->first();
        $admin_id = $admin->id;
        $message = $user->displayname." your deposit of ".$amount." Tokens was successful. Your wallet balance is: ".$wallet_amount." Tokens.";

            $emaildata = array(
                'email' => $user->email,
                'displayname' => $user->displayname,
                'email_message' => $message
            );

            $messagedata = array(
                'user_id' => $admin_id,
                'reciever_id' => $user->id,
                'message' => $message,
                'type' => 'message_notification'
            );

            $notficationdata = array(
                'user_id' => $user->id,
                'message' => $message,
                'type' => 'payment_deposite',
                'created_by' => $admin_id
            );

            $sl_notificationdata = array(
                'uuid' => $uuid,
                'message' => $message,
                'type' => 'Payment Notification'
            );

            $allnoticationdata = array(
                'emailtype' =>$emaildata,
                'messagetype' =>$messagedata,
                'notificationtype' =>$notficationdata,
                'sl_notificationtype' =>$sl_notificationdata
            );

              \Event::fire(new UserAllNotification($allnoticationdata));
        //Notifications end
        $response_json = $this->sendSuccessResponse(array($allnoticationdata),'Balance added successfully.');

        return $response_json;
        }if($checkout->transction_type == 'addDonation'){
            $userid = $user->id;
            $donationdata = Donation::where('user_id', $userid)->first();
            if(!$donationdata)
            {
              $donation = new Donation;
              $donation->user_id = $userid;
              $donation->amount = $amount;
              $donation->is_supporter = $is_supporter;
              $donation->show_amount = $show_amount;
              $donation->save();

            }else{
              $newamount = $donationdata->amount + $amount;
              Donation::where('user_id', $userid)->update(['amount' => $newamount, 'is_supporter' =>$request->input('show_supporter'), 'show_amount' =>$request->input('show_amount')]);
            }
            $Checkout = $checkout->status = 1;
            $checkout->save();
            $wallet = DB::table('wallets')->where('user_id',$user->id)->first();
            if($wallet){
                $wallet_amount = $wallet->balance;
            }

            $admin = User::where('role_id', '=', 1)->first();
            $admin_id = $admin->id;

            /*$message = $user->displayname." your deposit of ".$amount." Tokens was successful. Your wallet balance is: ".$wallet_amount." Tokens.";*/

            $encodeid = base64_encode($user->id);
            $url = url('/userprofile/'.$encodeid);
            $userprofilelink = '['.$url.']'.$user->name;
            $message = "Thanks for your generous donation  ".$userprofilelink."! You've earned a permanent space both as our supporter and in our hearts...";

            $emaildata = array(
                'email' => $user->email,
                'displayname' => $user->displayname,
                'email_message' => $message
            );

            $messagedata = array(
                'user_id' => $admin_id,
                'reciever_id' => $user->id,
                'message' => $message,
                'type' => 'message_notification'
            );

            $notficationdata = array(
                'user_id' => $user->id,
                'message' => $message,
                'type' => 'payment_deposite',
                'created_by' => $admin_id
            );

            $sl_notificationdata = array(
                'uuid' => $uuid,
                'message' => $message,
                'type' => 'Payment Notification'
            );

            $allnoticationdata = array(
                'emailtype' =>$emaildata,
                'messagetype' =>$messagedata,
                'notificationtype' =>$notficationdata,
                'sl_notificationtype' =>$sl_notificationdata
            );
            //  \Event::fire(new UserAllNotification($allnoticationdata));
        //Notifications end

        $response_json = $this->sendSuccessResponse(array(),'Deposite added successfully.');
        return $response_json;

        }
        }
        else{
            return $this->sendErrorResponse('Do not have any checkout opertion.');
        }

    }
    public function payCheckoutInfo(Request $request){
        $uuid="";
        if($request->has('uuid') && $request->get('uuid')!=null)
        {
            $uuid=$request->get('uuid');
        }
        if(!$uuid)
        {
            return $this->sendErrorResponse('Please provide UUID.');
        }
        $user = User::where('uuid', '=', $uuid)
            ->first();
        if ($user === null) {
            return $this->sendErrorResponse('UUID not found.');
        }
        $checkout = CheckoutModel::where('uuid', '=', $uuid)->where('status', '=', 0)->first();   
        if($checkout){
            $return_json = array(
                'success' => 1,
                'checkout'=> $checkout,
            );
            return json_encode($return_json);
        }else{
            $checkout = 0;
            $return_json = array(
                'success' => 0,
                'checkout'=> $checkout,
            );
            return json_encode($return_json);
        }
    }

    public function getUserBalance(Request $request)
    {

        $uuid="";
        if($request->has('uuid') && $request->get('uuid')!=null)
        {
            $uuid=$request->get('uuid');
        }
        if(!$uuid)
        {
            return $this->sendErrorResponse('Please provide UUID.');
        }
        $user = User::where('uuid', '=', $uuid)
            ->first();
        if ($user === null) {
            return $this->sendErrorResponse('UUID not found.');
        }
        $response_json = $this->sendSuccessResponse(array('amount'=>$user->balance),'Success.');
        return $response_json;
    }
    public function prepurchasePlan(Request $request){
        $uuid="";
        if($request->has('uuid') && $request->get('uuid')!=null)
        {
            $uuid=$request->get('uuid');
        }
        $user = User::where('uuid', '=', $uuid)
        ->first();
    if ($user === null) {
        return $this->sendErrorResponse('UUID not found.');
    }
    $plan_id="";
    if($request->has('plan_id') && $request->get('plan_id')!=null)
    {
        $plan_id=$request->get('plan_id');
    }
    if(!$plan_id)
    {
        return $this->sendErrorResponse('Please provide plan id.');
    }
    $plan = Plan::where('plan_id', '=', $plan_id)->first();
        if($user->currentplan->plan_id==$request->plan_id){
            return $this->sendErrorResponse('Allready you have active this plan .');
        }
        else{
            $cond=['user_id'=>$user->id];
            $Prepurche=Prepurches::where($cond)->first();
            $row=array(
                'uuid'=>$uuid,
                'plan_id'=>$plan->id,
                'user_id'=>$user->id,
            );
           $query= Prepurches::updateOrCreate(
                ['user_id' => $row['user_id']],
                $row
            );
            $response_json = $this->sendSuccessResponse(array(),'Plan saved successfully.');
            return $response_json;
        }

    }
    public function purchasePlan(Request $request)
    {
        $uuid="";
        $newplanbuy = $request->input('newplanbuy');

        if($request->has('uuid') && $request->get('uuid')!=null)
        {
            $uuid=$request->get('uuid');
        }

        if(!$uuid)
        {
            return $this->sendErrorResponse('Please provide UUID.');
        }

        $user = User::where('uuid', '=', $uuid)
            ->first();

        if ($user === null) {

            return $this->sendErrorResponse('UUID not found.');
        }
        $main_user_id = $user->id;

        $plan_id="";
        if($request->has('plan_id') && $request->get('plan_id')!=null)
        {
            $plan_id=$request->get('plan_id');
        }

        if(!$plan_id)
        {
            return $this->sendErrorResponse('Please provide plan id.');
        }

        $plan = Plan::where('plan_id', '=', $plan_id)
            ->first();
        if ($plan === null) {
            return $this->sendErrorResponse('Plan not found.');
        }

        $amount=0;
        if($request->has('amount') && $request->get('amount')!=null)
        {
            $amount=intval($request->get('amount'));
        }
        if($request->has('amount') && $request->get('amount')==0)
        {
            $wallet_obj = $user->walletData;
            if($wallet_obj->balance >= $plan->price){
                 $wltamot=$wallet_obj->balance-$plan->price;
                if($wltamot>=0){

                    $wallet_obj->balance=$wltamot;
                    $wallet_obj->save();
                }
                $prepurches_obj = Prepurches::where('user_id', $main_user_id)->first();
                $prepurches_obj->plan_id = '';
                $prepurches_obj->save();
                $response_json = $this->sendSuccessResponse(array(),'Plan purchased successfully.');
                return $response_json;
            }
           else{
            $response_json = $this->sendSuccessResponse(array(),'Insufficient amount');
            return $response_json;
           }

            $amount=intval($request->get('amount'));
        }

        if(!$amount)
        {
            return $this->sendErrorResponse('Please provide amount.');
        }

        if($plan){
            $cond=['user_id'=>$user->id];

            $expiry_date = getExpiryDate($request->plan_id);


            if(!$user->subscribed('main')){

                $subscription = new Subscription;
                $subscription->user_id = $user->id;
                $subscription->name = 'main';
                $subscription->stripe_plan = $plan_id;
                $subscription->quantity = '1';
                $subscription->ends_at = $expiry_date;
                $subscription->save();
            }

            if ($user->subscribed('main')) {

               Subscription::where('user_id', $user->id)->where('name', 'main')
                        ->update(['stripe_plan' => $plan_id, 'ends_at' => $expiry_date]);
            }
        }
            $wallet_obj = $user->walletData;
            $wallet_obj->balance;
            $walletreqamount=$wallet_obj->balance+$request->amount;
            if($wallet_obj->balance >= $plan->price){
                $remning=$wallet_obj->balance-$plan->price;
                if ($remning < 0){
                    $response_json = $this->sendSuccessResponse(array(),'Insufficient amount');
                    return $response_json;
                }elseif(abs($remning) > 0){
                $amount=$remning-$amount;
                if ($amount < 0){
                $response_json = $this->sendSuccessResponse(array(),'Insufficient amount');
                    return $response_json;
                }elseif(abs($amount) > 0){
                    $wallet_obj->balance=$amount;
                    $wallet_obj->save();
                }
            }
            }elseif($walletreqamount >= $plan->price){
                $walletreqamount=$walletreqamount-$plan->price;
                    $wallet_obj->balance=$walletreqamount;
                    $wallet_obj->save();
            }else{
                $response_json = $this->sendSuccessResponse(array(),'Insufficient amount');
                return $response_json;
            }

            $user = User::find(Auth::user()->id);
            $userid = $user->id;

            $walletsdata = DB::table('wallets')->where('user_id',$userid)->first();
            $wallet_amount = 0;
            if($walletsdata != ''){
                $wallet_amount = $walletsdata->balance;
                if(is_numeric($wallet_amount) && is_numeric($amount)){
                    $balance = ($wallet_amount + $amount);
                  }else {
                    $balance = 'NA';
                  }
            }


              $user->deposit($amount, 'deposit', ['description' => 'You deposited '.$amount.' amount for Plan : '.$plan->name, 'balance' => $balance ]);

        // $user->withdraw($amount, 'withdraw', ['description' => 'You purchased plan '.$plan->name]);

        //Notifications start
            if($request->appliedcouponcode_flag){
                $coupon_obj = Coupon::whereRaw('BINARY `coupon_code` = ?', $request->appliedcouponcode)->first();
                if($coupon_obj->discountType->slug == 'token_off' || $coupon_obj->discountType->slug == 'both'){
                    $wallet_obj->balance = $wallet_obj->balance + $coupon_obj->token_amt;
                    $wallet_obj->save();
                }
                if($coupon_obj->discountType->slug == 'discount_percentage' || $coupon_obj->discountType->slug == 'both'){
                    $amount = number_format($request->amount - (($request->amount * $coupon_obj->discount) / 100), 2);
                }
                $coupon_obj->count = $coupon_obj->count - 1;
                $coupon_obj->save();
                }

            $wallet = DB::table('wallets')->where('user_id',$user->id)->first();
            $wallet_amount = $wallet->balance;
            $admin = User::where('role_id', '=', 1)->first();
            $admin_id = $admin->id;
            if($newplanbuy == 1){
                $message = $user->displayname.", welcome to a world of possibilities with your ".$plan->name." premium plan";
            }else{
                $message = "Congratulation ".$user->displayname."! You've successfully upgraded to ".$plan->name." premium plan and your payment of ".$amount." Tokens was successfully received.";
            }

            $emaildata = array(
                'email' => $user->email,
                'displayname' => $user->displayname,
                'email_message' => $message
            );

            $messagedata = array(
                'user_id' => $admin_id,
                'reciever_id' => $user->id,
                'message' => $message,
                'type' => 'message_notification'
            );

            $notficationdata = array(
                'user_id' => $user->id,
                'message' => $message,
                'type' => 'payment_deposite',
                'created_by' => $admin_id
            );

            $sl_notificationdata = array(
                'uuid' => $uuid,
                'message' => $message,
                'type' => 'Payment Notification'
            );

            $allnoticationdata = array(
                'emailtype' =>$emaildata,
                'messagetype' =>$messagedata,
                'notificationtype' =>$notficationdata,
                'sl_notificationtype' =>$sl_notificationdata
            );

             \Event::fire(new UserAllNotification($allnoticationdata));


        //Notifications end
        $prepurches_obj = Prepurches::where('user_id', $main_user_id)->first();
        $prepurches_obj->plan_id = '';
        $prepurches_obj->save();
        $response_json = $this->sendSuccessResponse(array(),'Plan purchased successfully.');
        return $response_json;
    }

    public function purchasePlanFeature(Request $request)
    {

        $uuid="";
        if($request->has('uuid') && $request->get('uuid')!=null)
        {
            $uuid=$request->get('uuid');
        }

        if(!$uuid)
        {
            return $this->sendErrorResponse('Please provide UUID.');
        }

        $user = User::where('uuid', '=', $uuid)
            ->first();

        if ($user === null) {
            return $this->sendErrorResponse('UUID not found.');
        }

        $plan_id="";
        if($request->has('plan_id') && $request->get('plan_id')!=null)
        {
            $plan_id=$request->get('plan_id');
        }

        if(!$plan_id)
        {
            return $this->sendErrorResponse('Please provide plan id.');
        }

        $plan = FeatureSetting::where('plan_id', '=', $plan_id)
            ->first();

        if ($plan === null) {
            return $this->sendErrorResponse('Plan not found.');
        }


        $amount=0;
        if($request->has('amount') && $request->get('amount')!=null)
        {
            $amount=intval($request->get('amount'));
        }

        if(!$amount)
        {
            return $this->sendErrorResponse('Please provide amount.');
        }

        $userid = $user->id;

        if($plan){

            $expiry_date = getExpiryDate($plan_id);
            $sub_featured = Subscription::where('user_id', $userid)->where('name', 'feature')->first();
            if($sub_featured == ''){
                $subscription = new Subscription;
                $subscription->user_id = $user->id;
                $subscription->name = 'feature';
                $subscription->stripe_plan = $plan_id;
                $subscription->quantity = '1';
                $subscription->ends_at = $expiry_date;
                $subscription->save();
            }else{
                Subscription::where('user_id', $user->id)->where('name', 'feature')
                    ->update(['stripe_plan' => $plan_id, 'ends_at' => $expiry_date]);
            }
        }

        // $user->deposit($amount, 'deposit', ['description' => 'You deposited '.$amount.' amount for Plan : '.$plan->name]);

        //NOTIFICATIONS START
            $wallet = DB::table('wallets')->where('user_id',$user->id)->first();
            $wallet_amount = $wallet->balance;

            $admin = User::where('role_id', '=', 1)->first();
            $admin_id = $admin->id;

            $message = "Congratulation ".$user->displayname."! You've successfully upgraded to ".$plan->name." feature plan and your payment of ".$amount." Tokens was successfully received.";

            $emaildata = array(
                'email' => $user->email,
                'displayname' => $user->displayname,
                'email_message' => $message
            );

            $messagedata = array(
                'user_id' => $admin_id,
                'reciever_id' => $user->id,
                'message' => $message,
                'type' => 'message_notification'
            );

            $notficationdata = array(
                'user_id' => $user->id,
                'message' => $message,
                'type' => 'payment_deposite',
                'created_by' => $admin_id
            );

            $sl_notificationdata = array(
                'uuid' => $uuid,
                'message' => $message,
                'type' => 'Payment Notification'
            );

            $allnoticationdata = array(
                'emailtype' =>$emaildata,
                'messagetype' =>$messagedata,
                'notificationtype' =>$notficationdata,
                'sl_notificationtype' =>$sl_notificationdata
            );
             \Event::fire(new UserAllNotification($allnoticationdata));
        //NOTIFICATIONS END

        $response_json = $this->sendSuccessResponse(array(),'Feature Plan purchased successfully.');

        return $response_json;
    }

    public function purchaseToken(Request $request)
    {
        $uuid="";
        if($request->has('uuid') && $request->get('uuid')!=null)
        {
            $uuid=$request->get('uuid');
        }

        if(!$uuid)
        {
            return $this->sendErrorResponse('Please provide UUID.');
        }

        $user = User::where('uuid', '=', $uuid)
            ->first();

        if ($user === null) {
            return $this->sendErrorResponse('UUID not found.');
        }

        $plan_id="";
        if($request->has('plan_id') && $request->get('plan_id')!=null)
        {
            $plan_id=$request->get('plan_id');
        }

        if(!$plan_id)
        {
            return $this->sendErrorResponse('Please provide plan id.');
        }

        $plan = Tokens::where('id', '=', $plan_id)
            ->first();

        if ($plan === null) {
            return $this->sendErrorResponse('Token not found.');
        }

        $amount=0;
        if($request->has('amount') && $request->get('amount')!=null)
        {
            $amount=intval($request->get('amount'));
        }

        if(!$amount)
        {
            return $this->sendErrorResponse('Please provide amount.');
        }

        $cond=['user_id'=>$user->id];
        $Prepurche=Prepurches::where($cond)->first();
        $row=array(
            'uuid'=>$uuid,
            'token_id'=>$plan->id,
            'user_id'=>$user->id,
        );

       $query= Prepurches::updateOrCreate(
            ['user_id' => $row['user_id']],
            $row
        );

        $user->deposit($amount, 'deposit', ['description' => 'You deposited '.$amount.' amount for Token : '.$plan->title]);

        //Notifications start
            $wallet = DB::table('wallets')->where('user_id',$user->id)->first();
            $wallet_amount = $wallet->balance;

            $admin = User::where('role_id', '=', 1)->first();
            $admin_id = $admin->id;

            $message = $user->displayname." your deposit of ".$amount." Tokens was successful. Your wallet balance is: ".$wallet_amount." Tokens.";

            $emaildata = array(
                'email' => $user->email,
                'displayname' => $user->displayname,
                'email_message' => $message
            );

            $messagedata = array(
                'user_id' => $admin_id,
                'reciever_id' => $user->id,
                'message' => $message,
                'type' => 'message_notification'
            );

            $notficationdata = array(
                'user_id' => $user->id,
                'message' => $message,
                'type' => 'payment_deposite',
                'created_by' => $admin_id
            );

            $sl_notificationdata = array(
                'uuid' => $uuid,
                'message' => $message,
                'type' => 'Payment Notification'
            );

            $allnoticationdata = array(
                'emailtype' =>$emaildata,
                'messagetype' =>$messagedata,
                'notificationtype' =>$notficationdata,
                'sl_notificationtype' =>$sl_notificationdata
            );
            \Event::fire(new UserAllNotification($allnoticationdata));
        //Notifications end

        $response_json = $this->sendSuccessResponse(array($allnoticationdata),'Token plan purchased successfully.');

        return $response_json;
    }

    public function addDonation(Request $request)
    {   
        $is_supporter = $request->input('show_supporter');
        $show_amount = $request->input('show_amount');

        $uuid="";
        if($request->has('uuid') && $request->get('uuid')!=null)
        {
            $uuid=$request->get('uuid');
        }

        if(!$uuid)
        {
            return $this->sendErrorResponse('Please provide UUID.');
        }

        $user = User::where('uuid', '=', $uuid)
            ->first();

        if ($user === null) {
            return $this->sendErrorResponse('UUID not found.');
        }

        $amount=0;
        if($request->has('amount') && $request->get('amount')!=null)
        {
            $amount=intval($request->get('amount'));
        }

        if(!$amount)
        {
            return $this->sendErrorResponse('Please provide amount.');
        }

        $userid = $user->id;

          $checkout = new CheckoutModel;
          $checkout->uuid = $uuid;
          $checkout->transction_type = 'addDonation';
          $checkout->amount = $amount;
          $checkout->status = 0;
          $checkout->save();

       
        // $user->deposit($amount, 'deposit', ['description' => 'You donated '.$amount.' amount']);

        //Notifications start
            $wallet = DB::table('wallets')->where('user_id',$user->id)->first();
            if($wallet){
                $wallet_amount = $wallet->balance;
            }

            $admin = User::where('role_id', '=', 1)->first();
            $admin_id = $admin->id;

            /*$message = $user->displayname." your deposit of ".$amount." Tokens was successful. Your wallet balance is: ".$wallet_amount." Tokens.";*/

            $encodeid = base64_encode($user->id);
            $url = url('/userprofile/'.$encodeid);
            $userprofilelink = '['.$url.']'.$user->name;
            $message = "Thanks for your generous donation  ".$userprofilelink."! You've earned a permanent space both as our supporter and in our hearts...";

            $emaildata = array(
                'email' => $user->email,
                'displayname' => $user->displayname,
                'email_message' => $message
            );

            $messagedata = array(
                'user_id' => $admin_id,
                'reciever_id' => $user->id,
                'message' => $message,
                'type' => 'message_notification'
            );

            $notficationdata = array(
                'user_id' => $user->id,
                'message' => $message,
                'type' => 'payment_deposite',
                'created_by' => $admin_id
            );

            $sl_notificationdata = array(
                'uuid' => $uuid,
                'message' => $message,
                'type' => 'Payment Notification'
            );

            $allnoticationdata = array(
                'emailtype' =>$emaildata,
                'messagetype' =>$messagedata,
                'notificationtype' =>$notficationdata,
                'sl_notificationtype' =>$sl_notificationdata
            );
             \Event::fire(new UserAllNotification($allnoticationdata));
        //Notifications end

        $response_json = $this->sendSuccessResponse(array(),'Deposite added successfully.');
        return $response_json;
    }

    public function addAdvertisement(Request $request)
    {
        $uuid="";
        $newplanbuy = $request->input('newplanbuy');

        if($request->has('uuid') && $request->get('uuid')!=null)
        {
            $uuid=$request->get('uuid');
        }

        if(!$uuid)
        {
            return $this->sendErrorResponse('Please provide UUID.');
        }

        $user = User::where('uuid', '=', $uuid)->first();

        if ($user === null) {
            return $this->sendErrorResponse('UUID not found.');
        }

        $ads_id="";
        if($request->has('ads_id') && $request->get('ads_id')!=null)
        {
            $ads_id=$request->get('ads_id');
        }

        if(!$ads_id)
        {
            return $this->sendErrorResponse('Please provide advertisement id.');
        }

        $advertisement = Advertisement::where('id', '=', $ads_id)->first();

        if ($advertisement === null) {
            return $this->sendErrorResponse('Advertisement not found.');
        }

        $amount=0;
        if($request->has('amount') && $request->get('amount')!=null)
        {
            $amount=intval($request->get('amount'));
        }

        if(!$amount)
        {
            return $this->sendErrorResponse('Please provide amount.');
        }

        $userid = $user->id;
        if ($amount)
        {
            $is_ads_subscribe = AdsSubscriptions::where('ads_id', $ads_id)->where('user_id', $userid)->orderBy('id', 'desc')->first();

            if($is_ads_subscribe == ''){

                $adssubscriptions = new AdsSubscriptions();
                $adssubscriptions->ads_id = $ads_id;
                $adssubscriptions->user_id = $userid;
                $adssubscriptions->status = 'Inactive';
                $adssubscriptions->paid = 1;
                $adssubscriptions->approve = 0;
                $adssubscriptions->save();

                $walletsdata = DB::table('wallets')->where('user_id',$userid)->first();
                $wallet_amount = 0;
                if($walletsdata != ''){
                    $wallet_amount = $walletsdata->balance;
                    if(is_numeric($wallet_amount) && is_numeric($amount)){
                        $balance = ($wallet_amount + $amount);
                      }else {
                        $balance = 'NA';
                      }
                }

                $user->deposit($amount, 'deposit', ['description' => 'You deposited '.$amount.' amount for Advertisement', 'balance' => $balance]);

            }elseif($is_ads_subscribe != '' && count($is_ads_subscribe) > 0 && $is_ads_subscribe->status == 'Deleted'){

                $adssubscriptions = new AdsSubscriptions();
                $adssubscriptions->ads_id = $ads_id;
                $adssubscriptions->user_id = $userid;
                $adssubscriptions->status = 'Inactive';
                $adssubscriptions->paid = 1;
                $adssubscriptions->approve = 0;
                $adssubscriptions->save();

                $walletsdata = DB::table('wallets')->where('user_id',$userid)->first();
                $wallet_amount = 0;
                if($walletsdata != ''){
                    $wallet_amount = $walletsdata->balance;
                    if(is_numeric($wallet_amount) && is_numeric($amount)){
                        $balance = ($wallet_amount + $amount);
                      }else {
                        $balance = 'NA';
                      }
                }

                $user->deposit($amount, 'deposit', ['description' => 'You deposited '.$amount.' amount for Advertisement', 'balance' => $balance]);

            }else{

                return $this->sendErrorResponse('Advertisement purchased already');
            }
        }

        //Notifications start
            $wallet = DB::table('wallets')->where('user_id',$user->id)->first();
            $wallet_amount = $wallet->balance;

            $admin = User::where('role_id', '=', 1)->first();
            $admin_id = $admin->id;

            $message = $user->displayname." your deposit of ".$amount." Tokens was successful for advertisement. Your wallet balance is: ".$wallet_amount." Tokens.";

            $emaildata = array(
                'email' => $user->email,
                'displayname' => $user->displayname,
                'email_message' => $message
            );

            $messagedata = array(
                'user_id' => $admin_id,
                'reciever_id' => $user->id,
                'message' => $message,
                'type' => 'message_notification'
            );

            $notficationdata = array(
                'user_id' => $user->id,
                'message' => $message,
                'type' => 'payment_deposite',
                'created_by' => $admin_id
            );

            $sl_notificationdata = array(
                'uuid' => $uuid,
                'message' => $message,
                'type' => 'Payment Notification'
            );

            $allnoticationdata = array(
                'emailtype' =>$emaildata,
                'messagetype' =>$messagedata,
                'notificationtype' =>$notficationdata,
                'sl_notificationtype' =>$sl_notificationdata
            );
            \Event::fire(new UserAllNotification($allnoticationdata));
        //Notifications end

        $response_json = $this->sendSuccessResponse(array(),'Advertisement purchased successfully.');
        return $response_json;
    }
    //pay
    public function getPayData(Request $request){
          
        if($request->has('uuid') && $request->get('uuid')!=null)
        {
            $user=Prepurches::where('uuid',$request->uuid)->first();
            if($user){
                  
                $uuiuser=User::where('uuid',$request->uuid)->first();
                if(empty($uuiuser)){
                    $return_json = array(
                        'success' => true,
                        'walletInfo'=> '',
                        'currentPlan'=>'',
                        'plan_id'=> '',
                        'plan_name'=> '',
                        'amount'=> '',
                        'url'=> '',
                        'token_id'=>'',
                        'token_name'=>'',
                        'token_amount'=>'',
                        'message' => "User not exists"
                    );
                    return $return_json;
                    }
                    $walletInfo = 0;
                    if($uuiuser->walletData){
                        $walletInfo=$uuiuser->walletData->balance;
                    }
                    $currentPlan=0;
                    if($uuiuser->subscribedPlan){
                        $subscribed=$uuiuser->subscribedPlan;
                        $currentPlan=Plan::where('plan_id',$subscribed->stripe_plan)->first();
                        if($currentPlan){
                            $$currentPlan = $currentPlan->name;
                        }else{
                            $currentPlan =0;
                        }
                    }
                     
                    $cplan=Prepurches::where('uuid',$request->uuid)->first();
                    $c_plan=Plan::find($cplan->plan_id);
                    if(!empty($cplan->token_id)){
                        $ctoken= Tokens::where('id',$cplan->token_id)->first();
                    }
                    $purchase_token_id='';
                    $purchase_token_name='';
                    $purchase_token_price='';
                    $purchase_plan_id = '';
                    $purchase_plan_name = '';
                    $purchase_plan_price = '';
                    $message = "";
                    if(!empty($cplan->plan_id)){
                        $purchase_plan_id = $c_plan->plan_id;
                        $purchase_plan_name = $cplan->plan->name;
                        $purchase_plan_price = $cplan->plan->price;
                        $message .= "Purchase plan data available";
                    }else{
                        $message .= "No purchase plan data available";
                    }
                    if(!empty($ctoken)){
                        $purchase_token_id = $ctoken->id;
                        $purchase_token_name = $ctoken->title;
                        $purchase_token_price = $ctoken->amount;
                        $message .= " and token plan data available";
                    }else{
                        $message .= " and no token data available";
                    }

                    $return_json = array(
                        'success' => true,
                        'walletInfo'=> $walletInfo,
                        'currentPlan'=> $currentPlan,
                        'plan_id'=> $purchase_plan_id,
                        'plan_name'=> $purchase_plan_name,
                        'amount'=> $purchase_plan_price,
                        'url'=> route('home'),
                        'token_id'=>$purchase_token_id,
                        'token_name'=>$purchase_token_name,
                        'token_amount'=>$purchase_token_price,
                        'message' => $message
                    );
                    /*$response_json = $this->sendSuccessResponse(array(
                        'walletInfo'=> $walletInfo,
                        'currentPlan'=> $currentPlan,
                        'plan_id'=> $purchase_plan_id,
                        'plan_name'=> $purchase_plan_name,
                        'amount'=> $purchase_plan_price,
                        'url'=> route('pricing')
                    ),'');*/
                    return json_encode($return_json);
                    //return $response_json;

            }else{

                $user = User::where('uuid',$request->uuid)->first();
                $message = "No purchase plan data available and no token data available";
                if($user){
                    $walletInfo = 0;
                    if($user->walletData){
                        $walletInfo=$user->walletData->balance;
                    }
                    $subscribed=$user->subscribedPlan;
                    $currentPlan='';
                    if($subscribed){
                        $currentPlan=Plan::where('plan_id',$subscribed->stripe_plan)->first()->name;
                    }

                    $return_json = array(
                        'success' => true,
                        'walletInfo'=> $walletInfo,
                        'currentPlan'=> $currentPlan,
                        'plan_id'=> '',
                        'plan_name'=> '',
                        'amount'=> '',
                        'url'=> route('home'),
                        'token_id'=>'',
                        'token_name'=>'',
                        'token_amount'=>'',
                        'message' => $message
                    );
                }else{
                    $return_json = array(
                        'success' => true,
                        'plan_id'=>'',
                        'plan_name'=> '',
                        'amount'=>'',
                        'url'=> route('home'),
                        'token_id'=>'',
                        'token_name'=>'',
                        'token_amount'=>'',
                        'message' => $message
                    );
                }
                return json_encode($return_json);
                //$response_json = $this->sendSuccessResponse(array(),'No data available ');
                //return $response_json;
            }


        }else{
            return $this->sendErrorResponse('UUID not found.');
        }

    }
    public function updateUser(Request $request){

        if($request->has('uuid') && $request->get('uuid')!=null)
        {
            $user=User::where('uuid',$request->uuid)->first();
            if($user){
                $password=Hash::make(request('password'));
                $user=User::where('uuid',$request->uuid)->update([
                'password' =>  $password,
                ]);
                $response_json = $this->sendSuccessResponse(array(),' User updated successfully.');
                return $response_json;
            }
            else{
                $response_json = $this->sendSuccessResponse(array(),'somthing is wrong');
                return $response_json;
            }

        }
    }
    public function newPayPlan(Request $request){
        if($request->has('uuid') && $request->get('uuid')!=null)
        {
            $user=User::where('uuid',$request->uuid)->first();
            if($user){
                $walletBalance=$user->walletData->balance;
                $Plans=Plan::all();
                $Tokens=Tokens::all();
                $prepurche=Prepurches::where('uuid',$request->uuid)->first();
                $final_plan=array();
                foreach($Plans as $Plans){
                    $final_plan[] =
                    array(
                    'plan_id' => $Plans['plan_id'],
                    'price' => $Plans['price'],
                    'tokens' => $Plans['tokens']
               );
                }
                $response_json = $this->sendSuccessResponse(array('walletBalance'=>$walletBalance,'Plans'=>$final_plan,'prepurche'=>$prepurche),'');
                return $response_json;

            }
        }
    }
    public function toPayInfo(Request $request){
        if($request->has('uuid') && $request->get('uuid')!=null)
        {
            $user=User::where('uuid',$request->uuid)->first();
            if($user){
                $listOfPayment=$user->walletData->wallettransaction;
                foreach($listOfPayment as $item){
                        $tranctions[]=$item->name;
                }
                $subscribe = $user->subscribedPlan;
                $subscribeAmout=Plan::where('plan_id',$subscribe->stripe_plan)->first(['price']);
                // return $subscribeAmout;
                $response_json = $this->sendSuccessResponse(array('listOfPayment'=>$listOfPayment,'subscribe'=>$subscribe,'subscribeAmout'=>$subscribeAmout),'');
                return $response_json;
            }
        }
    }
    public function __destruct() {
        // clearing the object reference
        parent::__destruct();
    }

}
