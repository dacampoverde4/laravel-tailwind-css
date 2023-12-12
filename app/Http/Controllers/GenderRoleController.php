<?php

namespace App\Http\Controllers;

use App\GenderRole;
use Illuminate\Http\Request;
use DB;

class GenderRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $gender = GenderRole::get();
        return view('admin.gender',compact('gender'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.gendercreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $gender= new GenderRole ;
        $gender->title = request('title');
        $gender->gender = request('gender');
        $gender->save();
        return redirect('admin/gender')->with('success','Gender created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GenderRole  $genderRole
     * @return \Illuminate\Http\Response
     */
    public function show(GenderRole $genderRole)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GenderRole  $genderRole
     * @return \Illuminate\Http\Response
     */
    public function edit(GenderRole $genderRole,$id)
    {
        $gender= GenderRole::findorfail($id);
        return view('admin.genderedit',compact('gender'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GenderRole  $genderRole
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $gender= GenderRole::findorfail($id);
        $gender->title = request('title');
        $gender->gender = request('gender');
        $gender->save();
        return back()
            ->with('success','Gender updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GenderRole  $genderRole
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gender= GenderRole::findorfail($id);
        $gender->delete();
        return redirect('/admin/gender');
    }
}
