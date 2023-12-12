<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\MatchQuestCategory;
use Illuminate\Support\Str;
use File;

class MatchQuestCategoryController extends Controller
{
    //Get all MatchQuestCategorys
    public function index(){
        $match_quest_categories = MatchQuestCategory::all();
        return view('admin.questionnaires.categories.show_all_match_quest_categories',compact('match_quest_categories'));
    }

    //Load create MatchQuestCategory page
    public function create(){
        return view('admin.questionnaires.categories.create_match_quest_category');
    }

    //Create MatchQuestCategory
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:match_quest_categories|max:100|regex:/(^[A-Za-z ]+$)+/',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $db_image_name = '';
        if ($request->has('banner')) {
            $image = $request->file('banner');
            $db_image_name = 'assets/images/match_quest_categoies/';
            $imagename = Str::random(10).'_'.time().'_.'.$image->getClientOriginalExtension();
            $db_image_name = $db_image_name.$imagename;
            $destinationPath = public_path('/assets/images/match_quest_categoies/');
            $image->move($destinationPath, $imagename);
        }
        $match_quest_category_obj = new MatchQuestCategory();
        $match_quest_category_obj->name = $request->name;
        $match_quest_category_obj->slug = preg_replace('/\s+/', '_', strtolower($request->name));
        $match_quest_category_obj->description = $request->description;
        $match_quest_category_obj->banner = $db_image_name;
        $match_quest_category_obj->save();

        return redirect()->route('matchquestcategories.index')->with('success', 'Match Quest Category created Successfully !!');
    }

    //View MatchQuestCategory
    public function show(MatchQuestCategory $matchquestcategory){
        return view('admin.questionnaires.categories.view_match_quest_category')->with('matchquestcategory', $matchquestcategory);
    }    

    //Load edit MatchQuestCategory page
    public function edit(MatchQuestCategory $matchquestcategory){
        return view('admin.questionnaires.categories.edit_match_quest_category', compact('matchquestcategory'));
    }

    //Update info for MatchQuestCategory
    public function update(Request $request, MatchQuestCategory $matchquestcategory){
		$validator = Validator::make($request->all(), [
            'name' => 'required|unique:match_quest_categories,name,'.$matchquestcategory->id.'|max:100|regex:/(^[A-Za-z ]+$)+/',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        if ($request->has('banner')) {
            $image_path = public_path()."/".$matchquestcategory->banner;
            if(!empty($matchquestcategory->banner) && File::exists($image_path)) {
                File::delete($image_path);
            }
            $image = $request->file('banner');
            $db_image_name = 'assets/images/match_quest_categoies/';
            $imagename = Str::random(10).'_'.time().'_.'.$image->getClientOriginalExtension();
            $db_image_name = $db_image_name.$imagename;
            $destinationPath = public_path('/assets/images/match_quest_categoies/');
            $image->move($destinationPath, $imagename);
            $matchquestcategory->banner = $db_image_name;
        }
        if($request->remove_existing_image){
            $image_path = public_path()."/assets/images/match_quest_categoies/".$matchquestcategory->banner;
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
            $matchquestcategory->banner = "";
        }
        $matchquestcategory->name = $request->name;
        $matchquestcategory->slug = preg_replace('/\s+/', '_', strtolower($request->name));
        $matchquestcategory->description = $request->description;
        $matchquestcategory->save();

        return redirect()->back()->with('success', 'Match Quest Category updated Successfully !!');
    }

    //Delete MatchQuestCategory
    public function destroy(MatchQuestCategory $matchquestcategory){
        return redirect()->back()->with("success", "Match Quest Category Deleted Successfully !!");
    }
}
