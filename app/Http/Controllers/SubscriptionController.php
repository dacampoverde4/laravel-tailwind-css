<?php

namespace App\Http\Controllers;

use App\Events\UserAllNotification;
use App\Features;
use Auth;
use App\User;
use App\Plan;
use App\Usergroup;
use App\WebsiteSetting;
use App\FeatureSetting;
use App\Subscription;
use Illuminate\Http\Request;
use DB;
use App\Models\Coupon;
use Carbon\Carbon;
use File;
use Illuminate\Support\Str;

class SubscriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        /*\Stripe\Stripe::setApiKey(env("STRIPE_SECRET"));*/
    }

    public function index()
    {
        $plans = Plan::orderBy('price', 'asc')->get();
        return view('membershipPlans.index', compact('plans'));
    }

    public function create()
    {
        return view('membershipPlans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'tokens' => 'required|numeric',
            'billing_interval' => 'required',
        ]);
        $paymentarray = array(
            "nickname" => $request->input('name'),
            "amount" => $request->input('price') * 100,
            "tokens" => $request->input('tokens'),
            "interval" => $request->input('billing_interval'),
            "plan_color" => $request->input('plan_color'),
            "best_seller_ribbon" => $request->input('best_seller_ribbon'),
            "plan_sale" => $request->input('plan_sale'),
            "product" => array(
                "name" => $request->input('name')
            ),
            "currency" => "usd",
            "trial_period_days" => $request->input('trial_period_days'),
        );
        $tokenamount = getWebsiteSettingsByKey('token_amount');

        if ($tokenamount) {
            $paymentarray["amount"] = ($request->input('price') * $tokenamount) * 100;
        }


        if ($request->input('billing_interval') == 'quarter') {
            $paymentarray["interval"] = 'month';
            $paymentarray["interval_count"] = 3;
        }

        if ($request->input('billing_interval') == 'semiannual') {
            $paymentarray["interval"] = 'month';
            $paymentarray["interval_count"] = 6;
        }

        /* $best_seller_ribbon = '';
        if ($request->has('best_seller_ribbon')) {
            $image = $request->file('best_seller_ribbon');
            $db_image_name = 'assets/images/plan/';
            $imagename = Str::random(10).'_'.time().'_.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/plan/');
            $image->move($destinationPath, $imagename);
            $paymentarray["best_seller_ribbon"] = $db_image_name.$imagename;
        }*/

        try {
            $response = \Stripe\Plan::create($paymentarray);
            $plan = new Plan;
            $plan->plan_id = $response->id;
            $plan->name = $request->name;
            $plan->description = $request->description;
            $plan->price = $request->price;
            $plan->billing_interval = $request->billing_interval;
            $plan->trial_period = $request->trial_period_days;
            $plan->plan_color = $request->plan_color;
            $plan->best_seller_ribbon = $request->best_seller_ribbon;
            $plan->plan_sale = $request->plan_sale;
            $plan->save();
            $id = $plan->id;
            self::saveWebsiteSetting($request, $id);
        } catch (Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage());
        }
        return redirect()->to('admin/subscriptionplans')->with('success', 'Plan created successfully');
    }

    public function saveWebsiteSetting($request, $id)
    {
        $websiteSettings = $request->input('websiteSettings');
        if (count($websiteSettings)) {
            foreach ($websiteSettings as $fieldId => $fieldVal) {
                self::addMetaValue($fieldId, $fieldVal, $id);
            }
        }
    }

    public function addMetaValue($metaKey, $metaValue, $metaID)
    {
        $data = WebsiteSetting::where('meta_key', $metaKey . '_' . $metaID)->first();
        if ($data) {
            $data->meta_value = $metaValue;
        } else {
            $data = new WebsiteSetting;
            $data->meta_id = $metaID;
            $data->meta_key = $metaKey . '_' . $metaID;
            $data->meta_value = $metaValue;
        }
        $data->save();
    }

    public function destroy($id)
    {
        if (!$id) {
            return redirect()->back()->with('failed', 'Invalid Request');
        }
        try {
            $data = Plan::find($id);
            $data->delete();
            $plan = \Stripe\Plan::retrieve($data->plan_id);
            $plan->delete();
            WebsiteSetting::where('meta_id', $id)->delete();
        } catch (Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage());
        }
        return redirect()->to('admin/subscriptionplans')->with('success', 'Plan deleted successfully');
    }

    public static function getPlanlist()
    {
        if (Auth::user()) {
            if (Auth::user()->group) {
                $user = User::find(Auth::user()->id);
                $membership_plans = isset($user->usergroup->membership_plans) ? $user->usergroup->membership_plans : '';
                if ($membership_plans) {
                    // $inactivePlans  = Plan::where('status','0')->pluck('id')->toArray();
                    // $inactiveId = array($inactivePlans->id);
                   //print_r($inactiveId); exit;
                    $membership_planIds = json_decode($membership_plans, true);
                    // $getActivePlans = array_diff($membership_planIds,$inactiveId);
                      return Plan::whereIn('id', $membership_planIds)->orderBy('price', 'asc')->get();
                   
                }
            }
            return redirect()->back()->with('danger', "You haven't set any user group. Complete your profile");
        }
        return redirect()->to('/login');
    }

    public function getpricing()
    {
        $plans = self::getPlanlist();
        $user = User::find(Auth::user()->id);
        $features = Features::all();
        $starters = WebsiteSetting::where('meta_id', 10)->get();
        $professionals = WebsiteSetting::where('meta_id', 9)->get();
        $enterprices = WebsiteSetting::where('meta_id', 8)->get();
        $subscription = Subscription::where('user_id', Auth::user()->id)->where('name', 'main')->where('quantity', '1')->first();
        $currentplandata = Plan::where('plan_id', $subscription->stripe_plan)->first();
        
        $nextsubscriptionexist = Subscription::where('user_id', Auth::user()->id)->where('name', 'main')->where('quantity', '0')->first();
        if(!empty($nextsubscriptionexist)){
          $nextplandata = Plan::where('plan_id', $nextsubscriptionexist->stripe_plan)->first();
        }

        $upbtn = $downbtn = $cancelbtn = '';
        if(!empty($nextsubscriptionexist->stripe_plan)){
          $cancelbtn = 1;
        }

        if(!empty($nextplandata)){
          if($currentplandata->price > $nextplandata->price ){
            $downbtn = 1;
          }

          if($currentplandata->price < $nextplandata->price){
            $upbtn = 1;
          }
        }


        $now = Carbon::now();
        $nextsubscription = '';
        $messageprc = '';

        if($now > $subscription->ends_at){
          $nextsubscription = Subscription::where('user_id', Auth::user()->id)->where('name', 'main')->where('quantity', '0')->first();
          if(isset($nextsubscription) && !empty($nextsubscription)){

            $oldsubscriptiondata = Subscription::find($subscription->id);
            $oldsubscriptiondata->delete();

            Subscription::where('user_id', Auth::user()->id)->where('name', 'main')->where('quantity', '0')->update(['quantity' => '1', 'ends_at' => $now]);

            $subscription = Subscription::where('user_id', Auth::user()->id)->where('name', 'main')->where('quantity', '1')->first();

            $newplandata = Plan::where('plan_id', $subscription->stripe_plan)->first();

            //NOTIFICATIONS START
            $admin = User::where('role_id', '=', 1)->first();
            $admin_id = $admin->id;

            $message = "Congratulation ".$user->displayname."! Your's new plan ".$newplandata->name." is successfully activated and you needs to pay due amount for plan ".$newplandata->name.".";
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

            Event::fire(new UserAllNotification($allnoticationdata));
            //NOTIFICATIONS END
          }
        }
        $title_by_page = "Subscription";
        if (Auth::user()->role_id == 1) {
            return view('user.pricing', compact('plans', 'subscription', 'features', 'starters', 'professionals', 'enterprices', 'title_by_page', 'messageprc', 'cancelbtn', 'upbtn', 'downbtn'));
        } else {
            return view('user.price', compact('plans', 'subscription', 'features', 'starters', 'professionals', 'enterprices', 'title_by_page', 'messageprc', 'cancelbtn', 'upbtn', 'downbtn'));
        }
    }

    public function upgrade(Request $request)
    {
        $chargeId = $request->input('chargeId');

        if ($chargeId) {
            $user = User::find(Auth::user()->id);
            if ($user->subscription('main')->onGracePeriod()) {
                $user->subscription('main')->resume();
            }
            if ($user->subscribed('main')) {
                //$user->subscription('main')->swap($chargeId);
                Subscription::where('user_id', Auth::user()->id)->where('name', 'main')
                    ->update(['stripe_plan' => $chargeId]);
            }
        }
        if ($user->subscribed('main')) {
            return redirect()->to('subscription/success');
        }
        return redirect()->to('subscription/failed');
    }

    public function checkout(Request $request)
    {
        $chargeId = $request->input('chargeId');
        $plandata = Plan::where('plan_id', $chargeId)->first();
        $lastsubscription = Subscription::where('user_id', Auth::user()->id)->where('name', 'main')->first();
        $adj_amt = '';
        if(isset($lastsubscription) && !empty($lastsubscription)) {

          $lastplandata = Plan::where('plan_id', $lastsubscription->stripe_plan)->first();
          $lastplan_price = $lastplandata->price;
          $lastplan_billing_interval = $lastplandata->billing_interval;
          $lastsubscription_ends_at = $lastsubscription->ends_at;
          $lastsubscription_updated_at = $lastsubscription->updated_at;

            if($lastsubscription->ends_at){
             $lastsubscription_ends_at = Carbon::createFromFormat('Y-m-d H:s:i', $lastsubscription->ends_at);
            }else{
             $lastsubscription_ends_at = Carbon::now();
            }

           $to = Carbon::now();
           if($lastsubscription_ends_at >= $to){
              $diff_in_days = $lastsubscription_ends_at->diffInDays($to);
           }


            switch ($lastplandata->billing_interval) {
                case 'day':
                    $plan_days = 1;
                    break;
                case 'week':
                    $plan_days = 7;
                    break;
                case 'month':
                    $plan_days = 30;
                    break;
                case 'quarter':
                    $plan_days = 92;
                    break;
                case 'semiannual':
                    $plan_days = 183;
                    break;
                case 'year':
                    $plan_days = 365;
                    break;
                default:
                    $plan_days = '';
                    break;
            }

            if(isset($plan_days) && !empty($plan_days)){
              $lastplan_price_per_day = $lastplan_price / $plan_days;
            }

            if( (isset($diff_in_days) && !empty($diff_in_days)) && (isset($lastplan_price_per_day) && !empty($lastplan_price_per_day)) ){
              $adj_amt = $diff_in_days * $lastplan_price_per_day;
            }else{
              $adj_amt = 0;
            }

      }

        $newplanbuy = 0;
        $newplanbuy = $request->input('newplanbuy');//user first time buy a plan

        $user = User::find(Auth::user()->id);
        $userid = $user->id;

        $walletsdata = DB::table('wallets')->where('user_id',$userid)->first();
        $wallet_amount = 0;
        if($walletsdata != ''){
            $wallet_amount = $walletsdata->balance;
        }

        
        if($adj_amt){
            if($plandata){
                $plandata_price = round($plandata->price - $adj_amt,2);
            }
            $plandata_price = '';
        }else{
            $plandata_price ='';
        }

        $featuredata = FeatureSetting::where('plan_id', $chargeId)->first();

        $token = array();
        $donation = array();
        $creditamount = 0;
        $advertisement = array();
        return view('user.checkout', compact('user', 'plandata', 'newplanbuy', 'featuredata', 'wallet_amount', 'token', 'creditamount', 'donation', 'advertisement', 'plandata_price'));
    }

    public function downgrade(Request $request)
    {

        $downgradeplan = $request->input('downgradeplan');

        $lastsubscription = Subscription::where('user_id', Auth::user()->id)->where('name', 'main')->first();


        if(isset($lastsubscription) && !empty($lastsubscription)) {

          $lastplandata = Plan::where('plan_id', $lastsubscription->stripe_plan)->first();
          $lastplan_price = $lastplandata->price;
          $lastplan_billing_interval = $lastplandata->billing_interval;
          $lastsubscription_ends_at = $lastsubscription->ends_at;
          $lastsubscription_updated_at = $lastsubscription->updated_at;

            if($lastsubscription->ends_at){
             $lastsubscription_ends_at = Carbon::createFromFormat('Y-m-d H:s:i', $lastsubscription->ends_at);
            }else{
             $lastsubscription_ends_at = Carbon::now();
            }

           $to = Carbon::now();
           //echo $lastsubscription_ends_at;die;
           if($lastsubscription_ends_at >= $to){
              $diff_in_days = $lastsubscription_ends_at->diffInDays($to);

           }else{
              $diff_in_days ='';
           }

            switch ($lastplandata->billing_interval) {
                case 'day':
                    $plan_days = 1;
                    break;
                case 'week':
                    $plan_days = 7;
                    break;
                case 'month':
                    $plan_days = 30;
                    break;
                case 'quarter':
                    $plan_days = 92;
                    break;
                case 'semiannual':
                    $plan_days = 183;
                    break;
                case 'year':
                    $plan_days = 365;
                    break;
                default:
                    $plan_days = '';
                    break;
            }

            if(isset($plan_days) && !empty($plan_days)){
              $lastplan_price_per_day = $lastplan_price / $plan_days;
            }

            if( (isset($diff_in_days) && !empty($diff_in_days)) && (isset($lastplan_price_per_day) && !empty($lastplan_price_per_day)) ){
              $adj_amt = $diff_in_days * $lastplan_price_per_day;
            }else{
              $adj_amt = 0;
            }

      }

        $chargeId = $request->input('chargeId');
        $newplanbuy = 0;
        $newplanbuy = $request->input('newplanbuy');//user first time buy a plan

        $user = User::find(Auth::user()->id);
        $userid = $user->id;

        $walletsdata = DB::table('wallets')->where('user_id',$userid)->first();
        $wallet_amount = 0;
        if($walletsdata != ''){
            $wallet_amount = $walletsdata->balance;
        }

        $plandata = Plan::where('plan_id', $chargeId)->first();

        if($adj_amt){
        $plandata_price = $plandata->price - $adj_amt;
      }else{
        $plandata_price = '';
      }

        $featuredata = FeatureSetting::where('plan_id', $chargeId)->first();

        $token = array();
        $donation = array();
        $creditamount = 0;
        $advertisement = array();
        return view('user.downgrade', compact('user', 'diff_in_days', 'lastplandata', 'plandata', 'newplanbuy', 'featuredata', 'wallet_amount', 'token', 'creditamount', 'donation', 'advertisement', 'plandata_price','downgradeplan'));
    }

    public function downgradeConfirm(Request $request)
    {
        $chargeId = $request->input('plan_id');
        $amount = $request->input('amount');
        $plan_on_sale = $request->input('plan_on_sale');
        $diff_in_days = $request->input('diff_in_days');
        if($request->appliedcouponcode_flag){
            $coupon_obj = Coupon::whereRaw('BINARY `coupon_code` = ?', $request->appliedcouponcode)->first();
            if($coupon_obj->discountType->slug == 'token_off' || $coupon_obj->discountType->slug == 'both'){
                $wallet_obj = Auth::user()->walletData;
                $wallet_obj->balance = $wallet_obj->balance + $coupon_obj->token_amt;
                $wallet_obj->save();
            }
            if($coupon_obj->discountType->slug == 'discount_percentage' || $coupon_obj->discountType->slug == 'both'){
                $amount = number_format($amount - (($amount * $coupon_obj->discount) / 100), 2);
            }
            $coupon_obj->count = $coupon_obj->count - 1;
            $coupon_obj->save();
        }
        $planname = $request->input('planname');
        $lastplanname = $request->input('lastplanname');
        $newplanbuy = $request->input('newplanbuy'); //user first time buy a plan

        $user = User::find(Auth::user()->id);
        $userid = $user->id;

        if(isset($plan_on_sale) && !empty($plan_on_sale)){
          $description = array( "description" => 'You have Purchased plan : ' .$planname. 'of amount '.$amount);
        }else{
          $description = array( "description" => 'You have Purchased plan : ' .$planname. ' of amount '.$amount);
        }

        $now = Carbon::now();
        $updated_at = $now->addDays($diff_in_days);

        $nextsubscription = Subscription::where('user_id', Auth::user()->id)->where('name', 'main')->where('quantity', '0')->first();
        if(isset($nextsubscription) && !empty($nextsubscription)){
          $nextsubscriptiondata = Subscription::find($nextsubscription->id);
          $nextsubscriptiondata->delete();
        }

        if ($chargeId) {
            $user = User::find(Auth::user()->id);
            //$expiry_date = getDowngradeExpiryDate($chargeId, $diff_in_days);
            $newsubscription = new Subscription;
            $newsubscription->user_id = Auth::user()->id;
            $newsubscription->name ='main';
            $newsubscription->stripe_plan = $chargeId;
            $newsubscription->save();

            //NOTIFICATIONS START
            $admin = User::where('role_id', '=', 1)->first();
            $admin_id = $admin->id;

            $message = "".$user->displayname."! currently you have ".$diff_in_days." day(s) remaining on plan ".$lastplanname.". However after your plan ".$lastplanname." is expired you will be automatically downgraded to plan ".$planname.".";

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
                'type' => 'plan_downgrade',
                'created_by' => $admin_id
            );

            $sldata = array(
                'uuid' => $user->uuid,
                'message' => $message,
                'type' => 'Plan Downgrade'
            );

            $allnoticationdata = array(
                'emailtype' =>$emaildata,
                'messagetype' =>$messagedata,
                'notificationtype' =>$notficationdata,
                'sl_notificationtype' =>$sldata
            );

            \Event::fire(new UserAllNotification($allnoticationdata));
            //NOTIFICATIONS END
            return redirect()->to('subscription/success');
        }
        return redirect()->to('subscription/failed');
    }

    public function paywithwallet(Request $request)
    {
        $chargeId = $request->input('plan_id');
        $amount = $request->input('amount');
        $plan_on_sale = $request->input('plan_on_sale');
        if($request->appliedcouponcode_flag){
            $coupon_obj = Coupon::whereRaw('BINARY `coupon_code` = ?', $request->appliedcouponcode)->first();
            if($coupon_obj->discountType->slug == 'token_off' || $coupon_obj->discountType->slug == 'both'){
                $wallet_obj = Auth::user()->walletData;
                $wallet_obj->balance = $wallet_obj->balance + $coupon_obj->token_amt;
                $wallet_obj->save();
            }
            if($coupon_obj->discountType->slug == 'discount_percentage' || $coupon_obj->discountType->slug == 'both'){
                $amount = number_format($amount - (($amount * $coupon_obj->discount) / 100), 2);
            }
            $coupon_obj->count = $coupon_obj->count - 1;
            $coupon_obj->save();
        }
        $planname = $request->input('planname');
        $newplanbuy = $request->input('newplanbuy'); //user first time buy a plan

        $user = User::find(Auth::user()->id);
        $userid = $user->id;

        $walletsdata = DB::table('wallets')->where('user_id',$userid)->first();
        $wallet_amount = 0;
        if($walletsdata != ''){
            $wallet_amount = $walletsdata->balance;
              if(is_numeric($wallet_amount) && is_numeric($amount)){
                $balance = ($wallet_amount - $amount);
              }else{
                $balance = 'NA';
              }
        }

        if(isset($plan_on_sale) && !empty($plan_on_sale)){
          $description = array( "description" => 'You have Purchased plan : ' .$planname. ' of amount '.$amount, "balance" => $balance);
        }else{
          $description = array( "description" => 'You have Purchased plan : ' .$planname. ' of amount '.$amount, "balance" => $balance);
        }


        $nextsubscription = Subscription::where('user_id', Auth::user()->id)->where('name', 'main')->where('quantity', '0')->first();

        if(isset($nextsubscription) && !empty($nextsubscription)){
          $nextsubscriptiondata = Subscription::find($nextsubscription->id);
          $nextsubscriptiondata->delete();
        }

        if ($chargeId) {
            $user = User::find(Auth::user()->id);
            $expiry_date = getExpiryDate($chargeId);
            if($newplanbuy == 1){
                $subscription = new Subscription;
                $subscription->user_id = $user->id;
                $subscription->name = 'main';
                $subscription->stripe_plan = $chargeId;
                $subscription->quantity = '1';
                $subscription->ends_at = $expiry_date;
                $subscription->save();
            }else{
              if($user->subscribedPlan('main')) {
                    Subscription::where('user_id', Auth::user()->id)->where('name', 'main')
                        ->update(['stripe_plan' => $chargeId, 'ends_at' => $expiry_date]);
                }
            }


            $user->withdraw($amount, 'withdraw', $description);

            //NOTIFICATIONS START
            $admin = User::where('role_id', '=', 1)->first();
            $admin_id = $admin->id;

            if($newplanbuy == 1){
                $message = $user->displayname.", welcome to a world of possibilities with your ".$planname." premium plan from wallet.";
            }else{
                /* $message = "Congratulation ".$user->displayname."! You've successfully upgraded to ".$planname." premium plan from wallet. and your payment of ".$amount." Tokens was successfully received.";*/
                //$message = "Looking great ".$user->displayname."! We've received your payment of ".$amount." Tokens and your profile is now featured. Enjoy the perks of standing out from the crowd!";

                //$message = "Looking great ".$user->displayname."! We've received your payment of ".$amount." Tokens and your upgraded ".$planname." premium plan. Enjoy the perks of standing out from the crowd!";

                $message = "Welcome to premium membership ".$user->displayname.". We've received your payment of ".$amount." Tokens and your ".$planname." premium plan is now activated";
            }

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
                'type' => 'payment_deposite',
                'created_by' => $admin_id
            );

            $sldata = array(
                'uuid' => $user->uuid,
                'message' => $message,
                'type' => 'Payment Notification'
            );

            $allnoticationdata = array(
                'emailtype' =>$emaildata,
                'messagetype' =>$messagedata,
                'notificationtype' =>$notficationdata,
                'sl_notificationtype' =>$sldata
            );

            \Event::fire(new UserAllNotification($allnoticationdata));
            //NOTIFICATIONS END
            return redirect()->to('subscription/success');
        }
        return redirect()->to('subscription/failed');
    }

    public function paywithwalletfeature(Request $request)
    {
        $chargeId = $request->input('plan_id');
        $amount = $request->input('amount');
        $planname = $request->input('planname');

        $user = User::find(Auth::user()->id);
        $userid = $user->id;

        $walletsdata = DB::table('wallets')->where('user_id',$userid)->first();
        $wallet_amount = 0;
        if($walletsdata != ''){
            $wallet_amount = $walletsdata->balance;
            if(is_numeric($wallet_amount) && is_numeric($amount)){
              $balance = ($wallet_amount - $amount);
            }else {
              $balance = 'NA';
            }
        }

        $description = array( "description" => 'You have Purchased Featured plan : ' .$planname. ' for token '.$amount, "balance" => $balance);

        if ($chargeId) {

            $user = User::find(Auth::user()->id);

            if ($user->subscribed('feature')) {
                Subscription::where('user_id', Auth::user()->id)->where('name', 'feature')
                    ->update(['stripe_plan' => $chargeId]);
                $user->withdraw($amount, 'withdraw', $description);
            }else{
                $subscription = new Subscription;
                $subscription->user_id = $user->id;
                $subscription->name = 'feature';
                $subscription->stripe_plan = $chargeId;
                $subscription->quantity = '1';
                $subscription->save();
            }

            //NOTIFICATIONS START
            $wallet = DB::table('wallets')->where('user_id',$user->id)->first();
            $wallet_amount = $wallet->balance;

            $admin = User::where('role_id', '=', 1)->first();
            $admin_id = $admin->id;

            /* $message = "Looking great ".$user->displayname."! You've successfully upgraded to ".$planname." feature plan from wallet. and your payment of ".$amount." Tokens was successfully received.";*/
            //$message = "Looking great ".$user->displayname."! We've received your payment of ".$amount." Tokens and your upgraded ".$planname." premium plan. Enjoy the perks of standing out from the crowd!";
            //$message = "Looking great ".$user->displayname."! We've received your payment of ".$amount." Tokens and your profile is now featured. Enjoy advanced search, chat features, visibility, 24/7 support, and more.";

            $message = "Welcome to premium membership ".$user->displayname.". We've received your payment of ".$amount." Tokens and your ".$planname." premium plan is now activated";
            
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
                'type' => 'payment_deposite',
                'created_by' => $admin_id
            );

            $sldata = array(
                'uuid' => $user->uuid,
                'message' => $message,
                'type' => 'Payment Notification'
            );

            $allnoticationdata = array(
                'emailtype' =>$emaildata,
                'messagetype' =>$messagedata,
                'notificationtype' =>$notficationdata,
                'sl_notificationtype' =>$sldata
            );

            \Event::fire(new UserAllNotification($allnoticationdata));
            //NOTIFICATIONS END

            return redirect()->to('subscription/success');
        }else{
            return redirect()->to('subscription/failed');
        }
    }

    public function paywithinworld(Request $request)
    {
        return redirect()->to('parcel');
    }

    public function cancel(Request $request)
    {
        $chargeId = $request->input('chargeId');
        $plandata = Plan::where('plan_id', $chargeId)->first();
        $amount = $plandata->price;
        $planname = $plandata->name;
        $user = User::find(Auth::user()->id);
        $currentsubscription = Subscription::where('user_id', Auth::user()->id)->where('name', 'main')->where('quantity', '1')->first();

        if($currentsubscription->ends_at){
         $currentsubscription_ends_at = Carbon::createFromFormat('Y-m-d H:s:i', $currentsubscription->ends_at);
        }else{
         $currentsubscription_ends_at = Carbon::now();
        }

        if ($user->subscribed('main')) {

          $user = User::find(Auth::user()->id);
          $userid = $user->id;

          $now = Carbon::now();

          if($currentsubscription_ends_at >= $now){
             $diff_in_days = $currentsubscription_ends_at->diffInDays($now);
          }

          $updated_at = $now->addDays($diff_in_days);

          if ($chargeId) {
              $user = User::find(Auth::user()->id);
              $newsubscription = new Subscription;
              $newsubscription->user_id = Auth::user()->id;
              $newsubscription->name ='main';
              $newsubscription->stripe_plan = 'plan_DGPRyjNYWH0Y1h';
              $newsubscription->save();

              //NOTIFICATIONS START
              $admin = User::where('role_id', '=', 1)->first();
              $admin_id = $admin->id;

              $message = "".$user->displayname."! currently you have ".$diff_in_days." day(s) remaining on plan ".$planname.". However after your plan ".$planname." ends, you will be automatically downgraded to plan Free";

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
                  'type' => 'plan_downgrade',
                  'created_by' => $admin_id
              );

              $sldata = array(
                  'uuid' => $user->uuid,
                  'message' => $message,
                  'type' => 'Plan Downgrade'
              );

              $allnoticationdata = array(
                  'emailtype' =>$emaildata,
                  'messagetype' =>$messagedata,
                  'notificationtype' =>$notficationdata,
                  'sl_notificationtype' =>$sldata
              );

              \Event::fire(new UserAllNotification($allnoticationdata));
              //NOTIFICATIONS END

            return redirect()->to('subscription/success');
          }

        }

        return redirect()->to('subscription/failed');
    }


    public function charge(Request $request)
    {
        $name = $request->input('chargeId');
        $stripeToken = $request->input('stripeToken');
        $user = User::find(Auth::user()->id);
        if (!$user->subscribed('main')) {
            $reponse = $user->newSubscription('main', $name)->create($stripeToken);
            if ($reponse->stripe_id) {
                return redirect()->to('subscription/success')->with('stripeToken', $stripeToken);
            }
        }
        return redirect()->to('subscription/failed')->with('stripeToken', $stripeToken);
    }

    public function success()
    {
        return view('user.success');
    }

    public function failed()
    {
        return view('user.failed');
    }

    public function edit($id)
    {
        $websiteSetting = self::setMetas($id);
        $subscription = Plan::find($id);

        $tokenamount = getWebsiteSettingsByKey('token_amount');

        if ($tokenamount) {
            $subscription->token = ($subscription->price * $tokenamount) * 100;
        }

        return view('membershipPlans.edit', compact('websiteSetting', 'id', 'subscription'));
    }

    public function setMetas($id)
    {
        $metaDatas = WebsiteSetting::where('meta_id', $id)->get();
        $newmetaInfo = array();
        if ($metaDatas) {
            foreach ($metaDatas as $metaData) {
                $newmetaInfo[$metaData->meta_key] = $metaData->meta_value;
            }
        }
        return $newmetaInfo;
    }

    public function update(Request $request, $id)
    {
        dd($request);
    }

    public function feturecharge(Request $request)
    {
        $name = $request->input('chargeId');
        $stripeToken = $request->input('stripeToken');
        $user = User::find(Auth::user()->id);
        if (!$user->subscribed('feature')) {
            $reponse = $user->newSubscription('feature', $name)->create($stripeToken);
            if ($reponse->stripe_id) {
                return redirect()->to('subscription/success')->with('stripeToken', $stripeToken);
            }
        }
        return redirect()->to('subscription/failed')->with('stripeToken', $stripeToken);
    }

    public function featureupgrade(Request $request)
    {
        $chargeId = $request->input('chargeId');
        if ($chargeId) {
            $user = User::find(Auth::user()->id);
            if ($user->subscription('feature')->onGracePeriod()) {
                $user->subscription('feature')->resume();
            }
            if ($user->subscribed('feature')) {
                $user->subscription('feature')->swap($chargeId);
            }
        }
        if ($user->subscribed('feature')) {
            return redirect()->to('subscription/success');
        }
        return redirect()->to('subscription/failed');
    }

    public function featurecancel(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->subscription('feature')->cancel();
        if ($user->subscribed('feature')) {
            return redirect()->to('subscription/success');
        }
        return redirect()->to('subscription/failed');
    }
    public function applyCoupon(Request $request){
        $plan_obj = Plan::where('plan_id', $request->plan_id)->first();
        $return_json['status'] = false;
        $return_json['message'] = 'Dodfgsdfgsdfgsdfgsdfgsdfgsdfgne';
        $coupon = Coupon::whereRaw('BINARY `coupon_code` = ?', $request->couponcode)->first();
        if(!$coupon){
            $return_json['status'] = false;
            $return_json['message'] = 'Coupon code is incorrect';
            return json_encode($return_json);
        }else{
            if(!$coupon->count){
                $return_json['status'] = false;
                $return_json['message'] = 'Coupon code is used';
                return json_encode($return_json);
            }
            if($coupon->expiry_date < Carbon::now()){
                $return_json['status'] = false;
                $return_json['message'] = 'Coupon code is expired';
                return json_encode($return_json);
            }
            $final_item_price = number_format($plan_obj->price - (($plan_obj->price * $coupon->discount) / 100), 2);
            $return_json['status'] = true;
            $return_json['message'] = 'Coupon code applied successfully ! <br> You have recieved '.$coupon->token_amt.' tokens and '.$coupon->discount.'% discount. <br> Your Item value will be <b>$'.$final_item_price.'</b>';
            $return_json['tokens'] = $coupon->token_amt;
            $return_json['discount'] = $coupon->discount;
            return json_encode($return_json);
        }
    }



     public function updateStatus(Request $request){
        $status = Plan::find($request->id);
        $status->status = $request->status;
        $status->save();
        return response()->json(['success'=>'status updated successfully']);
    }
    
}
