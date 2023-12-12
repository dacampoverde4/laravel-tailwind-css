<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;
use App\Usergroup;
use App\Http\Controllers\Controller;

class SubscribedUserController extends Controller
{
    public function index(Request $request){
        $search = $request->all();
        if(isset($search['searchdata'])){
            $subscribed_users = User::WhereHasRole(['Free User'])->with('subscribedPlan');
            if(isset($search['group']) && !empty($search['group'])){
                $subscribed_users->where('group', $search['group']);
            }
            if(isset($search['username']) && !empty($search['username'])){
                $subscribed_users->where('name', 'LIKE', $search['username']."%");
            }
            $subscribed_users = $subscribed_users->get();
        }else{
            $subscribed_users = User::WhereHasRole(['Free User'])->with('subscribedPlan')->get();
        }
        $usergroups = Usergroup::all();
       
        return view('admin.subscibed_users.show_all_subscibed_users', compact('subscribed_users', 'usergroups', 'search'));
    }
}
