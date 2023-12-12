<?php

namespace App\Http\Controllers;

use App\WebsiteSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\SubscriptionController;
use File;
use Illuminate\Support\Str;

class WebsiteSettingController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
		/*\Stripe\Stripe::setApiKey(env("STRIPE_SECRET"));*/
	}

    //Display Token Price
    public function websitesettingtoken()
    {
        $metaData = self::setMetas();
        return view('admin.websitesetting.settingstoken', compact('metaData'));
    }

    public function getMembershipSettings($id)
    {
        $metaData = self::setMetas();
        $planlist = SubscriptionController::getPlanlist();
        return view('admin.websitesetting.membership-limitation', compact('metaData', 'planlist', 'id'));
    }

    public function saveWebsiteSetting(Request $request, $id=0){

        $planData=\App\Plan::find($id);
        if($planData){
        /* $best_seller_ribbon = '';
          if ($request->has('best_seller_ribbon')) {
              $image = $request->file('best_seller_ribbon');
              $image_path = public_path()."/".$planData->best_seller_ribbon;
              if(!empty($planData->best_seller_ribbon) && File::exists($image_path)) {
                  File::delete($image_path);
              }
              $db_image_name = 'assets/images/plan/';
              $imagename = Str::random(10).'_'.time().'_.'.$image->getClientOriginalExtension();
              $best_seller_ribbon = $db_image_name.$imagename;
              $destinationPath = public_path('/assets/images/plan/');
              $image->move($destinationPath, $imagename);
              $planData->best_seller_ribbon = $best_seller_ribbon;
          }

          if($request->remove_existing_image){
              $image_path = public_path()."/assets/images/".$planData->best_seller_ribbon;
              if(File::exists($image_path)) {
                  File::delete($image_path);
              }
              $planData->best_seller_ribbon = "";
          } */
            if($request->input('plan_color')){
              $planData->plan_color = $request->input('plan_color');
            }
            if($request->input('name')){
              $planData->name = $request->input('name');
            }
            if($request->input('best_seller_ribbon')){
              $planData->best_seller_ribbon = $request->input('best_seller_ribbon');
            }
            if($request->input('plan_sale')){
              $planData->plan_sale = $request->input('plan_sale');
            }
            if($request->input('description')){
              $planData->description = $request->input('description');
            }
            if($request->input('trial_period_days')){
              $planData->trial_period = $request->input('trial_period_days');
            }
            if($request->input('price')){
              $planData->price = $request->input('price');
            }
            if($request->input('tokens')){
              $planData->tokens = $request->input('tokens');
            }
            if($request->input('billing_interval')){
              $planData->billing_interval = $request->input('billing_interval');
            }            
            $planData->save();
        }else{
            $planData = new \App\Plan;
            if($request->input('plan_color')){
              $planData->plan_color = $request->input('plan_color');
            }
            if($request->input('name')){
              $planData->name = $request->input('name');
            }
            if($request->input('best_seller_ribbon')){
              $planData->best_seller_ribbon = $request->input('best_seller_ribbon');
            }
            if($request->input('plan_sale')){
              $planData->plan_sale = $request->input('plan_sale');
            }
            if($request->input('description')){
              $planData->description = $request->input('description');
            }
            if($request->input('trial_period_days')){
              $planData->trial_period = $request->input('trial_period_days');
            }
            if($request->input('price')){
              $planData->price = $request->input('price');
            }
            if($request->input('tokens')){
              $planData->tokens = $request->input('tokens');
            }
            if($request->input('billing_interval')){
              $planData->billing_interval = $request->input('billing_interval');
            }
            $planData->save();
        }


        $websiteSettings = $request->input('websiteSettings');
        if( isset( $websiteSettings['sub_private_messages_'.$id] ) ){
            $websiteSettings['sub_my_hearts_'.$id] = isset( $websiteSettings['sub_my_hearts_'.$id] )? 1 : 0;
            $websiteSettings['sub_advance_search_'.$id] = isset( $websiteSettings['sub_advance_search_'.$id] )? 1 : 0;
        }
        if( count( $websiteSettings ) ){
            foreach( $websiteSettings as $fieldId => $fieldVal ){
                self::addMetaValue( $fieldId, $fieldVal, $id );
            }
            return redirect()->back()->with('success', 'Settings saved successfully');
        }
    }

    public function setMetas(){
        $metaDatas = WebsiteSetting::all();
        $newmetaInfo = array();
        if( $metaDatas ){
            foreach( $metaDatas as $metaData ){
                $newmetaInfo[$metaData->meta_key] = $metaData->meta_value;
            }
        }
        return $newmetaInfo;
    }

    public function addMetaValue( $metaKey, $metaValue, $metaID ){
        $data = WebsiteSetting::where('meta_key', $metaKey)->first();
        if( $data ){
            $data->meta_value = $metaValue;
        }else{
            $data = new WebsiteSetting;
            $data->meta_id = $metaID;
            $data->meta_key = $metaKey;
            $data->meta_value = $metaValue;
        }
        $data->save();
    }
    public function featurePricing( $id ){
        $metaData = self::setMetas();
        return view('admin.websitesetting.featurepricing', compact('metaData', 'id'));
    }

    //Display Scrren Name
    public function websitesettingScreenName()
    {
        $metaData = self::setMetas();
        return view('admin.websitesetting.screennameSetting', compact('metaData'));
    }

    public function freeUsersFeatureSetting()
    {
        $metaData = self::setMetas();
        return view('admin.websitesetting.freemembersetting', compact('metaData'));
    }

    public function registerLabels()
    {
        $metaData = self::setMetas();
        return view('admin.websitesetting.registerlabels', compact('metaData'));
    }

}
