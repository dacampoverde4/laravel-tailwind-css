@extends('v7.frontend')
@section('page_level_styles')
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@yield('head')
<style>
.lft_first img {
    width: 100%;
}
.lft_first img {
    width: 100%;
    height: 350px;
}
     .fl_sec {
	background: #fdfbf6;
}



.categ_sec {
	text-align: center;
}

.categ_sec h1 {
	font-size: 27px;
	
	
	
	font-weight: bold;
}

.categ_sec {
	text-align: center;
	background: #fff;
	border-radius: 4px;
	-webkit-box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.05);
	box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.05);
	margin-bottom: 2rem;
	
	padding-top: 1rem;
}

.bxs_sec ul li {
	text-align: center;
	padding: 2rem 0;
	background: #f00;
	color: #fff;
	list-style-type: none;
	margin-bottom: 1rem;
	font-weight: bold;
	font-size: 49px;
}



.btm_btn a {
	background: #e36940;
	color: #fff;
	font-size: 25px;
	border-radius: 0;
	text-align: center;
	padding: 6px 30px;
}
.btm_btn {
	text-align: center;
}
.btm_btn {
	text-align: center;
	margin-bottom: 2rem;
}


.ad1 {
	background: #e6e63d !important;
}

.ad2 {
	background: #66dfea !important;
}

.ad3 {
	background: #6688ea !important;
}

.bxs_sec ul {
	margin: 0;
	padding: 0;
}
.lft_full h1 {
	text-transform: capitalize;
}
.categ_sec h1 {
    font-size: 27px;
    font-weight: bold;
    text-transform: capitalize;
}
.lft_first_btm {
    margin-top: 2rem;
}

.bxs_sec ul p {
	text-align: center;
	font-size: 25px;
	color: #337ab7;
	font-weight: bold;
	font-style: italic;
}
.img img {
	width: 100%;
	height: 400px;
}
.lft_full {
	padding: 2rem;
}
.lft_full {
	padding: 3rem;
	background: #fff;
	border-radius: 4px;
	-webkit-box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.05);
	box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.05);
	margin-bottom: 2rem;
}
.item img {
	width: 100%;
	height: 450px !important;
}
.lft_first {
	border-top: 1px solid #e6e3e3;
}
.lft_first h1 {
	font-size: 25px;
	font-weight: bold;
	margin-bottom: 10px;
}
.lft_first p {
	font-size: 17px;
	color: #575252;
}
.lft_first span {
	font-size: 26px;
	font-weight: bold;
	font-style: italic;
}
.lft_full.top {
	padding-top: 7px;
}
.lft_first.italic {
	text-align: center;
}
.lft_first {
	padding: 2rem 0;
}
.main_sec img {
	width: 100%;
	height: 216px;
}
.main_sec {
    border-top: 2px solid #f90707;
    border-bottom: 2px solid #f90707;
}
.mns_sec img {
    width: 100%;
    max-width: 111px;
    border: 2px solid #f90707;
    border-radius: 100%;
    
}
.social_sec a {
	padding: 0 7px;
}
.footer_sec {
    background: #272727;
    padding: 15px 0;
    margin-top: 2rem;
}
.mns_sec {

    width: 60%;
    margin: auto;
    position: relative;
    bottom: 58px;

}
.comments-list {
    
    margin-bottom: 2rem;

}
.article.comment{
	margin-bottom: 2rem;
    padding-bottom: 2rem;
}
.comment .comment-author {
    float: left;
    margin-right: 10px;
}
.comment .comment-author img {
    -webkit-border-radius: 50%;
    border-radius: 50%;
    width: 100%;
    max-width: 37px;
}
.comment .comment-author-name {
    font-size: 12px;
    color: #888;
    margin: 0;
}
.comment .comment-content {
    margin: 3px 0;
    padding-bottom: 10px;
    border-bottom: 1px dashed #e6e6e6;
}
.comment .comment-inner {
    display: grid;
}
a.delete_btn {
    float: right;
    color: #f00;
}
.blog-section{
    width: 100%;
    height: 45px;
    padding: 10px;
    background: #00000012;
}
.blog-div{
    width: 1170px;
    margin: 0 auto;
    color: #000;
}
.blog-section .pull-left p{
   color: #000;
   font-size: 18px;
}
</style>
@stop
@section('content')
<div class="fl_sec">
@if(\Auth::user())
 @if(\Auth::user()->role_id==5 || \Auth::user()->role_id==1)
  <div class="blog-section">
    <div class="blog-div">
      <div class="pull-left">
        <p><b>Hey {{\Auth::user()->displayname}}, let's blog!</b></p>
      </div>
      <div class="pull-right">
        <a href="{{url('blog')}}"><button class="btn btn-success">Post</button></a>
        <a href="{{url('/myBlogs')}}"><button class="btn btn-default">My Blogs</button></a>
        <a href="{{url('/profile/edit')}}"><button class="btn btn-default">Edit Profile</button></a>
      </div>
    </div>
  </div>
  @endif
