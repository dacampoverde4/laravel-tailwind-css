<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Usergroup;
use App\SubscriptionPlanUserGroup;
use App\Plan;

class SubscriptionPlanUserGroupConteroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups=SubscriptionPlanUserGroup::with('group_point_first', 'group_point_second')->get();
        $plans=SubscriptionPlanUserGroup::with('group_point2_plan', 'group_point1_plan')->get();
     
        return  view('admin.subscriptionplanusergroup.index',compact('plans','groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function create()
    {
        $groups=Usergroup::all();
        return  view('admin.subscriptionplanusergroup.create',compact('groups'));
        //
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
            'main_group_id'=>'required|max:255',
            'map_group_id'=>'required|max:255',
            'main_group_plan_id' => 'required',
            'map_group_plan_id' => 'required|max:255',    
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $cond=['main_group_id'=>$request->main_group_id,
        'map_group_id'=>$request->map_group_id,
        'main_group_plan_id'=>$request->main_group_plan_id,
        'map_group_plan_id'=>$request->map_group_plan_id];
        $subgrpu=SubscriptionPlanUserGroup::Where($cond)->first();
        $cond2=['main_group_id'=>$request->main_group_id,
        'map_group_id'=>$request->map_group_id,
        'main_group_plan_id'=>$request->main_group_plan_id,];
        $subgrpu2=SubscriptionPlanUserGroup::Where($cond2)->first();
        $cond3=['main_group_id'=>$request->main_group_id,
        'map_group_id'=>$request->map_group_id,
        'map_group_plan_id'=>$request->map_group_plan_id,];
        $subgrpu3=SubscriptionPlanUserGroup::Where($cond3)->first();
        if($subgrpu){    
            return redirect()->back()->with('Error', 'Group is allready');
        }elseif($subgrpu2){
            return redirect()->back()->with('Error', 'Plan is allready');
        }elseif($subgrpu3){
            return redirect()->back()->with('Error', 'Plan is allready');
        }else{
            $subscriptionplanusergroup= new SubscriptionPlanUserGroup;
            $subscriptionplanusergroup->main_group_id =$request->main_group_id;
            $subscriptionplanusergroup->map_group_id =$request->map_group_id;
            $subscriptionplanusergroup->main_group_plan_id =$request->main_group_plan_id;
            $subscriptionplanusergroup->map_group_plan_id =$request->map_group_plan_id;
            $subscriptionplanusergroup->save();
            return redirect()->route('subscription-plan-usergroup.index')->with('message', 'Maped. successfully');
        }
            return redirect()->back()->with('Error', 'Something  is wrong');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $group=SubscriptionPlanUserGroup::find($id);
        $point1=Usergroup::find($group->main_group_id);
        $point2=Usergroup::find($group->map_group_id);
        $point2=$point2->title;
        $point1=$point1->title;
        $point1plan=Plan::where('plan_id',$group->main_group_plan_id)->first();
        $point2plan=Plan::where('plan_id',$group->map_group_plan_id)->first();
        return  view('admin.subscriptionplanusergroup.show',compact('point1','point2','point1plan','point2plan'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 
        $groups=Usergroup::all();
        $plans=Plan::all();
        $group=SubscriptionPlanUserGroup::find($id);
        $point1=Usergroup::find($group->main_group_id);
        $point2=Usergroup::find($group->map_group_id);
        $point1plan=Plan::where('plan_id',$group->main_group_plan_id)->first();
        $point2plan=Plan::where('plan_id',$group->map_group_plan_id)->first();
        $point2=$point2->id;
        $point1=$point1->id;
        return  view('admin.subscriptionplanusergroup.edit',compact('groups','plans','point2','point1','point1plan','point2plan','group'));
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
        $validator = Validator::make($request->all(), [
            'main_group_id'=>'required|max:255',
            'map_group_id'=>'required|max:255',
            'main_group_plan_id' => 'required',
            'map_group_plan_id' => 'required|unique:subscription_plan_user_groups,map_group_plan_id,'.$id.'|max:191|max:255|unique:subscription_plan_user_groups',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $subscriptionplanusergroup=SubscriptionPlanUserGroup::find($request->id);
        $subscriptionplanusergroup->main_group_id =$request->main_group_id;
        $subscriptionplanusergroup->map_group_id =$request->map_group_id;
        $subscriptionplanusergroup->main_group_plan_id =$request->main_group_plan_id;
        $subscriptionplanusergroup->map_group_plan_id =$request->map_group_plan_id;
        $subscriptionplanusergroup->save();
        return redirect()->route('subscription-plan-usergroup.index')->with('message', 'Mapping updates successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subscriptionplanusergroup=SubscriptionPlanUserGroup::destroy($id);
        return redirect()->back()->with('Error', 'Mapping Deleted successfully');
    }
}
