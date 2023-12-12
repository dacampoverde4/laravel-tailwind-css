<?php

namespace App\Http\Controllers;

use App\Species;
use Illuminate\Http\Request;

class SpeciesController extends Controller
{


    public function __construct()
    {

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        $species = Species::orderBy('id','asc')->get();
        return view('admin.species.index',compact('species'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return view('admin.species.create');
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
                'species_name' => 'required|max:255',
            ],
            [
                'species_name.required'  => 'Please provide species name.'
            ]
        );

        $species = new Species ;
        $species->name = request('species_name');
        $species->save();
        return redirect('admin/species')->with('success','Species created successfully.');

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Roles  $roles
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $species = Species::findorfail($id);
        return view('admin.species.edit',compact('species'));

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Roles  $roles
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $this->validate($request, [
                'species_name' => 'required|max:255',
            ],
            [
                'species_name.required'  => 'Please provide species name.'
            ]
        );
        $species = Species::findorfail($id);
        $species->name = request('species_name');
        $species->save();
        return back()
            ->with('success','Species updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $species = Species::findorfail($id);
        $species->delete();
        return back()
            ->with('success','Species deleted successfully.');
    }


}
