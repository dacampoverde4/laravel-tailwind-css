<?php

function getLatestNotification($limit = 10)
{
    return \App\Notification::where('user_id', Auth::user()->id)->where('is_seen', '1')->take($limit)->latest()->orderBy('id', 'DESC')->get();
}

//function to get latest top 5 notifiction for user
function getUserDashboardNotification($limit = 5)
{

    return \App\Notification::where('user_id', Auth::user()->id)->take($limit)->latest()->orderBy('id', 'DESC')->get();
}

//function to get all notification with pagination
function getAllNotification()
{
    return \App\Notification::where('user_id', Auth::user()->id)->latest()->paginate(10);
}

function chatNotifications($limit = 10)
{
    $userinfo = $validation = array();
    $blockIds = getblockeduser();
    $query = '';
    if ($blockIds) {
        $blockusers = implode(', ', $blockIds);
        $query = "AND `reciever_id` NOT IN($blockusers)";
    }
    $messages = DB::select('select * from `messages` WHERE id IN (
			    SELECT MAX(id)
			    FROM messages
			    where  ( ( reciever_id = ' . Auth::user()->id . ' OR  user_id = ' . Auth::user()->id . ' ) )
			    ' . $query . '
			    GROUP BY reciever_id
			)  AND is_seen = 1  order by id DESC limit 0, ' . $limit);
    if ($messages) {
        $i = 0;
        foreach ($messages as $message) {
            $user_id = $message->reciever_id;
            if (Auth::user()->id == $message->reciever_id) {
                $user_id = $message->user_id;
            }
            if (!in_array($user_id, $validation)) {
                $date = \Carbon\Carbon::now();
                $date2 = \Carbon\Carbon::parse($message->created_at);
                $message->newdate = $date->diffForHumans($date2, true, true, 1);
                $message->message = str_limit($message->message, 20);
                $validation[] = $user_id;
                $userinfo[$i]['message'] = $message;
                $userinfo[$i]['user'] = \App\User::find($user_id);
                $userinfo[$i]['seen'] = $ttlcount = \App\Message::where(['is_seen' => 1, 'user_id' => $user_id, 'reciever_id' => Auth::user()->id])->count();
                $i++;
            }
        }
    }
    return $userinfo;
}

function getblockeduser($userid = 0)
{
    $blockIds = array();
    if (Auth::user()) {
        if (Auth::user()->role_id == 1) {
            return $blockIds;
        }
        return App\Reportblock::where('user_id', Auth::user()->id)->pluck('block_id')->toArray();
    }
    return $blockIds;
}

function getCurrentUserPlan()
{
    if (Auth::user()) {
        $userid = Auth::user()->id;
        $subscription = \App\Subscription::where('user_id', $userid)->where('name', 'main')->where('quantity', '1')->orderBy('id', 'DESC')->first();
        if ($subscription/* && isthisSubscribed()*/) {
            return \App\Plan::where('plan_id', $subscription->stripe_plan)->first();
        } else {
            return \App\Plan::where('plan_id', 'plan_DGPRyjNYWH0Y1h')->first();
        }
    }
    return false;
}


function getUserPlan($user_id)
{
    if(\App\User::find($user_id)) {
        $userid = $user_id;
        $subscription = \App\Subscription::where('user_id', $userid)->where('name', 'main')->orderBy('id', 'DESC')->first();
        if ($subscription && isthisSubscribed()) {
            return \App\Plan::where('plan_id', $subscription->stripe_plan)->first();
        } else {
            return \App\Plan::where('plan_id', 'plan_DGPRyjNYWH0Y1h')->first();
        }
    }
    return false;
}

function usedConnection($featureId)
{
    if (Auth::user()) {
        $currentMonth = date('m');
        return \App\FeatureUses::where('featurid', $featureId)
            ->where('userid', Auth::user()->id)
            ->whereRaw('MONTH(created_at) = ?', [$currentMonth])
            ->sum('token_uses');
    }
    return 0;
}

function getWebsiteSettingsByKey($metakey)
{
    $metainfo = \App\WebsiteSetting::where('meta_key', $metakey)->select('meta_value')->first();
    return isset($metainfo->meta_value) ? $metainfo->meta_value : '';
}

function isthisUserSubscribed($user_id)
{
    if ($user_id) {
        $user = App\User::find($user_id);
        $subscription = \App\Subscription::where('user_id', $user_id)->where('name', 'main')->first();
        if ($subscription) {
            if (($user->subscribed('main') || ($user->subscription('main')->onGracePeriod()))) {
                return true;
            }
        }
    }
    return false;
}

function getmanualfeatures($features)
{
    if (!Auth::user()) {
        return false;
    }
    $groupid = Auth::user()->group;
    return App\TokenDebit::where('group_id', $groupid)->where('user_id', Auth::user()->id)->where('featured_id', $features . $groupid)->sum('connection');
}

function isthisSubscribed()
{
    if (Auth::user()) {
        $user = App\User::find(Auth::user()->id);
        $subscription = \App\Subscription::where('user_id', Auth::user()->id)->where('name', 'main')->first();
        if ($subscription) {
            if (($user->subscribed('main') || ($user->subscription('main')->onGracePeriod()))) {
                return true;
            }
        }
    }
    return false;
}

