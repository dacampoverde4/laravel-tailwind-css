<?php

namespace App\Http\Controllers;


use DB;
use Mail;
use Auth;
use App\Blog;
use App\User;
use App\BlogComment;
use App\BlogCategory;
use App\Mail\VerifyMails;
use App\WebsiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Mail\Notifications;


class BlogsController extends BaseController
{


    public function __construct()
    {

    }

	 public function index()
    {
		$blog= Blog::all();

        return view('admin.blog.index',compact('blog'));
    }

	public function blog()
    {
			$Category=DB::select('SELECT blog_categories.*,(select count(*) from blogs  where category_id = blog_categories.id) as count  FROM blog_categories  GROUP BY id');

			$blog=DB::select('SELECT blogs.*,(select count(*) from blog_comments  where blog_id = blogs.id) as count  FROM blogs  GROUP BY id ORDER BY id DESC');
		
			$count= Blog::count();
			$userIds = [];
			//$blog= Blog::find($id);
			foreach(User::all() as $userRecord){
				array_push($userIds, $userRecord->id);
			}
           
			foreach($blog as $blogger){
				if(in_array($blogger->bloger_id, $userIds)){
					$bloger_user[] = User::where('id',$blogger->bloger_id)->get();
				}
		    }
		    //echo '<pre>';print_r($bloger_user);die;

		return view('blog',compact('blog','Category','count','bloger_user'));
	}

	public function myBlogs(){
		$Category=DB::select('SELECT blog_categories.*,(select count(*) from blogs  where category_id = blog_categories.id) as count  FROM blog_categories  GROUP BY id');

		$blog=Blog::where('bloger_id',\Auth::user()->id)->where('is_approve',1)->orderby('id', 'desc')->get();
		$blogAll=DB::select('SELECT blogs.*,(select count(*) from blog_comments  where blog_id = blogs.id) as count  FROM blogs  GROUP BY id ORDER BY id DESC');
		$userIds = [];
			//$blog= Blog::find($id);
			foreach(User::all() as $userRecord){
				array_push($userIds, $userRecord->id);
			}
           
			foreach($blogAll as $blogger){
				if(in_array($blogger->bloger_id, $userIds)){
					$bloger_user[] = User::where('id',$blogger->bloger_id)->get();
				}
		    }

		$count= Blog::count();
		return view('myBlogs',compact('blog','Category','count','bloger_user'));
	}

	public function bloggerAdd(){
		$blogbategory=DB::select('SELECT blog_categories.*,(select count(*) from blogs  where category_id = blog_categories.id) as count  FROM blog_categories  GROUP BY id');
		$user=\Auth::user();
		$blog=Blog::where('bloger_id',\Auth::user()->id)->where('is_approve',1)->get();
		$blogAll=DB::select('SELECT blogs.*,(select count(*) from blog_comments  where blog_id = blogs.id) as count  FROM blogs  GROUP BY id ORDER BY id DESC');
		$userIds = [];
			//$blog= Blog::find($id);
			foreach(User::all() as $userRecord){
				array_push($userIds, $userRecord->id);
			}
           
			foreach($blogAll as $blogger){
				if(in_array($blogger->bloger_id, $userIds)){
					$bloger_user[] = User::where('id',$blogger->bloger_id)->get();
				}
		    }
        //print_r($Category);die;

        return view('bloggerAdd',compact('user','blog','blogbategory','bloger_user'));
	}

	 public function share($id)
    {
     	$blog= Blog::find($id);
        //echo "<pre>"; print_r($blog); die;
        return view('share',['data_array'=>$blog]);

    }
	    public function blogfilter($id)
    {

		$Category=DB::select('SELECT blog_categories.*,(select count(*) from blogs  where category_id = blog_categories.id) as count  FROM blog_categories  GROUP BY id');
			//echo"<pre>"; print_r($Category); die ;
			$blog= Blog::where('category_id', $id)->get();
			$count= Blog::where('category_id', $id)->count();
       return view('blog',compact('blog','Category','count'));
    }
    


	public function blogview($id )
    {
    $Category='';
	$user=Auth::user();
	if($user){
	$user_id=$user->id;
	$role=$user->role;
	}
	else{
		$role='';
		$user_id='';
	}
	//echo"<pre>"; print_r($user_id); die ;
	$comments = DB::table('blog_comments')->join('users', 'blog_comments.user_id', '=', 'users.id')->select('users.name', 'users.displayname','blog_comments.id', 'blog_comments.comment','blog_comments.user_id', 'blog_comments.created_at', 'users.profile_pic')->where('blog_comments.blog_id',$id)->get();
	$userIds = [];
	$bloger_user = $user;
	$blog= Blog::find($id);
	foreach(User::all() as $userRecord){
		array_push($userIds, $userRecord->id);
	}
	if(in_array($blog->bloger_id, $userIds)){
		$bloger_user = User::find($blog->bloger_id);
	}
	$count= Blog::count();
    return view('singleBlog',compact('blog','Category','count','comments','user_id','role','bloger_user'));
	}

