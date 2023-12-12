<?php

namespace App\Http\Controllers;

use App\UserApply;
use App\ApplyJob;
use App\ApplyForm;
use Illuminate\Http\Request;
use Kordy\Ticketit\Models\Category;
use Illuminate\Support\Facades\DB;
class UserApplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('userapply', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
	

					$job_id=$_POST['job_id'];
					$job_title=$_POST['job_title'];
					
						$job=new ApplyJob;	
				$job->job_id =$job_id;
				$job->job_title=$job_title;
				$job->save();
				$job->id;
				$form_id=$job->id;
					
				foreach($_POST as $key => $value){
				if($key !='_token' && $key !='submit' && $key !='job_id' && $key !='job_title'){
				
				$form=new ApplyForm;
				$form->field =$key;
				$form->value =$value;	
				$form->field_id=$form_id;
				$form->save();
				}
				
		}
		

        return redirect()->back()->with('message', 'Thanks for Apply, we will contact you');
        
    }
    
    // Display applicants in admin
    public function displayApplicants()
    {
        $alldata = ApplyJob::all();
        return view('admin.userapply.index', compact('alldata'));
    }
    // delete applicant from admin
	   public function view(ApplyForm $ApplyForm, $id)
    {
		
		//echo"rggg"; die ;
        $job = ApplyForm::where('field_id', '=', $id)->get();
        $tags='';
        $categories='';
		//echo"<pre>"; print_r($job); die ;
        return view('admin.userapply.view', compact('job','tags','categories'));
    }
    public function deleteApplicant($id)
    {
		
		
        $applicant = UserApply::findorfail($id);
        $applicant->delete();
		 $job = ApplyForm::where('field_id', '=', $id)->delete();
        return redirect()->back()->with('message', 'Successfully Deleted');
    }
}