function isAdmin()
{
    if (Auth::user()) {
        if (Auth::user()->role_id == 1) {
            return true;
        }
    }
    return false;
}

function isStaff()
{
    if (Auth::user()) {
        if (Auth::user()->role_id == 3) {
            return true;
        }
    }
    return false;
}

function getGroupTagWithColor($uid)
{
    $html = '';
    $udata = App\User::find($uid);
    if ($udata) {
        if (@$udata->usergroup->tags) {
            $tagdata = App\UsergroupTag::find(@$udata->usergroup->tags);
            if ($tagdata) {
                $html = '<div class="Usergradientbg" style="background: linear-gradient(-45deg, ' . @$tagdata->primary_color . ' 50%, ' . @$tagdata->secondary_color . ' 50%);">
	                <span>' . @$tagdata->title . '</span>
	            </div>';
            }
        }
    }
    return $html;
}
function getRelationshipTagWithColor($uid)
{
    $html = '';
    if ($uid) {
        $tagdata = App\Relationship::find($uid);
        if ($tagdata) {
            $html = '<div class="Usergradientbg3" style="display:inline;">
                <span>' . @$tagdata->title . '</span>
            </div>';
        }
        
    }
    return $html;
}

function getOccupationTagWithColor($uid)
{
    $html = '';
    if ($uid) {
        $tagdata = App\Occupation::find($uid);
        if ($tagdata) {
            $html = '<div class="Usergradientbg3" style="display:inline;">
                <span>' . @$tagdata->title . '</span>
            </div>';
        }
        
    }
    return $html;
}

function getHuds($uid)
{
    $html = '';
    $udata = App\User::find($uid);
    if ($udata) {
      $user_huds = ($udata->huds)? json_decode( $udata->huds ) : array();
      
      if(is_array($user_huds) && count($user_huds)>0){
          foreach($user_huds as $hud_id){
            $html .= '<div class="Usergradientbg2 ">';
                $hudsdata = App\Hud::find(@$hud_id);
                if ($hudsdata) {
                    $html .= '<span>' . @$hudsdata->title . '</span>';
                }
            $html .= '</div>';
          }
      }
      

    }
    return $html;
}

function getGroupTagColors($uid)
{
    $colors = array('primary_color' => '', 'secondary_color' => '', 'title' => '');
    $udata = App\User::find($uid);
    if ($udata) {
        if (@$udata->usergroup->tags) {
            $tagdata = App\UsergroupTag::find(@$udata->usergroup->tags);
            if ($tagdata) {
                $colors['primary_color'] = @$tagdata->primary_color;
                $colors['secondary_color'] = @$tagdata->secondary_color;
                $colors['title'] = @$tagdata->title;
            }
        }
    }
    return $colors;
}

function likeCount($userid)
{
    return App\Like::where('isliked', 1)->where('user_id', $userid)->count();
}

function getFeaturedPlans()
{
    if (Auth::user()) {
        $group_id = Auth::user()->group;
        if ($group_id) {
            return App\FeatureSetting::where('user_group', $group_id)->get();
        }
    }
}

function isthisSubscribedFeature($userid = 0)
{
    if (!$userid) {
        if (Auth::user()) {
            $userid = Auth::user()->id;
        }
    }
    if ($userid) {
        $user = App\User::find($userid);
        $subscription = \App\Subscription::where('user_id', $userid)->where('name', 'feature')->first();
        if ($subscription) {
            if (($user->subscribed('feature') || ($user->subscription('feature')->onGracePeriod()))) {
                return true;
            }
        }
    }
    return false;
}

function getSubscribedFeatureUsers($take = 5)
{
    if (Auth::user()) {
        $groupId = Auth::user()->group;
        $features = \App\FeatureSetting::where('user_group',$groupId)->pluck('plan_id')->toArray();
        if (count($features)) {
           return \App\Subscription::whereHas('user',function($query){
            $query->where('photo_status', 0);
           })->where('name', 'feature')->whereIn('stripe_plan', $features)->inRandomOrder()->take($take)->get();
        }
    } else {
        return \App\Subscription::whereHas('user',function($query){
            $query->where('photo_status', 0);
           })->where('name', 'feature')->inRandomOrder()->take($take)->get();
    }
    return false;
}

function removeWords($text)
{
    $getWords = \App\WordsSecurity::pluck('title')->toArray();
    return preg_replace('/\b(\w*' . strtolower(implode('|', $getWords)) . '\w*)\b/', '', strtolower($text));
}

function subscriptionStartDate()
{
    if (Auth::user()) {
        $user = \App\User::find(Auth::user()->id);
        if ($user->stripe_id) {
            $timestamp = $user->asStripeCustomer()["subscriptions"]->data[0]["current_period_start"];

            return \Carbon\Carbon::createFromTimeStamp($timestamp)->toDateTimeString();
        }
    }
}