	 public function create()
    {
		$staff= User::where('role_id','3')->get();
		$blogbategory = BlogCategory::all();
        return view('admin.blog.create', compact('blogbategory','staff'));
    }
	public function store(Request $request)
    {
    	
    	$user=\Auth::user();
	
	     if($request->hasfile('image'))
         {
            foreach($request->file('image') as $file)
            {
                $name=$file->getClientOriginalName();
                $file->move(public_path('uploads'), $name);
                $data[] = $name;
            }
         }

         /*if($request->hasfile('video'))
         {
                $video=$request->file('video')->getClientOriginalName();
                $request->file('video')->move(public_path('uploads'), $video);
         }*/
		
		$blog=new Blog;

		$blog->title = $request->input('name');
		$blog->description= $request->input('description');
		$blog->image = json_encode($data);
		$blog->category_id	 = $request->input('category_id');
		$blog->bloger_id = $user->id;
		//$blog->video = $video;
		$blog->URL = $request->input('url');
        $blog->save();

        //echo '<pre>';print_r($blog);die;

        if($user->role_id==1){
        	return redirect('admin/blogs')->with('message','Blog Successfully created');
        }else{
        	return redirect('/myBlogs')->with('message','Blog Successfully created');
        }
    }  

    public function blogSettings(Request $request)
    {
    	
    	$user=\Auth::user();
	    $id=$user->id;
        //echo $request->file('cover');die;
	     if($request->hasfile('cover'))
         {
         	    $file=$request->file('cover');
                $name=$file->getClientOriginalName();
                //echo $name;die;
                $file->move(public_path('uploads'), $name);
               // $data[] = $name;
         }
		
		if($user->role->role=='Blogger'){
			$blogger                = User::find($id);
			if($request->file('cover')){
				$blogger->cover_photo   = $name;
		    }else{
		    	$blogger->cover_photo   = $user->cover_photo;
		    }
			$blogger->facebook_url	= $request->input('facebook');
			$blogger->instagram	    = $request->input('instagram');
			$blogger->twitter	    = $request->input('twitter');
			$blogger->flicker	    = $request->input('flicker');
	        $blogger->save();
	        return redirect('/profile/edit')->with('message','Blog Settings Updated');
        }else{
        	return redirect('/profile/edit')->with('message','You are not Blogger');
        }
    }


	public function edit(blog $blog, $id)
    {

	$staff= User::where('role_id','3')->get();
        $blogbategory = BlogCategory::all();
        $blog = Blog::find($id);
        return view('admin.blog.edit', compact('blogbategory','blog','staff'));
    }


	/*update blog */
	 public function update(Request $request, Blog $Blog, $id)
		{

	     if($request->hasfile('image'))
         {

            foreach($request->file('image') as $file)
            {
                $name=$file->getClientOriginalName();
                $file->move(public_path('uploads'), $name);
                $data[] = $name;
				//echo"<pre>"; print_r($data);
            }
         }

         if($request->hasfile('video'))
         {
                $video=$request->file('video')->getClientOriginalName();
                $request->file('video')->move(public_path('uploads'), $video);
         }
		
		$blog= Blog::find($id);
		$blog->title = $request->input('name');
		$blog->description= $request->input('description');
		if(!empty($request->hasfile('image'))){
		$blog->image = json_encode($data);
		}
		if(!empty($request->hasfile('video'))){
		$blog->video = $video;
		}
		$blog->category_id	 = $request->input('category_id');
		$blog->bloger_id = $request->input('blogger_id');
		$blog->URL = $request->input('url');
        $blog->save();
        return redirect('admin/blogs')->with('message','Blog Successfully Updated');
    }

    public function blogApprove($id){
        $blog = Blog::findorfail($id);
        $blog->is_approve = '1';
        $blog->save();
        return redirect('admin/blogs')->with('message','Blog Successfully Approved');
    }

	public function destroy(Blog $Blog, $id)
    {
        $tag = Blog::find($id);
        $tag->delete();
        return redirect ('admin/blogs')->with('message','Blog Successfully Deleted');
    }


	 public function categories()
    {
		$category = BlogCategory::all();
        return view('admin.blog.categories',compact('category'));
    }
    public function createcategory(Request $request)
    {
        return view('admin.blog.createcategory');
    }
	    public function addcategory(Request $request)
    {
        $tag = new BlogCategory;
        $tag->category_name = $request->input('name');

        $tag->save();
        return redirect('admin/blogs/categories')->with('message','Category Created');
    }
	 /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BlogCategory  $BlogCategory
     * @return \Illuminate\Http\Response
     */
	  public function categoriesedit(BlogCategory $BlogCategory, $id)
    {

        $cate = BlogCategory::find($id);
        return view('admin.blog.categories_edit',compact('cate'));
    }
	 public function categoriesupdate(Request $request, BlogCategory $BlogCategory, $id)
    {


        $tag = BlogCategory::find($id);
        $tag->category_name = $request->input('name');

        $tag->save();
        return redirect ('admin/blogs/categories')->with('message','Category Updated');
    }
	   public function destroycategories(BlogCategory $BlogCategory, $id)
    {
        $tags = BlogCategory::find($id);
        $tags->delete();
        return redirect ('admin/blogs/categories')->with('message','Category Deleted');
    }
	public function commentstore(Request $request){
		//echo"<pre>" ; print_r($_POST); die;
		if (Auth::check()){
		$user=Auth::user();
		$user_id=$user->id;
		//echo"<pre>" ; print_r($user_id); die;
		$comment=new BlogComment;
		$comment->blog_id = $request->input('blog_id');
		$comment->user_id = $user_id;
		$comment->comment = $request->input('comment');

		$comment->save();

		return Redirect::back()->with('message','Comment Successfully Added !');
		}
		  else{
  return redirect('login')->with('message','Login Required ');
		  }
	}
	public function commentdestroy(BlogComment $BlogComment, $id){
		$comment = BlogComment::find($id);
		if ($comment != null) {
		$comment->delete();
        return redirect::back()->with('message','Comment Successfully Deleted !! ');
	}
	}
}
