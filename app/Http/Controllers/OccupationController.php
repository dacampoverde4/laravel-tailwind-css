<?php

namespace App\Http\Controllers;

use App\UsergroupTag;
use App\Usergroup;
use App\Occupation;
use Illuminate\Http\Request;

class OccupationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usergroups_in_occupation = [];
        $occupations = Occupation::all();
        foreach($occupations as $occupation){
            array_push($usergroups_in_occupation ,$occupation->usergroups);
        }
        
        return view('admin.occupations.index', compact('occupations','usergroups_in_occupation'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userGroup = Usergroup::all();
        return view('admin.occupations.create',compact('userGroup'));
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
        $occupation = new Occupation;
        $occupation->title = request('title');
        //$relationship->created_at = request('title');
        $occupation->save();
        $occupation->usergroups()->attach(request('usergroup'));
        return redirect('/admin/occupation');
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
    public function edit(Occupation $occupation, $id)
    {
        $sel_usergroup_ids = [];
        $occupation = Occupation::find($id);
        $usergroups_in_occupation = $occupation->usergroups;
        foreach($usergroups_in_occupation as $eachRecord){
            array_push($sel_usergroup_ids, $eachRecord->id);
        }
        $userGroup = Usergroup::all();
        
        return view('admin.occupations.edit', compact('occupation','sel_usergroup_ids','userGroup'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UsergroupTag  $usergroupTag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Occupation $occupation, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'usergroup' => 'required|max:255'
          ]);
         $occupation = Occupation::find($id);
         $occupation->title = request('title');
         //$relationship->created_at = request('title');
         $occupation->save();
         if(request('usergroup')){
            $occupation->usergroups()->detach();
            $occupation->usergroups()->attach(request('usergroup'));
         }
         
         return redirect('/admin/occupation');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UsergroupTag  $usergroupTag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Occupation $occupation, $id)
    {
        $occupation = Occupation::find($id);
        $occupation->delete();
        return redirect ('admin/occupation')->with('message','Occupation Delete');
    }
   
}
