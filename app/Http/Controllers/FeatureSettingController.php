<?php

namespace App\Http\Controllers;

use App\FeatureSetting;
use Illuminate\Http\Request;
use App\Usergroup;
use App\Plan;

class FeatureSettingController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
		\Stripe\Stripe::setApiKey('sk_test_qdR117oxyOGQJYgcibORDgps');
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $featuresetting = FeatureSetting::all();
        return view('admin.featureSetting.index', compact('featuresetting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $plans = Plan::all();
        $usergroups = Usergroup::all();
        return view('admin.featureSetting.create', compact('usergroups', 'plans'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
			'name' => 'required',
	        'tokens' => 'required|numeric',
	        'billing_interval' => 'required',
	        'amount' => 'required',
	        'visibility' => 'required',
	        'info' => 'required',
	    ]);

	    $paymentarray = array(
			  "nickname" => $request->input('name'),
			  "amount" => $request->input('amount') * 100,
			  "interval" => $request->input('billing_interval'),
			  "product" => array(
			    "name" => $request->input('name')
			  ),
			  "currency" => "usd",
			  "trial_period_days" => $request->input('trial_period_days'),
		);
	    $tokenamount = getWebsiteSettingsByKey('token_amount');
		if( $tokenamount ){
			$paymentarray["amount"] = ( $request->input('price') * $tokenamount ) * 100;
		}
	    if( $request->input('billing_interval') == 'quarter'){
	    	$paymentarray["interval"] = 'month';
	    	$paymentarray["interval_count"] = 3;
	    }

	    if( $request->input('billing_interval') == 'semiannual'){
	    	$paymentarray["interval"] = 'month';
	    	$paymentarray["interval_count"] = 6;
	    }

	    try {
	    $response = \Stripe\Plan::create($paymentarray);
        $featuresetting = new FeatureSetting;
        $featuresetting->name = $request->name;
        $featuresetting->tokens = $request->tokens;
        $featuresetting->billing_interval = $request->billing_interval;
        $featuresetting->amount_days = $request->input('amount');
        $featuresetting->plan_id = $response->id;
        $featuresetting->user_group = $request->user_group;
        $featuresetting->visibility = json_encode($request->visibility);
        $featuresetting->info = $request->info;
        $featuresetting->save();

	    } catch ( Exception $e ) {

	    }
        return redirect('/admin/feature-setting');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FeatureSetting  $featureSetting
     * @return \Illuminate\Http\Response
     */
    public function show(FeatureSetting $featureSetting)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FeatureSetting  $featureSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(FeatureSetting $featureSetting, $id)
    {
        $usergroups = Usergroup::all();
        $plans = Plan::all();
        $featuresetting = FeatureSetting::find($id);
        return view('admin.featureSetting.edit', compact('usergroups', 'featuresetting', 'plans'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FeatureSetting  $featureSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FeatureSetting $featureSetting, $id)
    {
        $request->validate([
			'name' => 'required',
	        'visibility' => 'required',
	        'info' => 'required',
	    ]);
        $featuresetting = FeatureSetting::find($id);
        $featuresetting->name = $request->name;
        $featuresetting->user_group = $request->user_group;
        $featuresetting->visibility = json_encode($request->visibility);
        $featuresetting->info = $request->info;
        $featuresetting->amount_days = $request->input('amount');
        $featuresetting->save();
        return redirect('/admin/feature-setting');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FeatureSetting  $featureSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(FeatureSetting $featureSetting, $id)
    {
        $featuresetting = FeatureSetting::find($id);
        $featuresetting->delete();
        return redirect('/admin/feature-setting');
    }


}
