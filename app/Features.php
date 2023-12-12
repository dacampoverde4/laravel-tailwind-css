<?php

namespace App;
use Auth;
use App\Subscription;
use App\TokenDebit;
use Illuminate\Database\Eloquent\Model;

class Features extends Model
{
    protected $fillable = [
        'title'
    ];

    public static function isHeCanChatWithNewConnection(){
        return self::validate('sub_monthly_connection_', 'token_monthly_connection_');
    }

    public static function isHeCanSendThisTrail(){
        return self::validate('sub_trial_token_', 'token_trial_token_value_');
    }
    public static function isHeCanChangeProfilePic(){
        return self::validate('sub_user_image_change_', 'token_user_image_change_value_');
    }
    public static function isHeCanUploadMaxImages(){
        return self::validate('sub_max_images_upload_', 'token_max_images_upload_value_');
    }
    public static function isUserDisplayMultipleMatches(){
        return self::validate('sub_view_my_matches_', 'token_view_my_matches_value_');
    }
    public static function isUserCanChangeUserName(){
        return self::validate('sub_username_change_', 'token_username_change_value_');
    }

    public static function isUserAccessSearch(){
        return self::validate('sub_advance_search_');
    }
    public static function validate( $feature, $manualfeature = '' ){
        if( Auth::user() ){
    		if( Auth::user()->role_id == 1 ){
    			return true;
    		}
            $plan = getCurrentUserPlan();
            if( $plan ){
                $mannaulconnect = $usedmannualconnection = 0;
                $usedconnection = (int)usedConnection( $feature.$plan->id );
                $monthlyconnect = getWebsiteSettingsByKey( $feature.$plan->id );
                if( $manualfeature ){
                    $groupid = Auth::user()->group;
                    $mannaulconnect = getmanualfeatures( $manualfeature );
                    $usedmannualconnection = (int)usedConnection( $manualfeature.$groupid );
                }
                if( $monthlyconnect == -1 || $mannaulconnect == -1 ){
                    return true;
                }
                $remaining = ( (int)$monthlyconnect + (int)$mannaulconnect ) - ( (int)$usedconnection + (int)$usedmannualconnection );
                if( $remaining > 0 ){
                    $ttlsubconnection = $monthlyconnect - $usedconnection;
                    if( $ttlsubconnection <= 0 ){
                        return 2;
                    }
                    return 1;
                }
            }else{
                $mannaulconnect = 0;
                $groupid = Auth::user()->group;
                $mannaulconnect = getmanualfeatures( $manualfeature );
                $usedmannualconnection = (int)usedConnection( $manualfeature.$groupid );
                if( $mannaulconnect == -1 ){
                    return true;
                }
                $remaining = (int)$mannaulconnect - (int)$usedmannualconnection;
                if( $remaining > 0 ){
                    return 2;
                }
            }
        }
        return false;
    }

}
