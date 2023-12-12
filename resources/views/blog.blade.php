@extends('v7.frontend')
@section('page_level_styles')
      <script type="text/javascript"
            src="//code.jquery.com/jquery-1.9.1.js"> 
  </script> 
    <link rel="stylesheet" 
          type="text/css" 
          href="/css/result-light.css"> 
    
 <script type="text/javascript" 
            src= 
"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"> 
  </script> 
    <link rel="stylesheet" 
          type="text/css" 
          href= 
"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css"> 
    <link rel="stylesheet"
          type="text/css" 
          href= 
"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <!-- JavaScript for adding  
     slider for multiple images 
     shown at once-->
    <script type="text/javascript"> 
        $(window).load(function() { 
            $(".carousel .item").each(function() { 
                var i = $(this).next(); 
                i.length || (i = $(this).siblings(":first")), 
                  i.children(":first-child").clone().appendTo($(this)); 
                
                for (var n = 0; n < 4; n++)(i = i.next()).length || 
                  (i = $(this).siblings(":first")), 
                  i.children(":first-child").clone().appendTo($(this)) 
            }) 
        }); 
    </script> 
@yield('head')
<style>


.thumbnail {
	border: none;
	position: relative;
	background-color: #000000;
	padding:0;
}

.thumbnail a>img,
.thumbnail>img {
	margin-right: auto;
	margin-left: auto;
	width: 100%;
	opacity:0.5;
	height: 240px;
}

.img img {
    width: 100%;
    height: 180px;
}

.heads_sec h1 {
	font-size: 25px;
	margin: 0;
	text-transform: capitalize;
	color: #3c3a3a;
	font-weight: bold;
  padding-bottom: 25px;
  margin-top: 20px;
}

.heads_sec {
	margin-bottom: 0rem;
}

/*.heads_sec::before {
    position: absolute;
    content: "";
    background: #e36940;
    width: 81px;
    height: 4px;
    bottom: 75%;
}*/

.para_sec p {
	font-size: 15px;
	color: #7d7aa3;
}

.spanner_sec span {
	font-size: 16px;
	color: #7d7a7a;
}

.parag_sec {
	margin: 1rem 0;
}

.parag_sec p {
	color: #7d7a7a;
}

.parag_sec a {
    padding: 7px 20px;
    border-radius: 50px;
    border: none;
    font-size: 15px;
    font-weight: bold;
    background-image: linear-gradient(to right, #ff2f00 , #ffc46d);
}

.para_sec p img {
	width: 100%;
	max-width: 28px;
	padding-right: 5px;
}
.cmt_sec{
  margin-top: 15px;
}

.social_sec i {
	color: grey;
	padding: 0px 7px;
}

.mid_bit {
	  margin-bottom: 15px;
    padding: 30px 30px 15px 30px;
    border: 2px solid #0000002e;
}

.rgt {
    padding: 2rem 1rem;
}

.categ_sec {
	text-align: center;
}

.categ_sec h1 {
    font-size: 20px;
    width: 180px;
    margin: 0;
    text-align:left;
    font-weight: bold;
    padding: 10px 5px;
    color: #000;
}
.categ_sec ul li a {
    color: #000;
}

.categ_sec {
    text-align: center;
    background: #fff;
    border-radius: 4px;
    -webkit-box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.05);
    box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.05);
    margin-bottom: 2rem;
    height: auto;
    padding: 1rem;
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

.bxs_sec ul p {
    text-align: center;
    font-size: 25px;
    color: #337ab7;
    font-weight: 600;
    font-style: italic;
    padding: 1rem;
}

.text {
	position: absolute;
	z-index: 999;
	margin: 0 auto;
	left: 0;
	right: 0;
	top: 75%;
	text-align: left;
	width: 90%;
}
.reapeter{
    display:block;
}

.text p {
	font-size: 16px;
	color: #fff;
}
.tp_hd h1 {
    font-size: 20px;
    border: 2px solid #e36940;
    width: 160px;
    font-weight: bold;
    padding: 10px;
    text-align: center;
}
.tp_hd {
    border-bottom: 2px solid #e36940;
    margin-bottom: 2rem;
}

