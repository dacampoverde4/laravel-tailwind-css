<?php

namespace App\Http\Controllers;

use App\Events\UserAllNotification;
use Auth;
use App\Tokens;
use App\User;
use Illuminate\Http\Request;
use DB;

class TokensController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tokens = Tokens::all();
        return view('admin.tokens.index', compact('tokens'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tokens.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'amount' => 'required',
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);

        $token = new Tokens;
        $getIcon = time().'.'.$request->file('icon')->getClientOriginalExtension();
        $request->file('icon')->move(public_path('uploads/tokenicon'), $getIcon);
        $token->title = $request->title;
        $token->icon = $getIcon;
        $token->description = $request->description;
        $token->discount = $request->discount;
        $token->amount = $request->amount;
        $token->additional_text = $request->additional_text;
        $token->save();
        return redirect ('admin/tokens')->with('message','Token Created');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tokens  $tokens
     * @return \Illuminate\Http\Response
     */
    public function show(Tokens $tokens)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tokens  $tokens
     * @return \Illuminate\Http\Response
     */
    public function edit(Tokens $tokens, $id)
    {
        $token = Tokens::find($id);
        return view('admin.tokens.edit', compact('token'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tokens  $tokens
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tokens $tokens, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'amount' => 'required',
        ]);

        $token = Tokens::find($id);
        if($request->icon){
            $getIcon = time().'.'.$request->file('icon')->getClientOriginalExtension();
            $request->file('icon')->move(public_path('uploads/tokenicon'), $getIcon);
            $token->icon = $getIcon;
        }
        $token->title = $request->title;
        $token->discount = $request->discount;
        $token->description = $request->description;
        $token->amount = $request->amount;
        $token->additional_text = $request->additional_text;
        $token->save();
        return redirect()->back()->with('message','Token Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tokens  $tokens
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tokens $tokens, $id)
    {
        $token = Tokens::find($id);
        $token->delete();
        return redirect()->back()->with('message','Token Deleted');
    }

    public function buyTokens(){
        $tokens = Tokens::orderBy('amount','asc')->get();
		return view('user.buytoken', compact('tokens'));
	}

	public function purchaseTokens( Request $request ){
        $chargeId = $request->input('chargeId');

	    if( !$chargeId ){
	        return redirect()->to('subscription/failed')->with('failed', 'Invalid access');
	    }
	    /*\Stripe\Stripe::setApiKey(env("STRIPE_SECRET"));*/
	    $token = Tokens::find($chargeId);
	    $tokenamount = getWebsiteSettingsByKey('token_amount');
	    $discount = $newamount = 0;
        $amount = ( $tokenamount )? $token->amount * ( $tokenamount ): $token->amount;
        if( $token->discount ){
            $discount = ( $amount * $token->discount )/100;
            if( $discount ){
                $amount = $amount - $discount;
            }
        }
        $tokenpurchase = $token->amount;
        $payamount = $amount;

        $user = User::find(Auth::user()->id);
        $userid = $user->id;

        $walletsdata = DB::table('wallets')->where('user_id',$userid)->first();
        $wallet_amount = 0;
        if($walletsdata != ''){
            $wallet_amount = $walletsdata->balance;
            if(is_numeric($wallet_amount) && is_numeric($payamount)){
              $balance = ($wallet_amount - $payamount);
            }else {
              $balance = 'NA';
            }
        }

        $description = 'You have Purchased bundle of ' . $tokenpurchase . ', Amount: $'.$payamount;
        $charge = \Stripe\Charge::create([
            'amount' => round( $payamount, 2 ) * 100,
            'currency' => 'usd',
            'description' => $description,
            'balance' => $balance,
            'source' => $request->input('stripeToken'),
        ]);
        if( $charge->status == 'succeeded' ){
            $user = Auth::user();
            $user->deposit($tokenpurchase, 'deposit', $charge );
        }
        return redirect()->to('wallet')->with('success', 'Payment added successfully');
	}

    public function checkoutToken(Request $request)
    {
        $chargeId = $request->input('chargeId');
        $token = Tokens::find($chargeId);
        if( !$chargeId ){
            return redirect()->to('subscription/failed')->with('failed', 'Invalid access');
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
        $donation = array();
        $creditamount = 0;
        $newplanbuy = 0;
        $advertisement = array();

        return view('user.checkout', compact('user', 'newplanbuy', 'token', 'wallet_amount', 'plandata', 'featuredata', 'creditamount', 'donation', 'advertisement'));
    }

    public function payTokenwithwallet(Request $request)
    {
        $chargeId = $request->input('chargeId');
        $chargeamount = $request->input('amount');

        $token = Tokens::find($chargeId);
        $tokenamount = getWebsiteSettingsByKey('token_amount');
        $discount = $newamount = 0;
        $amount = ( $tokenamount )? $token->amount * ( $tokenamount ): $token->amount;
        $token->discount;
        if( $token->discount ){
            $discount = ( $amount * $token->discount )/100;
            if( $discount ){
                $amount = $amount - $discount;
            }
        }
        $tokenpurchase = $token->amount;
        $payamount = $amount;

        $user = User::find(Auth::user()->id);
        $userid = $user->id;

        $walletsdata = DB::table('wallets')->where('user_id',$userid)->first();
        $wallet_amount = 0;
        if($walletsdata != ''){
            $wallet_amount = $walletsdata->balance;
            if(is_numeric($wallet_amount) && is_numeric($payamount)){
              $balance = ($wallet_amount - $payamount);
            }else{
              $balance = 'NA';
            }
        }

        $description = array( "description" => 'You have Purchased bundle of ' . $tokenpurchase . ', Amount: $'.$payamount, "balance" => $balance);

        $user = User::find(Auth::user()->id);
        $userid = $user->id;

        if ($chargeId) {
            $user->withdraw($payamount, 'withdraw', $description);

            //NOTIFICATIONS START
                $wallet = DB::table('wallets')->where('user_id',$user->id)->first();
                $wallet_amount = $wallet->balance;

                $admin = User::where('role_id', '=', 1)->first();
                $admin_id = $admin->id;

                $message = $user->displayname." your deposit of ".$chargeamount." Tokens was successful from wallet. This Token get discount so your deposite amount is ".$payamount." Token. Your wallet balance is: ".$wallet_amount." Tokens.";

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
            return redirect()->to('subscription/failed')->with('failed', 'Invalid access');
        }
    }

    public function payTokenwithinworld(Request $request)
    {
        return redirect()->to('parcel');
    }

}
