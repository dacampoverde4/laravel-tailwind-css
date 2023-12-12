<?php

namespace App\Http\Controllers;

use App\Agegroup;
use Illuminate\Http\Request;
use DB;

class AgegroupController extends Controller
{
/**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */
public function index()
{
    $age = DB::table('agegroups')->get();
    return view('age.agegroup',compact('age'));
}

/**
 * Show the form for creating a new resource.
 *
 * @return \Illuminate\Http\Response
 */
public function create()
{
   return view('age.create');
}

/**
 * Store a newly created resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
public function store(Request $request)
{
    $age= new Agegroup ;

    $age->age = request('age');
    $age->usergroup=request('usergroup');
    $age->save();
    return redirect('agegroup');

}

/**
 * Display the specified resource.
 *
 * @param  \App\Agegroup  $agegroup
 * @return \Illuminate\Http\Response
 */
public function show(Agegroup $agegroup)
{
    //
}

/**
 * Show the form for editing the specified resource.
 *
 * @param  \App\Agegroup  $agegroup
 * @return \Illuminate\Http\Response
 */
public function edit($id)
{
    $age= Agegroup::findorfail($id);
    return view('age.edit',compact('age'));
}

/**
 * Update the specified resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  \App\Agegroup  $agegroup
 * @return \Illuminate\Http\Response
 */
public function update(Request $request, $id)
{
    $age= Agegroup::findorfail($id);

    $age->age = request('age');
    $age->usergroup=request('usergroup');
    $age->save();

    return redirect('agegroup');
}

/**
 * Remove the specified resource from storage.
 *
 * @param  \App\Agegroup  $agegroup
 * @return \Illuminate\Http\Response
 */
public function destroy($id)
{
    $age= Agegroup::findorfail($id);
    $age->delete();
    return redirect('agegroup');
}
}
