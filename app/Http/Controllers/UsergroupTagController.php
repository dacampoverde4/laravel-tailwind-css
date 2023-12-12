<?php

namespace App\Http\Controllers;

use App\UsergroupTag;
use Illuminate\Http\Request;

class UsergroupTagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = UsergroupTag::all();
        return view('admin.usergroup.tags.index', compact('tags'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.usergroup.tags.create');
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
           'title' => 'required'
         ]);
        $tag = new UsergroupTag;
        $tag->title = $request->input('title');
        $tag->primary_color = $request->input('primary_color');
        $tag->secondary_color = $request->input('secondary_color');
        $tag->save();
        return redirect ('admin/usergroup/tags')->with('message','Tag Created');
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
    public function edit(UsergroupTag $usergroupTag, $id)
    {
        $tag = UsergroupTag::find($id);
        return view('admin.usergroup.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UsergroupTag  $usergroupTag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UsergroupTag $usergroupTag, $id)
    {
        $this->validate($request, [
           'title' => 'required',
         ]);
         
        $tag = UsergroupTag::find($id);
        $tag->title = $request->input('title');
        $tag->primary_color = $request->input('primary_color');
        $tag->secondary_color = $request->input('secondary_color');
        $tag->save();
        return redirect ('admin/usergroup/tags')->with('message','Tag Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UsergroupTag  $usergroupTag
     * @return \Illuminate\Http\Response
     */
    public function destroy(UsergroupTag $usergroupTag, $id)
    {
        $tag = UsergroupTag::find($id);
        $tag->delete();
        return redirect ('admin/usergroup/tags')->with('message','Tag Delete');
    }
   
}
