<?php

namespace App\Http\Controllers;

use App\Events\UserAllNotification;
use Auth;
use App\User;
use App\Plan;
use App\FeatureSetting;
use App\TokenDebit;
use App\Donation;
use Depsimon\Wallet\Wallet;
use Depsimon\Wallet\Transaction;
use Illuminate\Http\Request;
use DB;

class PaymentController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
		/*\Stripe\Stripe::setApiKey(env("STRIPE_SECRET"));*/
	}

    public function index()
    {
        $transactions = array();
        $wallet = Wallet::where('user_id', Auth::user()->id )->first();
        if( $wallet ){
            $transactions = Transaction::where('wallet_id', $wallet->id)->orderBy('id', 'ASC')->get();
        }
        $title_by_page = "My Wallet";
        return view('payment.index', compact('transactions', 'wallet','title_by_page') );
    }


    public function create()
    {
         return view('payment.credit');
    }

    public function charge(Request $request)
    {
        $token = $amount = $request->input('amount');
        $tokenamount = getWebsiteSettingsByKey('token_amount');
    		if( $tokenamount ){
    		   $amount =  $tokenamount  * $amount;
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

        $description = 'Deposit of $'. $amount .' credits from this Payment';
        $charge = \Stripe\Charge::create([
            'amount' => $amount * 100,
            'currency' => 'usd',
            'description' => $description,
            'balance' => $balance,
            'source' => $request->input('stripeToken'),
        ]);
        if( $charge->status == 'succeeded' ){
            $user = Auth::user();
            $user->deposit($token, 'deposit', $charge );
        }
        return redirect()->to('wallet')->with('success', 'Payment added successfully');
    }

    public function checkoutCredit(Request $request)
    {
      $checkout_type = $request->input('checkout_type');

      $creditamount = 0;
      if($checkout_type == 1){
        $creditamount = $request->input('amount');
      }

      $donation = array();
      if($checkout_type == 2){
        $donation = new Donation;
        $donation->amount = $request->input('amount');
        $donation->show_supporter = $request->input('show_supporter');
        $donation->show_amount = $request->input('show_amount');
      }

      $user = User::find(Auth::user()->id);
      $userid = $user->id;

      $walletsdata = DB::table('wallets')->where('user_id',$userid)->first();
      $wallet_amount = 0;
      if($walletsdata != ''){
        $wallet_amount = $walletsdata->balance;
      }

      $plandata = array();
      $featuredata = array();
      $token = array();
      $advertisement=array();
      $newplanbuy = 0;
      return view('user.checkout', compact('creditamount', 'newplanbuy', 'donation', 'user', 'plandata', 'featuredata', 'wallet_amount', 'token','advertisement'));
    }

    public function paywithwalletDonation(Request $request)
    {
      
      $amount = $request->input('amount');
      $user = User::find(Auth::user()->id);
      $userid = $user->id;

      $walletsdata = DB::table('wallets')->where('user_id',$userid)->first();
      $wallet_amount = 0;
      if($amount > $walletsdata->balance){
        return redirect()->to('/parcel');
              
      }else{
        if($walletsdata != ''){
          $wallet_amount = $walletsdata->balance;
          if(is_numeric($wallet_amount) && is_numeric($amount)){
            $balance = ($wallet_amount - $amount);
          }else{
            $balance ='NA';
          }
      }

      $description = array( "description" => 'You have donated amount : ' .$amount, "balance" => $balance);
      
      if ($amount)
      {
        $donationdata = Donation::where('user_id', $userid)->first();
        if(!$donationdata)
        {
          $donation = new Donation;
          $donation->user_id = $userid;
          $donation->amount = $request->input('amount');
          $donation->is_supporter = $request->input('show_supporter');
          $donation->show_amount = $request->input('show_amount');
          $donation->save();
        }else{
          $newamount = $donationdata->amount + $amount;
          Donation::where('user_id', $userid)->update(['amount' => $newamount, 'is_supporter' =>$request->input('show_supporter'), 'show_amount' =>$request->input('show_amount')]);
        }
         $user->withdraw($amount, 'withdraw', $description);
        //NOTIFICATIONS START
          $wallet = DB::table('wallets')->where('user_id',$user->id)->first();
          $wallet_amount = $wallet->balance;

          $admin = User::where('role_id', '=', 1)->first();
          $admin_id = $admin->id;

          /*$message = $user->displayname." your deposit testcheck of ".$amount." Tokens was successful from wallet. Your wallet balance is: ".$wallet_amount." Tokens.";*/
          $encodeid = base64_encode($user->id);
          $url = url('/userprofile/'.$encodeid);
          $userprofilelink = '<a href="'.$url.'">'.$user->displayname.'</a>';
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
    }

    public function checkoutSucess()
    {
      return redirect()->to('wallet')->with('success', 'Payment added successfully');
    }

    public function checkoutFailed()
    {
      return redirect()->to('wallet')->with('danger', 'Failed to add Payment');
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function creditTokens()
    {
        $users = User::all();
        return view('admin.user.credittoken', compact('users'));
    }

    public function getCreditTokens(Request $request)
    {
        $this->validate($request, [
           'users' => 'required',
           'credittoken' => 'required',
           'message' => 'required',
         ]);

         $allusers = $request->input('users');
         $token = $request->input('credittoken');
         $message = $request->input('message');
         if($allusers){
             foreach($allusers as $getuser){
                 $user = User::find($getuser);
                 $userid = $user->id;

                 $walletsdata = DB::table('wallets')->where('user_id',$userid)->first();
                 $wallet_amount = 0;
                 if($walletsdata != ''){
                     $wallet_amount = $walletsdata->balance;
                     if(is_numeric($wallet_amount) && is_numeric($token)){
                       $balance = ($wallet_amount + $token);
                     }else {
                       $balance = 'NA';
                     }
                 }

                 $user->deposit($token, 'deposit', ['description' => $message, 'balance'=>$balance]);
             }
         }
        return redirect()->back()->with('message', 'Tokens credit Successfully');
    }

    public function debitTokens( Request $request ){
        $featureslist = array('token_private_messages_' => 'Private Messages',
                              'token_monthly_connection_' => 'Live Chat',
                              'token_username_change_' => 'UserName Change',
                              'token_view_my_likes_' => 'View My Likes',
                              'token_view_my_matches_' => 'View My Matches',
                              'token_my_hearts_' => 'My Hearts',
                              'token_advance_search_' => 'Advance Search',
                              'token_trial_token_' => 'Max Trial',
                              'token_user_image_change_' => 'Profile Picture change',
                              'token_free_profile_visit_' => 'Free profile visits',
                              'token_max_images_upload_' => 'Max Album Images',
        );
        $groupId = Auth::user()->group;
        $feturename = $request->input('feturename');
        $feturevalue = $request->input('featurevalue');
        $debitToken = getWebsiteSettingsByKey( $feturename.$groupId );
        $gotnewconnections = getWebsiteSettingsByKey( $feturevalue.$groupId );
        $user = User::find(Auth::user()->id);
        $userid = $user->id;
        $message = "You have paid $debitToken successfully to access " . $featureslist[$feturename] . " feature. You got $gotnewconnections connections." ;
        if( $user->balance < $debitToken ){
            return redirect()->to('wallet')->with('danger', 'Insufficent token amount. Add more tokens');
        }

        $walletsdata = DB::table('wallets')->where('user_id',$userid)->first();
        $wallet_amount = 0;
        if($walletsdata != ''){
            $wallet_amount = $walletsdata->balance;
            if(is_numeric($wallet_amount) && is_numeric($debitToken)){
              $balance = ($wallet_amount - $debitToken);
            }else{
              $balance ='NA';
            }
        }

        $user->withdraw($debitToken, 'withdraw', ['description' => $message, 'balance' => $balance]);
        $tokendebit = new TokenDebit;
        $tokendebit->group_id = Auth::user()->group;
        $tokendebit->token = $debitToken;
        $tokendebit->user_id = Auth::user()->id;
        $tokendebit->featured_id = $feturename.$groupId;
        $tokendebit->connection = $gotnewconnections;
        $tokendebit->save();
        return redirect()->back()->with('success', $message);
    }

}
