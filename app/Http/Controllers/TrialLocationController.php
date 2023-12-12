<?php

namespace App\Http\Controllers;
use App\TrialLocation;
use DB;
use Session;
use Redirect;
use Illuminate\Http\Request;
use App\Photoalbum;

class TrialLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $triialLocations = TrialLocation::get();
      return view('admin.trialLocation.index',compact('triialLocations'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.trialLocation.create');
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
          'name' => 'required|max:255',
          'description' => 'max:500',
          'address' => 'required|max:255',
          'image' => 'required'
      ]);

     $TrialLocation = new TrialLocation;
     $TrialLocation->name=request('name');
     $TrialLocation->address=request('address');
     $TrialLocation->description=request('description');


     $imageName = time().'.'.$request->file('image')->getClientOriginalExtension();
     $destinationPath = public_path('uploads/location');
     if (!file_exists($destinationPath)) {
        mkdir($destinationPath, 0777, true);
     }
     $request->file('image')->move($destinationPath, $imageName);

     $TrialLocation->image = $imageName;
     $TrialLocation->save();

     Session::flash("message","New Location added Successfully");

     return redirect('/admin/trial-location');
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
      $triallocation = TrialLocation::findorfail($id);
      return view('admin.trialLocation.edit',compact('triallocation'));
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
          'name' => 'required|max:255',
          'description' => 'max:500',
          'address' => 'required|max:255',
          'image' => 'required'
      ]);

     $TrialLocation = TrialLocation::find($id);
     $TrialLocation->name=request('name');
     $TrialLocation->address=request('address');
     $TrialLocation->description=request('description');

     if($request->file('image') != null){
       $imageName = time().'.'.$request->file('image')->getClientOriginalExtension();
       $destinationPath = public_path('uploads/location');
       if (!file_exists($destinationPath)) {
          mkdir($destinationPath, 0777, true);
       }
       $request->file('image')->move($destinationPath, $imageName);

       $TrialLocation->image = $imageName;
     }
     $TrialLocation->save();

     Session::flash("message","Location updated Successfully");

     return redirect('/admin/trial-location');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $TrialLocation = TrialLocation::findorfail($id);
      $TrialLocation->delete();
      Session::flash("message","Location deleted Successfully");
      return redirect('/admin/trial-location');
    }
}