.btm_btn a {
    background: linear-gradient(to right, #ff2f00 , #ffc46d);
    color: #fff;
    font-size: 22px;
    border-radius: 0;
    text-align: center;
    padding: 6px 30px;
    border: none;
}
.btm_btn {
	text-align: center;
}
.btm_btn {
	text-align: center;
	margin-bottom: 2rem;
}
.categ_sec ul li {
    width: 44%;
    margin: auto;
    text-align: left;
    margin-top: 5px;
}
.carousel-indicators li {
   border: 1px solid #000!important;

}.carousel-indicators {
  bottom: -15px!important;

}
.carousel-indicators .active {
  background-color: #000;
}
.blog{
    object-fit: cover;
    width: 100%;
    height: 250px;
}
.carousel-inner{
  margin-bottom: 50px;
}
.top_header{
  padding-top: 20px !important;
  min-height: 80px !important;
}
.navbar-default{
      background-color: transparent !important;
    background-image: none;
    border: 0;
    box-shadow: unset;
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
.carousel-control.left,.carousel-control.right{
  background-image: none;
}
.carousel-inner {
    margin: 20px 0px;
    height: 250px;
    overflow: hidden;
}
.carousel-inner .col-md-3 {
    padding-left: 0;
    padding-right: 0;
}
.btn-section{
    position: absolute;
    top: 60%;
    left: 12px;
}
.btn-sectionnew{
    position: absolute;
    top: 0%;
    left: 24px;
    margin-bottom: 24px;
}
.nav-tabs {
    border-bottom: 2px solid #a9705d;
}
 .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
    color: #fff;
    cursor: default;
    background-color: transparent;
    border: 1px solid transparent;
    border-bottom-color: transparent;
    transform: skew(-19deg);
}
.nav-tabs>li.active{
    background-color: #444444;
    transform: skew(20deg);
}
.nav-tabs>li{
    background-color: #44444429;
    transform: skew(20deg);
}
.nav-tabs>li>a{
   transform: skew(-19deg);
}
.nav-tabs>li>a:hover {
    border-color: transparent;
    background-color: transparent;
}
.blog-sider{
      border: 2px solid #0000002e !important; 
      margin-bottom: 10px;
}
.bloggers{
      border-bottom: 2px solid #0000002e; 
      margin-left:4%;
}
.bloggers >h1, .popular-posts >h1{
      font-size:20px; 
      text-decoration: underline #0000002e;
      
}
.bloggers img{
      width:75px;
      height:75px;
      border-radius:100%;
}
.popular-posts{
      margin-left:4%;
}
.post-card{
      padding:7px; 
      border:0;
      border-bottom: 2px solid #0000002e;
}
.post-card img{
      height:65px;
      width:65px;
}
.blog-letters{
      padding:0 1rem; 
      margin-left: 4%;
}
.blog-letters h1{
      margin:0px; 
      font-size:15px;
      font-weight:bold;
      padding-bottom:5px;
}
.blog-letters span{
      font-size:12px;
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
        @if(\Auth::user()->role_id==1)
        <a href="{{ url('/admin/blogs/create') }}"><button class="btn btn-success">Post</button></a>
        @else
        <a href="{{ url('bloggerAdd') }}"><button class="btn btn-success">Post</button></a>
        @endif

        <a href="{{url('/myBlogs')}}"><button class="btn btn-default">My Blogs</button></a>
        <a href="{{url('/profile/edit')}}"><button class="btn btn-default">Edit Profile</button></a>
      </div>
    </div>
  </div>
  @endif
@endif

    <div class="container">
		
       <div class="row">
        <!-- bootstrap card with row name myCarousel as row 1-->
        <div class="carousel slide" id="myCarousel"> 
            <div class="carousel-inner"> 
              <?php 
              $output = '';
              $class = 'item';
              ?>
                @foreach($blog as $k => $_blog)
                <?php 
                $active = ($k == 0) ? " active" : ""; 
                ?>
                <div class="{{$class}}{{$active}}"> 
                    <div class="col-md-3"> 
                        <a href="{{route('blogview', $_blog->id )}}"> 
                          @foreach(json_decode($_blog->image) as $img)
                                    @endforeach
                        <img  src="{{ asset('/uploads/'.$img)}}" title="blog" class="blog"> 
                        <div class="btn-section">
                          <button type="button" class="btn-xs btn-primary">Electronics</button>
                          <button type="button" class="btn-xs btn-primary" style="background: #d0a3da;border-color: #d0a3da;">Gadget</button>
                          <button type="button" class="btn-xs btn-primary" style="background: #a95eea;border-color: #a95eea;">Laptops</button>
                        </div>
                        <div class="text"><p>{{ substr($_blog->title ,0,60)}} </p></div>
                      </a> 
                    </div> 
                </div> 
                @endforeach
        
            </div>
             <a class="left carousel-control"
                      href="#myCarousel"
                      data-slide="prev"> 
          <i class="glyphicon glyphicon-chevron-left"> 
          </i> 
          </a> 
            <a class="right carousel-control" 
               href="#myCarousel" 
               data-slide="next"> 
              <i class="glyphicon glyphicon-chevron-right"> 
              </i> 
          </a> 
          
  
        </div> 
      </div>
            <div class="row">
              <div class="col-md-12">
        
                 
                 <ul class="nav nav-tabs">
                  <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
                  @if(!empty($Category))
                    @foreach($Category as $cate)
                     <li><a data-toggle="tab" href="#menu{{$loop->index}}">{{$cate->category_name}} ({{$cate->count}})</a></li>
                    @endforeach
                   @endif
                </ul>
                

              </div>

      <div class="col-md-8">


  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
     @if(!empty($blog))
      @foreach($blog as $_blog)
          <div class="mid_bit reapeter">
                     <div class="row">
                        <div class="col-md-5">
                           <div class="img">

             @foreach(json_decode($_blog->image) as $img)
             @endforeach
                 <a href="{{route('blogview', $_blog->id )}}"><img  src="{{ asset('/uploads/'.$img)}}" class="blog_img" title="blog"></a>
                       </div>
                        </div>
                        <div class="col-md-7">
                           <div class="rgt">
                              <div class="btn-sectionnew">
                                    <button type="button" class="btn-xs btn-primary">Electronics</button>
                                    <button type="button" class="btn-xs btn-primary" style="background: #d0a3da;border-color: #d0a3da;">Gadget</button>
                                    <button type="button" class="btn-xs btn-primary" style="background: #a95eea;border-color: #a95eea;">Laptops</button>
                              </div>
                              <div class="heads_sec">
                                 <a href="{{route('blogview', $_blog->id )}}"><h1>{{ substr($_blog->title ,0,60)}} </h1></a>
                              </div>
                              <div class="spanner_sec">
                                 <span>November 27, 2016  #Lifestyles </span>
                              </div>
                              <div class="parag_sec">
                                 <p>{!!substr($_blog->description ,0,100)!!} </p>
                              </div>
                        
                           </div>
                        </div>
                     </div>
                  </div>
                  @endforeach

                  @endif
                 @if($count >4)
                        <div class="btm_btn">
                              <a href="#" class="btn " id="loadMore">Load More</a>
                        </div>
                  @endif
          </div>
           @foreach($Category as $cate)
           @php 
             $catdata=\App\Blog::where('category_id',$cate->id)->get();
           @endphp
          <div id="menu{{$loop->index}}" class="tab-pane fade">
            @if(!empty($catdata))
          @foreach($catdata as $_blog)
          <div class="mid_bit reapeter">
                     <div class="row">
                        <div class="col-md-5">
                           <div class="img">

             @foreach(json_decode($_blog->image) as $img)
             @endforeach
                <img  src="{{ asset('/uploads/'.$img)}}" class="blog_img" title="blog">

                       </div>
                        </div>
                        <div class="col-md-7">
                           <div class="rgt">
                              <div class="btn-sectionnew">
                                    <button type="button" class="btn-xs btn-primary">Electronics</button>
                                    <button type="button" class="btn-xs btn-primary" style="background: #d0a3da;border-color: #d0a3da;">Gadget</button>
                                    <button type="button" class="btn-xs btn-primary" style="background: #a95eea;border-color: #a95eea;">Laptops</button>
                              </div>
                              <div class="heads_sec">
                                 <a href="{{route('blogview', $_blog->id )}}"><h1>{{ substr($_blog->title ,0,60)}} </h1></a>
                              </div>
                              <div class="spanner_sec">
                                 <span>November 27, 2016  #Lifestyles </span>
                              </div>
                              <div class="parag_sec">
                                 <p>{!!substr($_blog->description ,0,100)!!}  </p>
                              </div>
                        
                           </div>
                        </div>
                     </div>
                  </div>
                  @endforeach

                  @endif
                 @if($count >4)
                        <div class="btm_btn">
                              <a href="#" class="btn " id="loadMore">Load More</a>
                        </div>
                  @endif
          </div>
          @endforeach
         
        </div>
      </div>
   <div class="col-md-4 blog-sider">
                  <div class="row">
                        <div class="col-md-11 bloggers">
                              <h1>Bloggers</h1>
                              @if(!empty($bloger_user))
                                  @foreach($bloger_user as $key=>$blogers)
                                     @foreach($blogers as $blogg)
                                    <div class="col-md-3 col-sm-6 col-xs-6" style="margin-bottom:10px;" >

                                           @if(!empty($blogg->cover_photo))
                                             <img  src="{{ asset('/uploads/'.$blogg->cover_photo)}}" class="blog_img" title="blog">
                                           @else
                                           <img src="{{ asset('/uploads/default.png') }}">
                                           @endif
                                          
                                          <!-- <img  src="{{ asset('/uploads/'.$img)}}" title="blog"> -->
                                     </div>
                                      @endforeach

                                     @endforeach
                            
                               @else
                                <div class="col-md-3 col-sm-6 col-xs-6" style="margin-bottom:10px;" >
                                    <p> Blogger not yet updated his details..</p>
                                </div>
                              @endif
                        </div>
                        
                  </div>
                  <div class="row">
                        <div class="col-md-11 popular-posts">
                              <h1>Popular Posts</h1>
                              
                              @foreach($blog as $_blog)
                                    <div class="mid_bit reapeter post-card">
                                          <div class="row">
                                                <div class="col-md-2 col-sm-12 col-xs-12">
                                                      <div class="img">

                                                            @foreach(json_decode($_blog->image) as $img)
                                                            @endforeach
                                                            <img  src="{{ asset('/uploads/'.$img)}}" title="blog">
                                                      </div>
                                                </div>
                                                <div class="col-md-10 col-sm-12 col-xs-12">
                                                      <div class="rgt blog-letters">
                                                            <div class="heads_sec">
                                                                  <a href="{{route('blogview', $_blog->id )}}"><h1>{{ substr($_blog->title ,0,60)}} </h1></a>
                                                            </div>
                                                            <div class="spanner_sec">
                                                                  <span>November 27, 2016  #Lifestyles </span>
                                                            </div>
                                                      </div>
                                                </div>
                                          </div>
                                    </div>
                              @endforeach
                        </div>
                        
                  </div>
                  <div class="row">
                        <div class="bxs_sec col-md-11" style="margin-left:4%;">
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
         </div>
      </div>
      <div id="fb-root"></div>
      <script type="text/javascript">
        $(document).ready(function() {
          $('.carousel').carousel({
            interval: 2000
          })
        });
      </script>
			<script>
			   (function (d, s, id) {
			        var js, fjs = d.getElementsByTagName(s)[0];
			        if (d.getElementById(id))
			            return;
			        js = d.createElement(s);
			        js.id = id;
			        js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.3&appId=2155520864748239";
			        fjs.parentNode.insertBefore(js, fjs);
			    }(document, 'script', 'facebook-jssdk'));

    			function fb_share(dynamic_link,dynamic_title) {
    			    var app_id ='2155520864748239';
    			    var pageURL="https://www.facebook.com/dialog/feed?app_id=" + app_id + "&link=" + dynamic_link;
    			    var w = 600;
    			    var h = 400;
    			    var left = (screen.width / 2) - (w / 2);
    			    var top = (screen.height / 2) - (h / 2);
    			    window.open(pageURL, dynamic_title, 'toolbar=no, location=no, directories=no, status=no, menubar=yes, scrollbars=no, resizable=no, copyhistory=no, width=' + 800 + ', height=' + 650 + ', top=' + top + ', left=' + left)
    			    return false;
    			}
  		</script>

  	  <script>
          $(function () {
          $(".reapeter").slice(0, 6).show();

          $("#loadMore").on('click', function (e) {
          e.preventDefault();
          $(".reapeter:hidden").slice(0, 6).slideDown();
          if ($(".reapeter:hidden").length == 0) {
          $("#load").fadeOut('slow');
          }
          $('html,body').animate({
          scrollTop: $(this).offset().top
          }, 1500);
          });
          });
     </script>

@endsection
