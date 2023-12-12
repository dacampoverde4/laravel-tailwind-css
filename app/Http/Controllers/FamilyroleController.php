<?php

namespace App\Http\Controllers;
use App\FamilyRole;
use DB;
use Session;
use Redirect;
use Illuminate\Http\Request;

class FamilyroleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $familyRoles = FamilyRole::get();
      return view('admin.familyrole.index',compact('familyRoles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.familyrole.create');
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
          'gender' => 'required|max:255',
          'sort' => 'required|numeric'
      ]);
     $FamilyRole = new FamilyRole;
     $FamilyRole->title=request('title');
     $FamilyRole->gender=request('gender');
     $FamilyRole->sort=request('sort');
     $FamilyRole->save();

     Session::flash("success","New family role added Successfully");

     return redirect('/admin/family-role');
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
      $familyrole = FamilyRole::findorfail($id);
      return view('admin.familyrole.edit',compact('familyrole'));
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
          'gender' => 'required|max:255',
          'sort' => 'required|numeric'
        ]);
        $familyrole = FamilyRole::findorfail($id);
        $familyrole->title=request('title');
        $familyrole->gender=request('gender');
        $familyrole->sort=request('sort');
        $familyrole->save();

        Session::flash("success","Family role Updated Successfully");
        return redirect('/admin/family-role');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $familyrole = FamilyRole::findorfail($id);
      $familyrole->delete();
      Session::flash("success","Family role Deleted Successfully");
      return redirect('/admin/family-role');
    }

    public function sortFamilyRoles(Request $request){

       if($request->get('action') == 'action_sort_familyroles'){
           $position = 1;
           $data = $request->get("data");
           foreach($data as $id){
               DB::table("family_roles")->
                   where("id", $id)->
                   update(array("sort" => $position));
               $position++;
           }
           Session::flash("success","Family Roles order updated Successfully");
       }
   }
}
