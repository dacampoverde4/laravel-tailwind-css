<?php

namespace App\Http\Controllers;

use App\WordsSecurity;
use Illuminate\Http\Request;

class WordsSecurityController extends Controller
{
    public function index()
    {
        $words = WordsSecurity::all();
        return view('admin.wordsecurity.index', compact('words'));
    }


    public function create()
    {
        return view('admin.wordsecurity.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
           'title' => 'required'
         ]);
         
        $word = new WordsSecurity;
        $word->title = $request->input('title');
        $word->save();
        return redirect ('admin/words')->with('message','Word Created');
    }



    public function edit(WordsSecurity $wordsSecurity, $id)
    {
        $word = WordsSecurity::find($id);
        return view('admin.wordsecurity.edit', compact('word'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tags  $tags
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WordsSecurity $wordsSecurity, $id)
    {
        $this->validate($request, [
           'title' => 'required'
         ]);
         
        $word = WordsSecurity::find($id);
        $word->title = $request->input('title');
        $word->save();
        return redirect ('admin/words')->with('message','Word Updated');
    }


    public function destroy(WordsSecurity $wordsSecurity, $id)
    {
        $word = WordsSecurity::find($id);
        $word->delete();
        return redirect ('admin/words')->with('message','Word Delete');
    }
}
