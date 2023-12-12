<?php

namespace App\Http\Controllers;

use DB;
use App\Plan;
use App\Note;
use App\FamilyRole;
use App\Usergroup;
use App\GenderRole;
use App\UsergroupTag;
use App\Questionnaires;
use App\Hud;
use Illuminate\Http\Request;
use Session;

class UsergroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $usergroups = Usergroup::get();
        return view('admin.usergroup.index',compact('usergroups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usergroupstags = UsergroupTag::get();
        $genderrole = GenderRole::get();
        $familyrole = FamilyRole::get();
        $plans = Plan::all();
        $huds = Hud::get();
        return view('admin.usergroup.create', compact('genderrole','familyrole', 'plans','usergroupstags','huds'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'minage' => 'required|numeric',
            'maxage' => 'required|numeric|gt:minage',
            'gender' => 'required|max:255',
            'family' => 'required|max:255',
            'adoption_roles' => 'required|max:255',
            'adoption_request_roles' => 'required|max:255',
            'huds' => 'required|max:255',
            'tags' => 'required',
            'sort' => 'required|numeric'
        ]);
       $usergroup=new Usergroup;
       $usergroup->title=request('title');
       $usergroup->minage=request('minage');
       $usergroup->maxage=request('maxage');
       $usergroup->tags=request('tags');
       $usergroup->sort=request('sort');
       if(request('visible_relationship'))
            $usergroup->visible_relationship = request('visible_relationship');
        else
            $usergroup->visible_relationship = 0;
        if(request('visible_occupation'))
            $usergroup->visible_occupation = request('visible_occupation');
        else
            $usergroup->visible_occupation = 0;
        $usergroup->sort=request('sort');
        if(request('gender')){
            $usergroup->genderrole=json_encode(request('gender'));
        }
        if(request('gender')){
            $usergroup->membership_plans=json_encode(request('plans'));
        }
        if(request('family')){
            $usergroup->family_roles=json_encode(request('family'));
        }
        if(request('adoption_roles')){
            $usergroup->adoption_roles=json_encode(request('adoption_roles'));
        }
        if(request('adoption_request_roles')){
            $usergroup->adoption_request_roles=json_encode(request('adoption_request_roles'));
        }
        if(request('huds')){
            $usergroup->huds=json_encode(request('huds'));
        }
       $usergroup->save();
       return redirect('/admin/usergroup');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Usergroup  $usergroup
     * @return \Illuminate\Http\Response
     */
    public function show(Usergroup $usergroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Usergroup  $usergroup
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usergroupstags = UsergroupTag::get();
        $usergroup=Usergroup::findorfail($id);
        $role = GenderRole::get();
        $frole = FamilyRole::get();
        $plans = Plan::all();
        $huds = Hud::get();
        return view('admin.usergroup.edit',compact('usergroup','role','frole','plans','usergroupstags','huds'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Usergroup  $usergroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'title' => 'required|max:255',
            'minage' => 'required|numeric',
            'maxage' => 'required|numeric|gt:minage',
            'gender' => 'required|max:255',
            'adoption_roles' => 'required|max:255',
            'adoption_request_roles' => 'required|max:255',
            'huds' => 'required|max:255',
            'tags' => 'required',
            'sort' => 'required|numeric',
        ]);

        $usergroup=Usergroup::findorfail($id);
        $usergroup->title=request('title');
        $usergroup->minage=request('minage');
        $usergroup->maxage=request('maxage');
        $usergroup->tags=request('tags');
        $usergroup->sort=request('sort');

        if(request('visible_relationship'))
            $usergroup->visible_relationship = request('visible_relationship');
        else
            $usergroup->visible_relationship = 0;
        if(request('visible_occupation'))
            $usergroup->visible_occupation = request('visible_occupation');
        else
            $usergroup->visible_occupation = 0;
        if(request('gender')){
            $usergroup->genderrole=json_encode(request('gender'));
        }

        if(request('family')){
            $usergroup->family_roles=json_encode(request('family'));
        }

        if(request('gender')){
            $usergroup->membership_plans=json_encode(request('plans'));
        }
        if(request('adoption_roles')){
            $usergroup->adoption_roles=json_encode(request('adoption_roles'));
        }
        if(request('adoption_request_roles')){
            $usergroup->adoption_request_roles=json_encode(request('adoption_request_roles'));
        }
        if(request('huds')){
            $usergroup->huds=json_encode(request('huds'));
        }
        $usergroup->save();
        return redirect('/admin/usergroup');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Usergroup  $usergroup
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usergroup = Usergroup::findorfail($id);
        $usergroup->delete();
        Questionnaires::where('group_id', '=', $id)->delete();
        Note::where('user_group', '=', $id)->delete();
        return redirect('/admin/usergroup');
    }

    public function getGroup( $id ){
        $genderInfo = $response = array();
        $usergroup = Usergroup::findorfail($id);
        if( $usergroup ){
            $genderroles = isset( $usergroup->genderrole )? json_decode( $usergroup->genderrole ) : '';
            if( $genderroles ){
                foreach( $genderroles as $genderroleId ){
                    $gender = GenderRole::find($genderroleId);
                    if( $gender ){
                        $genderInfo[] = array('id' => $genderroleId, 'title' => $gender->title );
                    }
                }
            }
        }
        $response['status'] = true;
        $response['genderInfo'] = $genderInfo;
        return response()->json($response, 200);
    }

      public function getGroupProfile( $id ){
        $genderInfo = $response = array();
        $usergroup = Usergroup::findorfail($id);
        if( $usergroup ){
            $genderroles = isset( $usergroup->genderrole )? json_decode( $usergroup->genderrole ) : '';
            if( $genderroles ){
                foreach( $genderroles as $genderroleId ){
                    $gender = GenderRole::find($genderroleId);
                    if( $gender ){
                        $genderInfo[] = array('id' => $genderroleId, 'title' => $gender->title );
                    }
                }
            }
        }

        return $genderInfo;
    }

    public function browseSearch($id){
        $group = Usergroup::find($id);
        $usergroups = Usergroup::all();
        return view('admin.usergroup.browsesearch',compact('usergroups','group'));
    }
    public function browseStore($id, Request $request){
        $usergroup = Usergroup::find($id);
        if($request->input('searchs')){
            $usergroup->searchs = json_encode($request->input('searchs'));
        }
        $usergroup->save();
        return redirect()->back()->with('message', 'Search Updated');

    }

     public function sortUsergroups(Request $request){

        if($request->get('action') == 'action_sort_usergroups'){
            $position = 1;
            $data = $request->get("data");


            foreach($data as $id){
                DB::table("usergroups")->
                    where("id", $id)->
                    update(array("sort" => $position));
                $position++;
            }
            Session::flash("success","UserGroups order updated Successfully");
        }

    }
    public function userGroupsDrop(Request $request){

        $plan=Usergroup::find($request->group_id);
        $plan_ids=$plan->membership_plans;
        //  print_r(json_decode($plan_ids));die;
            foreach(json_decode($plan_ids) as $plan_id){
                // echo $plan_id;
                $plt=Plan::find($plan_id);
                  $plta[]=$plt;


            }



        //    echo'<pre>';print_r($plta);die;
           return $plta;
    }
}
