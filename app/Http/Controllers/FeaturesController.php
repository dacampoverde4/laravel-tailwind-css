<?php

namespace App\Http\Controllers;

use App\Features;
use Illuminate\Http\Request;
use App\WebsiteSetting;
class FeaturesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $features = Features::all();
        return view('admin.feature.index', compact('features'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.feature.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $feature = new Features;
        $feature->title = $request->title;
        $feature->save();
        return redirect ('admin/features')->with('success','New Feature Inserted');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Features  $features
     * @return \Illuminate\Http\Response
     */
    public function show(Features $features)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Features  $features
     * @return \Illuminate\Http\Response
     */
    public function edit(Features $features, $id)
    {
       $feature = Features::findorfail($id);
       return view('admin.feature.edit',compact('feature'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Features  $features
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Features $features, $id)
    {
        $feature = Features::findorfail($id);
        $feature->title = $request->title;
        $feature->save();
        return back()->with('success','Featured Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Features  $features
     * @return \Illuminate\Http\Response
     */
    public function destroy(Features $features, $id)
    {
        $feature = Features::findorfail($id);
        $feature->delete();
        return back()->with('message','Feature Deleted');
    }
    public function setting($id)
    {
        $feature = Features::find($id);
        $metaData = self::setMetas();
        return view('admin.feature.setting', compact('feature', 'metaData'));
    }
    public function setMetas(){
        $metaDatas = WebsiteSetting::all();
        $newmetaInfo = array();
        if( $metaDatas ){
            foreach( $metaDatas as $metaData ){
                $newmetaInfo[$metaData->meta_key] = $metaData->meta_value;
            }
        }
        return $newmetaInfo;
    }
    
}
