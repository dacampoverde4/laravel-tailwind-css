<?php

namespace App\Http\Controllers;

use App\MyFun;
use Illuminate\Http\Request;

class MyFunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $myfuns = MyFun::all();
        return view('admin.myfun.index', compact('myfuns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.myfun.create');
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
         
        $tag = new MyFun;
        $tag->title = $request->input('title');
        $tag->save();
        return redirect ('admin/myfun')->with('message','Tag Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MyFun  $myFun
     * @return \Illuminate\Http\Response
     */
    public function show(MyFun $myFun)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MyFun  $myFun
     * @return \Illuminate\Http\Response
     */
    public function edit(MyFun $myFun, $id)
    {
        $myfun = MyFun::find($id);
        return view('admin.myfun.edit', compact('myfun'));
        //return view('admin.new.myfun.edit', compact('myfun'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MyFun  $myFun
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MyFun $myFun, $id)
    {
        $this->validate($request, [
           'title' => 'required'
         ]);
         
        $myfun = MyFun::find($id);
        $myfun->title = $request->input('title');
        $myfun->save();
        return redirect ('admin/myfun')->with('message','Tag Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MyFun  $myFun
     * @return \Illuminate\Http\Response
     */
    public function destroy(MyFun $myFun, $id)
    {
        $tag = MyFun::find($id);
        $tag->delete();
        return redirect ('admin/myfun')->with('message','Tag Delete');
    }
}
