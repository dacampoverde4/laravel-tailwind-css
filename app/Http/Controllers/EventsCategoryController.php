<?php

namespace App\Http\Controllers;
use App\Events;
use App\EventCategory;
use Illuminate\Http\Request;
class EventsCategoryController extends Controller
{
	public function index(){
        $categories = EventCategory::all();
        return view('admin.events.category.index', compact('categories'));
    }
    public function create(){
        return view('admin.events.category.create');
    }
    public function store(Request $request){
        $this->validate($request, [
            'title' => 'required',
        ]);

        $category = new EventCategory;

        $category->term_name = $request->input('title');
        $category->term_description = $request->input('description');

        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images/events/');
            $image->move($destinationPath, $name);
            $category->term_image = $name;
          }


          $category->save();
    return back()->with('success','category Created');
    }
    public function edit($id, Request $request){
        $category = EventCategory::find($id);
        return view('admin.events.category.edit', compact('category'));
        
    }
    public function update($id, Request $request){
        $category = EventCategory::find($id);
        $category->term_name = $request->input('title');
        $category->term_description = $request->input('description');

        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images/events/');
            $image->move($destinationPath, $name);
            $category->term_image = $name;
          }


          $category->save();
    return back()->with('success','Category Created');
    }
    public function delete($id){
        $deletecategory = EventCategory::find($id); 
        $deletecategory->delete();

        return back()->with('success','Category Deleted');
    }
}