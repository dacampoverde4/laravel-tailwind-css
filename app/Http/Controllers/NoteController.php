<?php

namespace App\Http\Controllers;

use App\Note;
use App\Usergroup;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( $groupId )
    {   $usergroups = Usergroup::all();
        $notes = Note::where('user_group', $groupId )->paginate(6);
        return view('admin.note.index', compact('notes','usergroups', 'groupId'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create( $groupId )
    {
        $usergroups = Usergroup::all();
        return view('admin.note.create', compact('usergroups', 'groupId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $note = new Note ;
        $note->note = request('note');
        $note->user_group = $groupId = request('user_group');
        $note->save();
        return redirect("admin/notes/$groupId")->with('success','Note added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note, $groupId, $id)
    {
        $note = Note::find($id);
        return view('admin.note.edit', compact('note', 'groupId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note, $id)
    {
        $note = Note::find($id);
        $note->note = $request->note;
        $note->save();
        return back()->with('success','Note Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note, $id)
    {
        $note = Note::find($id);
        $note->delete();
        return back()->with('success','Note deleted successfully');
    }

}
