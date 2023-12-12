<?php

namespace App;
use Auth;
use App\User;
use Illuminate\Database\Eloquent\Model;

class FeatureUses extends Model
{
    public static function storeFeatureUsase( $feature, $ismanual ){
    	 if( Auth::user() ){
	    	if( Auth::user()->role_id == 1 ){
	    		return true;
	    	}
	        $featureuses = new FeatureUses;
	        if( $ismanual != 2 ){
				$plan = getCurrentUserPlan();
				$featureuses->featurid = $feature.$plan->id;
				$featureuses->subscriptionid =  $plan->id;
				$featureuses->is_subscription_token =  1;
	    	}else{
	    		$groupid = Auth::user()->group;
	    		$featureuses->featurid = $feature.$groupid;
	    	}
			$featureuses->token_uses =  1;
			$featureuses->userid =  Auth::user()->id;
			$featureuses->save();
			return true;
    	}
    	return false;
    }
    

}
