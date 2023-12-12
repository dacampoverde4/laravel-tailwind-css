<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::orderBy('id', 'DESC')->paginate(5);
        return view('admin.pages.index', compact('pages'));
    }

    public function store(Request $request)
    {
         $request->validate([
            'page_title' => 'required|unique:pages',
            'content' => 'required',
            'section' => 'nullable',
            'column' => 'nullable'
        ]);

        $page = new Page;
        $page->page_title = $request->page_title;
        $page->content = $request->content;
        $page->slug = \str_slug($request->page_title);
        $page->section = $request->section;
        $page->column = $request->column;
        // return $page;
        try {
            $page->save();
            return redirect()->route('pages.index')->with('message', 'Page added successfuly.');
        } catch (\Exception $e) {
            return redirect()->route('pages.index')->with('message', 'Page not added successfuly.');
        }
    }

    public function edit($id)
    {
        $page = Page::find($id);
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, $id)
    {
         $request->validate([
            'page_title' => 'required|unique:pages,page_title,'.$id.',id',
            'content' => 'required',
            'section' => 'nullable',
            'column' => 'nullable'
        ]);

        $page = Page::find($id);
        $page->page_title = $request->input('page_title');
        $page->content = $request->input('content');
        $page->slug = \str_slug($request->page_title);
        $page->section = $request->section;
        $page->column = $request->column;
        try {
            $page->save();
            return redirect()->route('pages.index')->with('message', 'Page updated successfuly.');
        } catch (\Exception $e) {
            return redirect()->route('pages.index')->with('message', 'Page not upadated successfuly.');
        }
    }

    public function destroy($id)
    {
        try {
            $page = Page::where('id', $id)->delete();
            return redirect()->back()->with('message', 'Page deleted successfuly.');
        } catch (\Exception $e) {
            return redirect()->back()->with('message', 'Page not deleted successfuly.');
        }

    }

    public function terms()
    {
        $page = Page::findOrFail(config('params.pages.terms'));
        return view('terms', compact('page'));
    }

    public function policy()
    {
        $page = Page::findOrFail(config('params.pages.policy'));
        return view('policy', compact('page'));
    }
    
     public function allPages(Request $request,$slug="")
    {
        $page = Page::where('slug', $slug)->first();
        return view('sample', compact('page'));
    }
}
