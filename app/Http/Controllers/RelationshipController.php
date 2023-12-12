<?php

namespace App\Http\Controllers;

use App\UsergroupTag;
use App\Usergroup;
use App\Relationship;
use Illuminate\Http\Request;

class RelationshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usergroups_in_relationship = [];
        $relationships = Relationship::all();
        foreach($relationships as $relationship){
            array_push($usergroups_in_relationship ,$relationship->usergroups);
        }
        
        return view('admin.relationships.index', compact('relationships','usergroups_in_relationship'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userGroup = Usergroup::all();
        return view('admin.relationships.create',compact('userGroup'));
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
           'title' => 'required',
           'usergroup' => 'required|max:255'
         ]);
        $relationship = new Relationship;
        $relationship->title = request('title');
        //$relationship->created_at = request('title');
        $relationship->save();
        $relationship->usergroups()->attach(request('usergroup'));
        return redirect('/admin/relationship');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UsergroupTag  $usergroupTag
     * @return \Illuminate\Http\Response
     */
    public function show(UsergroupTag $usergroupTag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UsergroupTag  $usergroupTag
     * @return \Illuminate\Http\Response
     */
    public function edit(Relationship $relationship, $id)
    {
        $sel_usergroup_ids = [];
        $relationship = Relationship::find($id);
        $usergroups_in_relationship = $relationship->usergroups;
        foreach($usergroups_in_relationship as $eachRecord){
            array_push($sel_usergroup_ids, $eachRecord->id);
        }
        $userGroup = Usergroup::all();
        
        return view('admin.relationships.edit', compact('relationship','sel_usergroup_ids','userGroup'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UsergroupTag  $usergroupTag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Relationship $relationship, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'usergroup' => 'required|max:255'
          ]);
         $relationship = Relationship::find($id);
         $relationship->title = request('title');
         //$relationship->created_at = request('title');
         $relationship->save();
         if(request('usergroup')){
            $relationship->usergroups()->detach();
            $relationship->usergroups()->attach(request('usergroup'));
         }
         
         return redirect('/admin/relationship');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UsergroupTag  $usergroupTag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Relationship $relationship, $id)
    {
        $relationship = Relationship::find($id);
        $relationship->delete();
        return redirect ('admin/relationship')->with('message','Relationship Delete');
    }
   
}