function usedImagesInAlbum()
{
    if (Auth::user()) {
        $column = 'sub_max_images_upload_' . getCurrentUserPlan()->id;
        $subDate = subscriptionStartDate();
        return \App\FeatureUses::where('featurid', $column)->where('userid', Auth::user()->id)->whereDate('created_at', '>=', $subDate)->get();
    }
}

function usedUserChangeName()
{
    if (Auth::user()) {
        $column = 'sub_username_change_' . getCurrentUserPlan()->id;
        $subDate = subscriptionStartDate();
        if($subDate)
          return \App\FeatureUses::where('featurid', $column)->where('userid', Auth::user()->id)->whereDate('created_at', '>=', $subDate)->get();
    }
}


function usedUserChat()
{
    if (Auth::user()) {
        $column = 'sub_monthly_connection_' . getCurrentUserPlan()->id;
        $subDate = subscriptionStartDate();
        if ($subDate) {
            return \App\FeatureUses::where('featurid', $column)->where('userid', Auth::user()->id)->whereDate('created_at', '>=', $subDate)->get();
        }
    }
}

function countAllMembers()
{
    $allUsers = \App\User::get();
    return $allUsers->count();
}

function countAllParents()
{
    $allParents = \App\User::where('group', 2)->get();
    return $allParents->count();
}

function countAllGirls()
{
    $allGirls = \App\User::where('gender', 6)->get();
    return $allGirls->count();
}

function countAllBoys()
{
    $allBoys = \App\User::where('gender', 5)->get();
    return $allBoys->count();
}

function latestThreeMember()
{
    return \App\User::orderBy('id', 'desc')->take(3)->get();
}

function randomFeatureUsers()
{
    $users = \App\Subscription::where('name', 'feature')->inRandomOrder()->take(3)->pluck('user_id');
    return \App\User::find($users);
}

function checkEventButOrNot($id)
{
    if (Auth::user()) {
        $column = 'sub_monthly_connection_' . getCurrentUserPlan()->id;
        $subDate = subscriptionStartDate();
        return \App\EventBuy::where('user_id', Auth::user()->id)->where('event_id', $id)->first();
    }
    return false;
}

function testing($id)
{
    return \App\FormOption::where('field_id', '=', $id)->get();
}

//function to get lastest notification for user
function getAnnouncementForUserDashboard($limit = 5)
{
    return App\Announcements::where('user_ids', 'NOT LIKE', '%"' . Auth::user()->id . '"%')->take($limit)->latest();
}

//function to get subscription plan of the user
function getUserSubscriptionPlan()
{
    return \App\Subscription::where('user_id', Auth::user()->id)->first();
}

//Get plan expiry date
function getExpiryDate($plan_id)
{

    $plan = \App\Plan::where('plan_id', $plan_id)->first();
    $expiry_date = '';
    switch ($plan->billing_interval) {
        case 'day':
            $expiry_date = \Carbon\Carbon::now()->addDay(1)->format("Y-m-d H:i:s");
            break;
        case 'week':
            $expiry_date = \Carbon\Carbon::now()->addWeek(1)->format("Y-m-d H:i:s");
            break;
        case 'month':
            $expiry_date = \Carbon\Carbon::now()->addMonth(1)->format("Y-m-d H:i:s");
            break;
        case 'quarter':
            $expiry_date = \Carbon\Carbon::now()->addMonth(3)->format("Y-m-d H:i:s");
            break;
        case 'semiannual':
            $expiry_date = \Carbon\Carbon::now()->addMonth(6)->format("Y-m-d H:i:s");
            break;
        case 'year':
            $expiry_date = \Carbon\Carbon::now()->addYear(1)->format("Y-m-d H:i:s");
            break;
        default:
            $expiry_date = '';
            break;
    }
    return $expiry_date;
}

//Get plan expiry date on downgrade
function getDowngradeExpiryDate($plan_id, $diff_days)
{

    $plan = \App\Plan::where('plan_id', $plan_id)->first();
    $expiry_date = '';
    switch ($plan->billing_interval) {
        case 'day':
            $expiry_date = \Carbon\Carbon::now()->addDay(1)->format("Y-m-d H:i:s");
            break;
        case 'week':
            $expiry_date = \Carbon\Carbon::now()->addWeek(1)->format("Y-m-d H:i:s");
            break;
        case 'month':
            $expiry_date = \Carbon\Carbon::now()->addMonth(1)->format("Y-m-d H:i:s");
            break;
        case 'quarter':
            $expiry_date = \Carbon\Carbon::now()->addMonth(3)->format("Y-m-d H:i:s");
            break;
        case 'semiannual':
            $expiry_date = \Carbon\Carbon::now()->addMonth(6)->format("Y-m-d H:i:s");
            break;
        case 'year':
            $expiry_date = \Carbon\Carbon::now()->addYear(1)->format("Y-m-d H:i:s");
            break;
        default:
            $expiry_date = '';
            break;
    }

    if(isset($diff_days) && !empty($diff_days)){
      $expiry_date = $expiry_date->addDays($diff_days);
    }

    return $expiry_date;
}
