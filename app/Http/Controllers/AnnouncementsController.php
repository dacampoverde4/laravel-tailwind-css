<?php

namespace App\Http\Controllers;

use App\Announcements;
use Illuminate\Http\Request;

class AnnouncementsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $announcements = Announcements::all();
        return view('admin.announcements.index', compact('announcements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.announcements.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $announcement = new Announcements;
        $announcement->content = $request->content;
        $announcement->is_sticky = $request->is_sticky ? '1' : '0';
        $announcement->user_ids = '["0"]';
        $announcement->display_annoucement = $request->display;
        $announcement->save();
        return redirect('/admin/announcements')->with('message', 'Announcement Created');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Announcements $announcements
     * @return \Illuminate\Http\Response
     */
    public function show(Announcements $announcements)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Announcements $announcements
     * @return \Illuminate\Http\Response
     */
    public function edit(Announcements $announcements, $id)
    {
        $announcement = Announcements::find($id);
        return view('admin.announcements.edit', compact('announcement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Announcements $announcements
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Announcements $announcements, $id)
    {
        $announcement = Announcements::find($id);
        $announcement->content = $request->content;
        $announcement->is_sticky = $request->is_sticky ? '1' : '0';
         $announcement->is_sticky = $request->is_sticky ? '1' : '0';
        $announcement->display_annoucement = $request->display;
        $announcement->save();
        return redirect()->back()->with('success', 'Announcement Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Announcements $announcements
     * @return \Illuminate\Http\Response
     */
    public function destroy(Announcements $announcements, $id)
    {
        $announcement = Announcements::find($id);
        $announcement->delete();
        return redirect('/admin/announcements')->with('message', 'Announcement Deleted');

    }

}
