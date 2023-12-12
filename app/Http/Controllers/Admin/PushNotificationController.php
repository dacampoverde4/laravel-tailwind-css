<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PushNotification;
use App\Models\PushNotificationDiscountType;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use File;
use App\Usergroup;
use App\Plan;

class PushNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pushnotifications = PushNotification::all();
        return view('admin.pushnotifications.show_all_pushnotifications', compact('pushnotifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_groups = Usergroup::all();
        $plans = Plan::all();
        return view('admin.pushnotifications.create_pushnotification', compact('user_groups', 'plans'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:push_notifications|max:100|regex:/(^[A-Za-z ]+$)+/',
            'url' => 'nullable|url',
            'showing_count' => 'nullable|numeric',
            'seconds_to_show_after_login' => 'nullable|numeric'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $db_image_name = '';
        if ($request->has('banner')) {
            $image = $request->file('banner');
            $db_image_name = 'assets/images/pushnotifications/';
            $imagename = Str::random(10).'_'.time().'_.'.$image->getClientOriginalExtension();
            $db_image_name = $db_image_name.$imagename;
            $destinationPath = public_path('/assets/images/pushnotifications/');
            $image->move($destinationPath, $imagename);
        }
        $pushnotification_obj = new PushNotification();
        $pushnotification_obj->name = $request->name;
        $pushnotification_obj->button_text = $request->button_text;
        $pushnotification_obj->url = $request->url;
        $pushnotification_obj->content = $request->content;
        $pushnotification_obj->image = $db_image_name;
        $pushnotification_obj->showing_count = $request->showing_count;
        $pushnotification_obj->seconds_to_show_after_login = $request->seconds_to_show_after_login;
        $pushnotification_obj->show_to_new_users = $request->has('show_to_new_users') ? 1 : 0;
        $pushnotification_obj->save();
        if($request->has('user_groups')){
            $pushnotification_obj->usergroups()->attach($request->user_groups);
        }
        if($request->has('plans')){
            $pushnotification_obj->plans()->attach($request->plans);
        }

        return redirect()->route('pushnotifications.index')->with('success', 'Push Notification created Successfully !!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PushNotification $pushnotification)
    {
        return view('admin.pushnotifications.view_pushnotification', compact('pushnotification'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PushNotification $pushnotification)
    {
        $user_groups = Usergroup::all();
        $plans = Plan::all();
        $selected_plans = $pushnotification->plans->pluck('id')->toArray();
        $selected_usergroups = $pushnotification->usergroups->pluck('id')->toArray();
        return view('admin.pushnotifications.edit_pushnotification', compact('pushnotification', 'user_groups', 'plans', 'selected_plans', 'selected_usergroups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PushNotification $pushnotification)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:push_notifications,name,'.$pushnotification->id.'|max:100|regex:/(^[A-Za-z ]+$)+/',
            'url' => 'nullable|url',
            'showing_count' => 'nullable|numeric',
            'seconds_to_show_after_login' => 'nullable|numeric'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        if ($request->has('banner')) {
            $image_path = public_path()."/".$pushnotification->image;
            if(!empty($pushnotification->image) && File::exists($image_path)) {
                File::delete($image_path);
            }
            $image = $request->file('banner');
            $db_image_name = 'assets/images/pushnotifications/';
            $imagename = Str::random(10).'_'.time().'_.'.$image->getClientOriginalExtension();
            $db_image_name = $db_image_name.$imagename;
            $destinationPath = public_path('/assets/images/pushnotifications/');
            $image->move($destinationPath, $imagename);
            $pushnotification->image = $db_image_name;
        }
        if($request->remove_existing_image){
            $image_path = public_path()."/assets/images/pushnotifications/".$pushnotification->image;
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
            $pushnotification->image = "";
        }
        $pushnotification->name = $request->name;
        $pushnotification->button_text = $request->button_text;
        $pushnotification->url = $request->url;
        $pushnotification->content = $request->content;
        $pushnotification->showing_count = $request->showing_count;
        $pushnotification->seconds_to_show_after_login = $request->seconds_to_show_after_login;
        $pushnotification->show_to_new_users = $request->has('show_to_new_users') ? 1 : 0;
        $pushnotification->save();
        if($request->has('user_groups')){
            $pushnotification->usergroups()->sync($request->user_groups);
        }
        if($request->has('plans')){
            $pushnotification->plans()->sync($request->plans);
        }
        return redirect()->back()->with('success', 'Push Notification updated successfuly.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PushNotification $pushnotification)
    {
        $pushnotification->delete();
        return redirect()->route('pushnotifications.index')->with('success', 'Push Notification deleted successfuly.');
    }
}
