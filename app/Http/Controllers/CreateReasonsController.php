<?php

namespace App\Http\Controllers;
use App\CreateReasons;
use DB;
use Session;
use Redirect;

use Illuminate\Http\Request;

class CreateReasonsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $trialReasons = CreateReasons::get();
      return view('admin.trialReasons.index',compact('trialReasons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.trialReasons.create');
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
          'sort'  => 'required',
          'status'  => 'required'
      ]);

     $CreateReasons = new CreateReasons;
     $CreateReasons->title=request('title');
     $CreateReasons->sort=request('sort');
     $CreateReasons->status=request('status');
     $CreateReasons->save();

     Session::flash("message","New Trial Reason added Successfully");
     return redirect('/admin/trial-reasons');

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
      $CreateReasons = CreateReasons::findorfail($id);
      return view('admin.trialReasons.edit',compact('CreateReasons'));
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
          'sort'  => 'required',
          'status' => 'required'
      ]);

     $CreateReasons = CreateReasons::find($id);
     $CreateReasons->title = request('title');
     $CreateReasons->sort = request('sort');
     $CreateReasons->status=request('status');
     $CreateReasons->save();
     Session::flash("message","Trial Reason updated Successfully");
     return redirect('/admin/trial-reasons');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $CreateReasons = CreateReasons::findorfail($id);
      $CreateReasons->delete();
      Session::flash("message","Trial Reason deleted Successfully");
      return redirect('/admin/trial-reasons');
    }
}