@endif
<br>
         <div class="container">
		
			@if(session()->has('message'))
				<div class="alert alert-success alert-dismissible fade in">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					{{ session()->get('message') }}
				</div>
			@endif
            <div class="row">
			
               <div class="col-md-8">
			 <div class="lft_full top">
			  <h1>{{$blog->title}}</h1>
			 <div class="lft_first ">
			   @foreach(json_decode($blog->image) as $img)
							  @endforeach
							  	<img  src="{{ asset('/uploads/'.$img)}}" class="blog_img" title="blog">
                  
		
		<div class="lft_first_btm">	
		<p>{!!$blog->description!!}</p>
		</div>
		
		</div>
			

		@php
		//echo $user->role_id; die ;
		@endphp

				



		<!-- <div class="lft_first">	
		<h1>Where does it come from?</h1>
		<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. </p>
		</div>					
                 


		<div class="lft_first italic">	
		<span>All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. </span>
		</div>		

		<div class="lft_first">	
		<h1>Unordered list</h1>
		<p>All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator</p>
		<ul>
		<li>Lorem Ipsum available</li>
		<li>Lorem Ipsum available</li>
		<li>Lorem Ipsum available</li>
		<li>Lorem Ipsum available</li>
		</ul>
		</div>		 -->
		
		
			<!-- <div class="lft_first">	
		<h1>Where does it come from?</h1>
		<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. </p>
		</div>		 -->
                 				 
                        
						
				   
            <h2>Comments</h2>
            <!-- START COMMENTS -->
            <ul class="comments-list">
              @if(!empty($comments))
			  @foreach($comments as $_comment)
		  <li>
			<div class="article comment" inline_comment="comment">
				<div class="comment-author">
				@if($_comment->profile_pic)
					<img src="{{ url('uploads').'/'.$_comment->profile_pic }}" alt="Image Alternative text" title="User Picture">
				@else
					<img src="{{ url('uploads').'/'.$_comment->profile_pic }}" alt="Image Alternative text" title="User Picture">
					@endif

				</div>
				<div class="comment-inner">
				<span class="comment-author-name"><b>{{$_comment->displayname}}</b>  
			@if(Auth::check())
				@if($user_id == $_comment->user_id  || $user->role_id=='1')
					<a onclick="return confirm('Are you sure you want to delete job?')" href="{{route('delete.comment',$_comment->id)}}" class="delete_btn" title="Delete Comment"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
				@endif	
			@endif
				</span>
					<p class="comment-content">{{$_comment->comment}}</p>
				</div>
			</div>
                    </li>
			  @endforeach
			  @endif		
				
                  </ul>
            <!-- END COMMENTS -->
            <h3>Leave a Comment</h3>
            <form  action="{{ route('commentstore') }}" method="post" >
			 @csrf
                <div class="row">
                </div>
                <div class="form-group">
                    <label>Comment</label>
                    <textarea class="form-control" name="comment"></textarea>
					<input type="hidden"  name="blog_id" value="{{$blog->id}}">
                </div>
                <input class="btn btn-primary" type="submit" value="Leave a Comment">
            </form>		
               </div>
               </div>
                  
          
              
			   
			   
			   
			   
               <div class="col-md-4">
                  <div class="categ_sec">
                     <h1></h1>
					<div class="main_sec">
                      @if(!empty($bloger_user->cover_photo))
                      <img  src="{{ asset('/uploads/'.$bloger_user->cover_photo)}}" class="blog_img" title="blog">
                      @else
					   <img src="{{ asset('/uploads/default.png') }}">
					   @endif
                  </div>
				  
				  <div class="main_btm_sec">
				  <div class="mns_sec">
					    @foreach(json_decode($blog->image) as $img) @endforeach
						<img  src="{{ asset('/uploads/'.$img)}}" class="blog_img" title="blog">
					   <h1>{{$bloger_user->displayname}}</h1>
					   <div class="loreum_sec">
					   <p>
					   	{{ str_limit($bloger_user->about_me, 60) }}
					   </p>
					   </div>
					   <div class="social_sec">
                            <a href="{{$bloger_user->facebook_url}}"> <i class="fa fa-facebook"></i></a>
                            <a href="{{$bloger_user->instagram}}">  <i class="fa fa-instagram"></i></a>
                            <a href="{{$bloger_user->twitter}}"> <i class="fa fa-twitter"></i></a>
							<a href="{{$bloger_user->flicker}}"> <i class="fa fa-flickr"></i></a>
                           
                        </div>
                  </div>
                  </div>
                  </div>
                  <div class="bxs_sec">
                     <ul>
                        <li>AD</li>
                        <li class="ad1">AD</li>
                        <li class="ad2">AD</li>
                        <li class="ad3">AD</li>
                        <p>Advertise here</p>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
		 
		 
		 
		
         

      </div>
@endsection    
