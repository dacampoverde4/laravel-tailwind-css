<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Carbon\Carbon;
use Session;
use App\Banner;
use App\Usergroup;
use App\TargetAudience;
use App\UsersBanner;
use App\Advertisement;
use App\Models\Coupon;
use App\AdsSubscriptions;
use Redirect;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use App\Helpers\ImageHelper;
use App\Events\UserAllNotification;

class UserAdsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $advertisement = AdsSubscriptions::where('user_id', Auth::user()->id)->get();
        if(count($advertisement))  {
        foreach($advertisement as $key=>$value)
        {
            $value->adevertisementlist = Advertisement::where('id', $value->ads_id)->first();
            $value->userbanners = UsersBanner::where('ads_id', $value->adevertisementlist['id'])->where('user_id', $user->id)->get()->toArray();

            $end_date = '';
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
            }
            $value->end_date = $end_date;

            if($value->adevertisementlist->banner_ids)
            {
                $b_ids = explode(',', $value->adevertisementlist->banner_ids);
                $value->banners = Banner::whereIn('id', $b_ids)->get()->toArray();
            }

            $alladvertisement = Advertisement::get();

        foreach($alladvertisement as $key=>$value)
        {
            if( $value->banner_ids ){
                $bannerids = explode(',', $value->banner_ids);
                $value->banners_list = Banner::whereIn('id', $bannerids)->get()->toArray();
            }
            if( $value->target_audience_ids ){
                $ids = explode(',', $value->target_audience_ids );
                $value->target_audiences = TargetAudience::whereIn('id', $ids)->get()->toArray();
            }
        }
        return view( 'user.manageads', compact('advertisement','alladvertisement') );
        }
    }else{
        $advertisement = Advertisement::get();

        foreach($advertisement as $key=>$value)
        {
            if( $value->banner_ids ){
                $bannerids = explode(',', $value->banner_ids);
                $value->banners_list = Banner::whereIn('id', $bannerids)->get()->toArray();
            }
            if( $value->target_audience_ids ){
                $ids = explode(',', $value->target_audience_ids );
                $value->target_audiences = TargetAudience::whereIn('id', $ids)->get()->toArray();
            }
        }

        return view( 'user.adspackages', compact('advertisement') );
    }

    }

    public function adspackages()
    {
        $user = Auth::user();
        $advertisement = Advertisement::get();

        foreach($advertisement as $key=>$value)
        {
            if( $value->banner_ids ){
                $bannerids = explode(',', $value->banner_ids);
                $value->banners_list = Banner::whereIn('id', $bannerids)->get()->toArray();
            }
            if( $value->target_audience_ids ){
                $ids = explode(',', $value->target_audience_ids );
                $value->target_audiences = TargetAudience::whereIn('id', $ids)->get()->toArray();
            }
        }

        return view( 'user.adspackages', compact('advertisement') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $banners = Banner::get();
        $targetaudience = TargetAudience::get();
        return view('user.createuserads', compact('banners', 'targetaudience'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mybanners = $request->input('mybanners');
        $mytargetaudience = $request->input('mytargetaudience');
        $banner_image = $request->input('banner_image');
        $banner_url = $request->input('banner_url');
        $planfor = $request->input('planfor');

        $target_audience_str = implode(',', $mytargetaudience);


        $user=Auth::user();

        $validation = Validator::make($request->all(), [
            'mybanners' => 'required',
            'mytargetaudience' => 'required',
            'banner_image' => 'required'
        ]);

        if($validation->fails())
        {
            return redirect()->back()->withInput()->withErrors( $validation->errors() );
        }else
        {
            $banner_amounts = array();
            $taudience_amounts = array();
            foreach ($mybanners as $value) {
                $banner = Banner::find($value);
                if($planfor == 'weekly'){
                    $bannerprice = $banner->weekly_price;
                }

                if($planfor == 'monthly'){
                    $bannerprice = $banner->monthly_price;
                }
                array_push($banner_amounts, $bannerprice);
            }
            $banners_total_amount = 0;
            $banners_total_amount = array_sum($banner_amounts);

            foreach ($mytargetaudience as $value) {
                $targetaudience = TargetAudience::find($value);
                array_push($taudience_amounts, $targetaudience->price);
            }

            $taudience_total_amount = 0;
            $taudience_total_amount = array_sum($taudience_amounts);

            $user_total_pay_amount = $banners_total_amount + $taudience_total_amount;

            if($request->hasfile('banner_image'))
            {
                $advertisement = new Advertisement();
                $advertisement->banner_plan = $planfor;
                $advertisement->total_amt = $user_total_pay_amount;
                $advertisement->paid = 0;
                $advertisement->status = 'Inactive';
                $advertisement->approve = 0;
                $advertisement->save();

                $ads_lastinserid = $advertisement->id;

                foreach($request->file('banner_image') as $key=>$image)
                {
                    $image_name=$image->getClientOriginalName();
                    $image->move(public_path().'/assets/images/bannerimages', $image_name);

                    $usersbanner = new UsersBanner();
                    $usersbanner->ads_id = $ads_lastinserid;
                    $usersbanner->user_id = $user->id;
                    $usersbanner->banners_id = $mybanners[$key];

                    $banner_data = Banner::find($mybanners[$key]);
                    if($planfor == 'weekly'){
                        $banner_dataprice = $banner_data->weekly_price;
                    }

                    if($planfor == 'monthly'){
                        $banner_dataprice = $banner_data->monthly_price;
                    }

                    $usersbanner->image = $image_name;
                    $usersbanner->url = $banner_url[$key];
                    $usersbanner->target_audience_id = $target_audience_str;
                    $usersbanner->banner_price = $banner_dataprice;
                    $usersbanner->save();
                }
            }

            return redirect('manageads')->with('success', 'Advertisement Created Successfully, to make it Active paid an amount!!');
        }
    }

    public function checkoutads(Request $request, $id)
    {
        $advertisement = Advertisement::where('id', $id)->first();

        $user = User::find(Auth::user()->id);
        $plandata = array();
        $newplanbuy = 0;
        $featuredata = array();
        $wallet_amount = 0;
        $walletsdata = DB::table('wallets')->where('user_id',$user->id)->first();
        $wallet_amount = 0;
        if($walletsdata != ''){
            $wallet_amount = $walletsdata->balance;
        }

        $token = array();
        $donation = array();
        $creditamount = 0;
        return view('user.checkout', compact('user', 'plandata', 'newplanbuy', 'featuredata', 'wallet_amount', 'token', 'creditamount', 'donation', 'advertisement'));
    }

    public function paywithwalletads(Request $request)
    {
        $adsId = $request->input('ads_id');
        $amount = $request->input('amount');

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

        $user = User::find(Auth::user()->id);
        $userid = $user->id;

        $walletsdata = DB::table('wallets')->where('user_id',$userid)->first();
        if($walletsdata->balance >= $amount){
            $wallet_amount = 0;
            if($walletsdata != ''){
                $wallet_amount = $walletsdata->balance;
                if(is_numeric($wallet_amount) && is_numeric($amount)){
                  $balance = ($wallet_amount - $amount);
                }else {
                  $balance = 'NA';
                }
            }
            
            
            $description = array( "description" => 'You have Purchased Advertisement for token '.$amount, "balance" => $balance);
    
            if ($adsId)
            {
                $advertisement = Advertisement::where('id', $adsId)->first();
    
                $is_ads_subscribe = AdsSubscriptions::where('ads_id', $adsId)->where('user_id', $userid)->orderBy('id', 'desc')->first();
    
                if($is_ads_subscribe == ''){
    
                    $adssubscriptions = new AdsSubscriptions();
                    $adssubscriptions->ads_id = $adsId;
                    $adssubscriptions->user_id = $userid;
                    $adssubscriptions->status = 'Inactive';
                    $adssubscriptions->paid = 1;
                    $adssubscriptions->approve = 0;
                    $adssubscriptions->save();
    
                    $user->withdraw($amount, 'withdraw', $description);
    
                }elseif($is_ads_subscribe != '' && $is_ads_subscribe->count() > 0 && $is_ads_subscribe->status == 'Deleted'){
    
                    $adssubscriptions = new AdsSubscriptions();
                    $adssubscriptions->ads_id = $adsId;
                    $adssubscriptions->user_id = $userid;
                    $adssubscriptions->status = 'Inactive';
                    $adssubscriptions->paid = 1;
                    $adssubscriptions->approve = 0;
                    $adssubscriptions->save();
    
                    $user->withdraw($amount, 'withdraw', $description);
                }else{
    
                    return redirect()->to('subscription/failed');
                }
    
                //notification start
                $wallet = DB::table('wallets')->where('user_id',$user->id)->first();
                $wallet_amount = $wallet->balance;
    
                $admin = User::where('role_id', '=', 1)->first();
                $admin_id = $admin->id;
    
                $message = "Congratulation ".$user->displayname."! You've successfully Purchased Advertisement for token ".$amount."T from your wallet.";
    
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
                //notification end
                return redirect()->to('manageads');
            }
            return redirect()->to('subscription/failed');
        }else{
            return redirect()->to('parcel');
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function uploadbanners(Request $request, $id)
    {
        $sub_ads_id = $id;
        $adssubscriptiondata = AdsSubscriptions::where('id', $id)->first();
        $advertisement = Advertisement::where('id', $adssubscriptiondata->ads_id)->get();
        $banners_list = array();
        $target_audiences = array();
        foreach($advertisement as $key=>$value)
        {
            if( $value->banner_ids ){
                $bannerids = explode(',', $value->banner_ids);
                $banners_list = Banner::whereIn('id', $bannerids)->get();
            }
            if( $value->target_audience_ids ){
                $ids = explode(',', $value->target_audience_ids );
                $target_audiences = TargetAudience::whereIn('id', $ids)->get();
            }
        }
        $ads_id = $adssubscriptiondata->ads_id;

        return view('user.uploadbanners', compact('advertisement', 'ads_id', 'sub_ads_id', 'banners_list', 'target_audiences'));
    }

    public function saveuserbanners(Request $request)
    {
        $ads_id = $request->input('ads_id');
        $sub_ads_id = $request->input('sub_ads_id');
        $mybanners = $request->input('mybanners');
        $mytargetaudience = $request->input('mytargetaudience');
        $banner_image = $request->input('banner_image');
        $banner_url = $request->input('banner_url');

        if($mytargetaudience){
            $target_audience_str = implode(',', $mytargetaudience);
        }

        $user = Auth::user();

        $validation = Validator::make($request->all(), [
            'mytargetaudience' => 'required',
            'banner_image' => 'required'
        ]);

        if($validation->fails())
        {
            return redirect()->back()->withInput()->withErrors( $validation->errors() );
        }else{
            if($request->hasfile('banner_image'))
            {
                foreach($request->file('banner_image') as $key=>$image)
                {
                    $image_name=$image->getClientOriginalName();
                    $image->move(public_path().'/assets/images/bannerimages', $image_name);

                    $usersbanner = new UsersBanner();
                    $usersbanner->ads_id = $ads_id;
                    $usersbanner->ads_subscription_id = $sub_ads_id;
                    $usersbanner->user_id = $user->id;
                    $usersbanner->banners_id = $mybanners[$key];
                    $usersbanner->image = $image_name;
                    $usersbanner->url = $banner_url[$key];
                    $usersbanner->target_audience_id = $target_audience_str;
                    $usersbanner->save();
                }
            }
            return redirect('manageads')->with('success', 'Banners uploaded successfully!!');
        }
    }

    public function editbanners(Request $request, $id)
    {
        $sub_ads_id = $id;
        $ads_subsccriptiondata = AdsSubscriptions::where('user_id', Auth::user()->id)->where('id', $id)->first();
        $ads_subs_id = $id;
        $advertisement = Advertisement::where('id', $ads_subsccriptiondata->ads_id)->get();
        $banners_list = array();
        $target_audiences = array();
        $userbanners = array();
        $ads_id = $ads_subsccriptiondata->ads_id;

        $user=Auth::user();

        foreach($advertisement as $key=>$value)
        {
            if( $value->banner_ids ){
                $bannerids = explode(',', $value->banner_ids);
                $banners_list = Banner::whereIn('id', $bannerids)->get()->toArray();
            }
            if( $value->target_audience_ids ){
                $ids = explode(',', $value->target_audience_ids );
                $target_audiences = TargetAudience::whereIn('id', $ids)->get();
            }

            $userbanners = UsersBanner::where('ads_id', $value->id)->where('user_id', Auth::user()->id)->get();
        }

       return view('user.edituserbanners', compact('advertisement', 'ads_subs_id', 'ads_id', 'sub_ads_id', 'banners_list', 'target_audiences', 'userbanners'));
    }

    public function updateuserbanners(Request $request, $id)
    {
        $ads_sub_id = $id;
        $ads_id = $request->input('ads_id');
        $mybanners = $request->input('mybanners');
        $mytargetaudience = $request->input('mytargetaudience');
        $banner_image = $request->input('banner_image');
        $banner_url = $request->input('banner_url');

        if($mytargetaudience){
            $target_audience_str = implode(',', $mytargetaudience);
        }
        $user=Auth::user();

        $validation = Validator::make($request->all(), [
            'mytargetaudience' => 'required'
        ]);

        if($validation->fails())
        {
            return redirect()->back()->withInput()->withErrors( $validation->errors() );
        }else{

            if($request->hasfile('banner_image'))
            {
                foreach($request->file('banner_image') as $key=>$image)
                {
                    $image_name=$image->getClientOriginalName();
                    $image->move(public_path().'/assets/images/bannerimages', $image_name);

                    $update_data = [
                        'image' => $image_name,
                        'url' => $banner_url[$key],
                        'target_audience_id' => $target_audience_str
                    ];

                    UsersBanner::where('ads_id', $ads_id)->where('user_id', $user->id)->where('banners_id', $mybanners[$key])->update($update_data);
                }
            }else{
                foreach ($mybanners as $key=>$value) {
                    $update_data = [
                        'url' => $banner_url[$key],
                        'target_audience_id' => $target_audience_str
                    ];

                    UsersBanner::where('ads_id', $ads_id)->where('user_id', $user->id)->where('banners_id', $mybanners[$key])->update($update_data);
                }
            }
            return redirect()->back()->with('success', 'Banners Updated successfully!!');
        }
    }

    public function deletesubads(Request $request, $id)
    {
        $user = Auth::user();
        $cdate = date("Y-m-d H:i:s");

        $update_data = [
            'status' => 'Deleted',
            'deleted_by' => $user->id,
            'updated_at' => $cdate
        ];

        AdsSubscriptions::where('id', $id)->update($update_data);

        return redirect()->back()->with('success', 'Advertisement deleted successfully!!');
    }
}
