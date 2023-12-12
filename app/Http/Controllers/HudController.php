<?php

namespace App\Http\Controllers;

use DB;
use App\Hud;
use Illuminate\Http\Request;
use Session;

class HudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $huds = Hud::get();
      return view('admin.hud.index',compact('huds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.hud.create');
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

     $huds = new Hud;
     $huds->title=request('title');
     $huds->save();

     Session::flash("success","New hud added Successfully");

     return redirect('/admin/hud');
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
      $hud = Hud::findorfail($id);
      return view('admin.hud.edit',compact('hud'));
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

        $hud = Hud::findorfail($id);
        $hud->title=request('title');
        $hud->save();

        Session::flash("success","Hud Updated Successfully");
        return redirect('/admin/hud');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $hud = Hud::findorfail($id);
      $hud->delete();
      Session::flash("success","Hud Deleted Successfully");
      return redirect('/admin/hud');
    }

    public function sortHuds(Request $request){

       if($request->get('action') == 'action_sort_huds'){
           $position = 1;
           $data = $request->get("data");

           foreach($data as $id){
               DB::table("huds")->
                   where("id", $id)->
                   update(array("sort" => $position));
               $position++;
           }

           Session::flash("success","Huds order updated Successfully");
       }
   }
}
