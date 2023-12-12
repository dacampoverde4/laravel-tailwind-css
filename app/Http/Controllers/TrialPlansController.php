<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plan;
use App\trialPlans;
use App\Usergroup;
use App\userGroupPlan;
class TrialPlansController extends Controller
{


     public function __construct()
    {
        $this->middleware('auth');
        /*\Stripe\Stripe::setApiKey(env("STRIPE_SECRET"));*/
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $trialPlan = trialPlans::with('Allplans','trailGroups')->get();
       $group = Usergroup::all();
       $plan = Plan::where('status',1)->get();
        return view('admin.trialPlans.index',compact(['trialPlan','group','plan']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $plans = Plan::where('status','1')->get();
        $user_group = Usergroup::orderBy('id', 'ASC')->get();
        return view('admin.trialPlans.create',compact(['plans','user_group']));
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
            'title' => 'required',
            'subscription_id' => 'required',
            'days' => 'required|numeric',
            'user_group_id' => 'required',
        ]);
        try {
                $trial_plan = new trialPlans;
                $trial_plan->title = $request->input('title');
                $trial_plan->subscription_id = $request->input('subscription_id');
                $trial_plan->days = $request->input('days');
                $trial_plan->save();
                
                foreach($request->input('user_group_id') as $groupIds){
                    if(userGroupPlan::where('user_group_id',$groupIds)->exists()){
                        return redirect()->to('admin/trialPlans')->with('success', 'user Group already Exists');
                     }else{
                        $group_plan = new userGroupPlan;
                        $group_plan->trial_plan_id = $trial_plan->id; 
                        $group_plan->user_group_id = $groupIds;
                        $group_plan->save();
                    }

                }
                
        } catch (Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage());
       }
         return redirect()->to('admin/trialPlans')->with('success', 'Trial Plan created successfully');
        
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

      
        $trial_plan = trialPlans::with(['trailGroups'])->find($id);
        $plan = Plan::where('status',1)->get();
        $user_group = Usergroup::all();
      return view('admin.trialPlans.edit',compact(['trial_plan','plan','user_group']));
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
        $updateTrialPlan = trialPlans::find($id);
        $updateTrialPlan->title = $request->input('title');
        $updateTrialPlan->subscription_id = $request->input('subscription_id');
        $updateTrialPlan->days = $request->input('days');
        $groupid = $request->input('user_group_id');
        
        $group_plan_id = userGroupPlan::where('trial_plan_id',$id)->pluck('user_group_id')->toArray();
        
        $arrayDiff = array_diff($groupid,$group_plan_id);
        $arrayDiffDelet = array_diff($group_plan_id,$groupid);

        if(!empty($arrayDiff)){
            foreach($arrayDiff as $new){

            $data = new userGroupPlan;
            $data->trial_plan_id = $id;
            $data->user_group_id = $new;
            $data->save()   ;

            }
        }
        $deleteId = userGroupPlan::where('trial_plan_id',$id)->whereIn('user_group_id',$arrayDiffDelet)->delete();
    
        return redirect()->to('admin/trialPlans');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$id) {
            return redirect()->back()->with('failed', 'Invalid Request');
        }
        try {
            $data = trialPlans::find($id);
            $data->delete();
            
            
        } catch (Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage());
        }
        return redirect()->to('admin/trialPlans')->with('success', ' deleted successfully');
    }

    public function updateStatus(Request $request){
        $status = trialPlans::find($request->id);
        $status->status = $request->status;
        $status->save();


        /*$status =  trialPlans::where('status',1)->update(array('status' => 0));
        $status = trialPlans::find($request->id);
        $status->status = $request->status;
        $status->save(); */

        /*if($status->status == 1){
            $status->status = 0;  

        }
        else{
           
             $status->status = 1;  
        }*/
        
        return response()->json(['success'=>'status updated successfully']);
    }
    
}
