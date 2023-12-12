<?php

namespace App\Http\Controllers\Admin;

use App\Models\Terminal_info;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class TerminalInfosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $terminals = Terminal_info::all();
        return view('admin.terminal.index', compact('terminals'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.terminal.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Terminal_info $terminal)
    {
        $validator = Validator::make($request->all(), [
            'terminal_id' => 'required|unique:terminal_infos,terminal_id,'.$terminal->id.',id',
            'parcel_name' => 'required',
            'region_name' => 'required',
            'status' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
       $terminal = new Terminal_info;
       $terminal->terminal_id =  $request->terminal_id;
       $terminal->parcel_name = $request->parcel_name;
       $terminal->region_name=  $request->region_name;
       $terminal->x=  $request->x;
       $terminal->y=  $request->y;
       $terminal->z=  $request->z;
       $terminal->status = $request->status;
       $terminal->save();
       return redirect()->route('terminal.index')->with('message', 'Terminal added successfuly.');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $terminal = Terminal_info::find($id);
        return view('admin.terminal.edit', compact('terminal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $terminal = Terminal_info::find($id);
       $terminal->terminal_id =  $request->terminal_id;
       $terminal->parcel_name = $request->parcel_name;
       $terminal->region_name=  $request->region_name;
       $terminal->x=  $request->x;
       $terminal->y=  $request->y;
       $terminal->z=  $request->z;
       $terminal->status = $request->status;
       $terminal->save();
       return redirect()->back()->with('success','Terminal updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        try {
            $terminal = Terminal_info::destroy($id);
            return redirect()->back()->with('message', 'Terminal deleted successfuly.');
        } catch (\Exception $e) {
            return redirect()->back()->with('message', 'Terminal not deleted successfuly.');
        }
    }
}
