<?php

namespace App\Http\Controllers;

use DB;
use App\EthnicityGroup;
use Illuminate\Http\Request;
use Session;

class EthnicityGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $ethnicitygroups = EthnicityGroup::get();
      return view('admin.ethnicityGroup.index',compact('ethnicitygroups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ethnicityGroup.create');
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
      ]);

     $EthnicityGroup = new EthnicityGroup;
     $EthnicityGroup->title=request('title');
     $EthnicityGroup->save();

     Session::flash("success","New ethnicity group added Successfully");

     return redirect('/admin/ethnicity-group');
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
      $ethnicitygroup = EthnicityGroup::findorfail($id);
      return view('admin.ethnicityGroup.edit',compact('ethnicitygroup'));
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
        ]);

        $ethnicitygroup = EthnicityGroup::findorfail($id);
        $ethnicitygroup->title=request('title');
        $ethnicitygroup->save();

        Session::flash("success","Ethnicity group Updated Successfully");
        return redirect('/admin/ethnicity-group');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $ethnicitygroup = EthnicityGroup::findorfail($id);
      $ethnicitygroup->delete();
      Session::flash("success","Ethnicity group Deleted Successfully");
      return redirect('/admin/ethnicity-group');
    }

    public function sortEthnicityGroups(Request $request){

       if($request->get('action') == 'action_sort_ethnicitygroups'){
           $position = 1;
           $data = $request->get("data");
           foreach($data as $id){
               DB::table("ethnicity_groups")->
                   where("id", $id)->
                   update(array("sort" => $position));
               $position++;
           }
           Session::flash("success","Ethnicity groups order updated Successfully");
       }
   }
}
