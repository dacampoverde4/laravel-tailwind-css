<?php

namespace App\Http\Controllers;

use DB;
use App\SeekingRole;
use App\FamilyRole;
use App\Usergroup;
use Illuminate\Http\Request;
use Session;

class SeekingroleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $seekingroles = SeekingRole::get();
      $familyroles = FamilyRole::get();
      $usergroups = Usergroup::get();
      return view('admin.seekingrole.index',compact('seekingroles','familyroles','usergroups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $familyroles = FamilyRole::get();
        $usergroups = Usergroup::get();
        return view('admin.seekingrole.create', compact('familyroles', 'usergroups'));
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
          'seeking_roles' => 'required|max:255',
          'family_roles' => 'required|max:255',
          'usergroups' => 'required|max:255',
          'minage' => 'required|integer|between:1,99',
          'maxage' => 'required|integer|between:1,99',
      ]);

     $SeekingRole = new SeekingRole;
     $SeekingRole->title=request('title');
     if(request('seeking_roles')){
         $SeekingRole->seeking_roles=json_encode(request('seeking_roles'));
     }
     if(request('family_roles')){
         $SeekingRole->family_roles=json_encode(request('family_roles'));
     }
     if(request('usergroups')){
         $SeekingRole->usergroups=json_encode(request('usergroups'));
     }
     $SeekingRole->minage = request('minage');
     $SeekingRole->maxage = request('maxage');

     $SeekingRole->save();

     Session::flash("success","New seeking role added Successfully");

     return redirect('/admin/seeking-role');
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
      $seekingrole = SeekingRole::findorfail($id);
      $familyroles = FamilyRole::get();
      $usergroups = Usergroup::get();
      return view('admin.seekingrole.edit',compact('seekingrole','familyroles','usergroups'));
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
        $this->validate($request, [
          'title' => 'required|max:255',
          'seeking_roles' => 'required|max:255',
          'family_roles' => 'required|max:255',
          'usergroups' => 'required|max:255',
           'minage' => 'required|integer|between:1,99',
          'maxage' => 'required|integer|between:1,99',
        ]);

        $seekingrole = SeekingRole::findorfail($id);
        $seekingrole->title=request('title');

        if(request('seeking_roles')){
            $seekingrole->seeking_roles=json_encode(request('seeking_roles'));
        }
        if(request('family_roles')){
            $seekingrole->family_roles=json_encode(request('family_roles'));
        }
        if(request('usergroups')){
            $seekingrole->usergroups=json_encode(request('usergroups'));
        }
        $seekingrole->minage = request('minage');
        $seekingrole->maxage = request('maxage');
        $seekingrole->save();

        Session::flash("success","Seeking role Updated Successfully");
        return redirect('/admin/seeking-role');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $seekingrole = SeekingRole::findorfail($id);
      $seekingrole->delete();
      Session::flash("success","Seeking role Deleted Successfully");
      return redirect('/admin/seeking-role');
    }

    public function sortSeekingRoles(Request $request){

       if($request->get('action') == 'action_sort_seekingroles'){
           $position = 1;
           $data = $request->get("data");
           foreach($data as $id){
               DB::table("seeking_roles")->
                   where("id", $id)->
                   update(array("sort" => $position));
               $position++;
           }
           Session::flash("success","Seeking Roles order updated Successfully");
       }
   }
}
