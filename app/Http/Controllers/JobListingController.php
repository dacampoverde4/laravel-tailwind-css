<?php

namespace App\Http\Controllers;

use App\JobListing;
use App\Tags;
use App\Category;
use App\Form;
use App\User;
use App\FormOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
class JobListingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = JobListing::all();
		return view('admin.jobs.index', compact('jobs'));

    }
	
	  public function forms()
    {
        $forms = Form::all();
	    $form = DB::table('forms')->join('categories', 'forms.category_id', '=', 'categories.id')->select('forms.category_id', 'categories.id', 'categories.category_name')->groupBy('category_name')->get();
			//echo"<pre>"; print_r($form); die ;
			  // $form = Category::all();
			
        return view('admin.jobs.formsview', compact('forms','form'));
    }
	 public function formscreate()
    {
        $jobs = JobListing::all();
		  $categories = Category::all();
		   $allTypeInput = $this->getAllTypesInput();
        return view('admin.jobs.form', compact('jobs','categories','allTypeInput'));
    }
	
  public function category()
    {
        $jobs = Category::all();
        return view('admin.jobs.categories', compact('jobs'));
    } 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tags::all();
		 $categories = Category::all();
        return view('admin.jobs.create', compact('tags','categories'));
    }
	
	public function getAllTypesInput(){
		return array(
			'' => "Please Select",
			'text' => "Text",
			'email' => "Email",
			'password' => 'Password',
			'radio' => 'Radio',
			'checkbox' => 'Checkbox',
			'textarea' => 'Text-Area',
			'select' => 'Dropdown',
			'file' => 'File',
			'number' => 'Number',
		);
	}

  public function createcategories()
    {
        $tags = Tags::all();
        return view('admin.jobs.createcategories', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
	//echo"<pre>"; print_r($_POST); die ;
       $this->validate($request, [
           'title' => 'required',
           'description' => 'required',
           'company_name' => 'required',
           'location' => 'required|url',
           'job_type' => 'required',
		   'category' => 'required',
           'salary' => 'required'
       ],
       [
           'location.url' => 'Please enter valid url, must start with http.'
       ]);
        //$imageName = time().'.'.$request->file->getClientOriginalExtension();
       if($request->file('image') != ''){
    		$file = $request->file('image');
    		$name = $file->getClientOriginalName();
    		//$request->file->move(public_path('uploads'), $name);
    		$file->move(public_path('uploads') , $name);
        }else{
           $name=''; 
        }
        $tag = new JobListing;
		$tag->image = $name;
        $tag->title = $request->input('title');
        $tag->description = $request->input('description');
        $tag->company_name = $request->input('company_name');
		$tag->category = $request->input('category');
		
        $tag->job_type = $request->input('job_type');
        $tag->salary = $request->input('salary');
        $tag->salary_type = $request->input('salary_type');
        $tag->location = $request->input('location');
        if( request('tags') ){
            $tag->tag_title =json_encode(request('tags'));
        }
        $tag->save();
        return redirect ('admin/jobs')->with('message','Job Created');
    }

   public function storecategories(Request $request)
    {
       $this->validate($request, [
           'title' => 'required'
          
       ]);

        $tag = new Category;
		
		
        $tag->category_name = $request->input('title');
		
        $tag->save();
        return redirect ('admin/jobs/categories')->with('message','Category Created');
    }

  public function storeforms(Request $request)
    {
	
		//echo"<pre>"; print_r($_POST); die ;
       $this->validate($request, [
              'category' => 'required'
          
       ]);
	   $categories=$request->input('category');
		$fullData = $request->input('data');
		foreach($fullData['label'] as $_dataKey => $_dataValue){
			$inputLabel = $_dataValue;
			$inputType = $fullData['type'][$_dataKey];
			$inputinstruction = $fullData['name'][$_dataKey];
			$forms = new Form;
			$forms->category_id = $categories;
			$forms->label = $inputLabel;
			$forms->type = $inputType;
			if(!empty($inputinstruction)){
			$forms->instruction = $inputinstruction;
			}
			 $forms->name = strtolower($inputLabel);
			$forms->save();
			$formid=$forms->id;
			$inputName= strtolower($inputLabel);
			
			if($inputType == 'select' ||$inputType == 'radio' ||$inputType == 'checkbox'){
				$fullDataoptions = $request->input('options');
				foreach($fullDataoptions[$inputType][$inputName] as $_dataKey => $_dataValue){
					//echo "<pre>"; print_r($_dataValue); die;
				$formoption =new FormOption;
				$formoption->label = $_dataValue;
				$formoption->field_id =$formid;
				$formoption->save();
					
				}
			}
		}
		
        
		
		
		   // if( request('label') ){
            // $forms->label =json_encode(request('label'));
        // }
		  // if( request('type') ){
            // $forms->type =json_encode(request('type'));
        // }
		  // if( request('name') ){
            // $forms->name =json_encode(request('name'));
        // }

		
        $forms->save();
        return redirect ('admin/jobs/forms')->with('message','Form Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\JobListing  $jobListing
     * @return \Illuminate\Http\Response
     */
    public function show(JobListing $jobListing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JobListing  $jobListing
     * @return \Illuminate\Http\Response
     */
    public function edit(JobListing $jobListing, $id)
    {
		
		 $categories = Category::all();
        $tags = Tags::all();
        $job = JobListing::find($id);
        return view('admin.jobs.edit', compact('job','tags','categories'));
    }
	
	   /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Form  $Form
     * @return \Illuminate\Http\Response
     */
    public function formedit(Form $Form, $id)
    {
		$categories = Category::all();
		// $job = Form::find(23);
		$job = Form::where('category_id', '=', $id)->get();
		$cateId = $job[0]->category_id;
		$allTypeInput = $this->getAllTypesInput();
		return view('admin.jobs.formedit', compact('job','tags','categories', 'cateId', 'allTypeInput'));
    }

/**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $Category
     * @return \Illuminate\Http\Response
     */
    public function categoriesedit(Category $Category, $id)
    {
		 $tags = Tags::all();
        $job = Category::find($id);
        return view('admin.jobs.categoriesedit', compact('job','tags'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JobListing  $jobListing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobListing $jobListing, $id)
    {
		//echo"<pre>"; print_r($_POST); die ;
        $this->validate($request, [
           'title' => 'required',
           'description' => 'required',
		
           'company_name' => 'required',
           'location' => 'required|url',
           'job_type' => 'required',
           'salary' => 'required'
        ],
        [
            'location.url' => 'Please enter valid url, must start with http.'
        ]);
         
		 
        $tag = JobListing::find($id);

        if($request->file('image') != ''){
    		$file = $request->file('image');
    		$name = $file->getClientOriginalName();
    		//$request->file->move(public_path('uploads'), $name);
    		$file->move(public_path('uploads') , $name);
    		$tag->image = $name;
        }

        $tag->title = $request->input('title');
        $tag->description = $request->input('description');
        if($request->input('category') !=''){
		   $tag->category = $request->input('category');
        }
        $tag->company_name = $request->input('company_name');
		
        $tag->job_type = $request->input('job_type');
        $tag->salary = $request->input('salary');
        $tag->salary_type = $request->input('salary_type');
        $tag->location = $request->input('location');
        if( request('tags') ){
            $tag->tag_title =json_encode(request('tags'));
        }
        $tag->save();
        return redirect ('admin/jobs')->with('message','Job Updated');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $Category
     * @return \Illuminate\Http\Response
     */
 public function categoriesupdate(Request $request, Category $Category, $id)
    {
		
		
        $this->validate($request, [
           'title' => 'required'
        
        ]);
         
        $tag = Category::find($id);
        $tag->category_name = $request->input('title');
   
        $tag->save();
        return redirect ('admin/jobs/categories')->with('message','Category Updated');
    }
	
	    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Form  $Form
     * @return \Illuminate\Http\Response
     */
 public function formsupdate(Request $request, Form $Form, $id){
	$this->validate($request, [
		  'category' => 'required'
	]);
	$job = Form::where('category_id', '=', $id)->get();
	foreach($job as $_job){
	   $_job->delete();
	}
	$categories=$request->input('category');
	$fullData = $request->input('data');
	foreach($fullData['label'] as $_dataKey => $_dataValue){
		$inputLabel = $_dataValue;
		$inputType = $fullData['type'][$_dataKey];
		$inputinstruction = $fullData['name'][$_dataKey];
		$forms = new Form;
		$forms->category_id = $categories;
		$forms->label = $inputLabel;
		$forms->type = $inputType;
		if(!empty($inputinstruction)){
	
		$forms->instruction = $inputinstruction;
		}
		$forms->name = 'country';
		$forms->save();
		$formid=$forms->id;
		$inputName= strtolower($inputLabel);
		
		if($inputType == 'select' ||$inputType == 'radio' ||$inputType == 'checkbox'){
			$fullDataoptions = $request->input('options');
			//echo"<pre>"; print_r($fullDataoptions); die ;
			foreach($fullDataoptions[$inputType][$inputName] as $_dataKey => $_dataValue){
				//echo "<pre>"; print_r($_dataValue); die;
				$formoption =new FormOption;
				$formoption->label = $_dataValue;
				$formoption->field_id =$formid;
				$formoption->save();
			}
		}
	}
    $forms->save();
	return redirect ('admin/jobs/forms')->with('message','Form Updated');
}
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JobListing  $jobListing
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobListing $jobListing, $id)
    {
        $tag = JobListing::find($id);
        $tag->delete();
        return redirect ('admin/jobs')->with('message','Job Deleted');
    }
    
	 /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $Category
     * @return \Illuminate\Http\Response
     */
    public function destroycategories(Category $Category, $id)
    {
        $tags = Category::find($id);
        $tags->delete();
        return redirect ('admin/jobs/categories')->with('message','Category Deleted');
    }
	 /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Form  $Form
     * @return \Illuminate\Http\Response
     */
    public function formdelete(Form $Form, $id)
    {
        // $forms = Form::find($id);
		        $forms=DB::table('forms')
                ->where('category_id', $id);
              
		
        $forms->delete();
        return redirect ('admin/jobs/forms')->with('message','Form Deleted');
    }
	
    //Job Page
    public function jobPage()
    {
		$staff= User::where('role_id','3')->limit(6)->get();
		// $Category=Category::all();
		$Category=DB::select('SELECT categories.*,(select count(*) from job_listings  where category = categories.id) as count  FROM categories  GROUP BY id');
		$jobs=JobListing::paginate(6);
		$forms = Form::all();
		$form = DB::table('forms')->join('categories', 'forms.category_id', '=', 'categories.id')->select('forms.*', 'categories.category_name')->get();
		
		//echo"<pre>"; print_r($form); die ;
		// $form_option = DB::table('form_options')->where('field_id', '=', $form->id)->get();
		//echo"<pre>"; print_r($form_option); die ;
        return view ('jobs', compact('jobs','form','Category','staff'));
    }
	
	    public function jobPages($id)
    {
		
		$staff= User::where('role_id','3')->limit(6)->get();
		// $Category=Category::all();
		$Category=DB::select('SELECT categories.*,(select count(*) from job_listings  where category = categories.id) as count  FROM categories  GROUP BY id');
		$jobs=JobListing::where('category', $id)->paginate(6);
		$forms = Form::all();
		$form = DB::table('forms')->join('categories', 'forms.category_id', '=', 'categories.id')->select('forms.*', 'categories.category_name')->get();
		
		//echo"<pre>"; print_r($form); die ;
		// $form_option = DB::table('form_options')->where('field_id', '=', $form->id)->get();
		//echo"<pre>"; print_r($form_option); die ;
        return view ('jobs', compact('jobs','form','Category','staff'));
    }
    
    //Job Page
    public function singleJob($id)
    {
        $job = JobListing::find($id);
        return view ('singlejob', compact('job'));
    }
}
