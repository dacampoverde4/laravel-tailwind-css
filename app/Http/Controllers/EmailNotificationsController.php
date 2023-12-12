<?php

namespace App\Http\Controllers;

use App\EmailNotifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmailNotificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$emails = EmailNotifications::all();
        return view('admin.emails.index', compact('emails'));
    }


    public function edit($id, EmailNotifications $emailNotifications)
    {
        $email = EmailNotifications::find($id);
		$my_file = base_path().'/resources/views/emails/'.$email->title.'.blade.php';
		$content = file_get_contents($my_file,true);
		return view('admin.emails.edit', compact('email','content'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmailNotifications  $emailNotifications
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request, EmailNotifications $emailNotifications){
		//dd($request->all());
		$request->validate([
            'subject' => 'required',
			'content' => 'required',
    
        ]);
        $email = EmailNotifications::find($id);
		$email->subject = $request->input('subject');
		$email->content = $request->input('content');
		$email->save();
		
		$my_file = base_path().'/resources/views/emails/'.$email->title.'.blade.php';
		//echo file_get_contents($my_file,true);
		
		//echo $handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);
		$file = fopen($my_file,"w");
 fwrite($file,$email->content);
fclose($file);
return back()->with('success','Email template Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmailNotifications  $emailNotifications
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmailNotifications $emailNotifications)
    {
        //
    }
}
