@extends('admin.layout.master')
@section('content')
<div class="maincontent">
  <style>
  .table.table-bordered img{
    max-width: 50px;
  }
  img.blog_img.img-circle {
    width: 40px;
    height: 40px;
}
  </style>
    <div class="content bgwhite">
        <!-- Start Upgrade Membership ---->
        <div class="membership">
            <div class="container-fluid">
                    <h4 class="inline_block font22">
                        <b class="vertical_align"><img src="{{ asset('backend/images/allusers.png') }}" alt="Report" title="Img" class="all_users">BLOGS</b>
                  
        					<a href="{{route('blogs.categories')}}" style="margin:0 10px" class="btn btn-info pull-right">Categories </a>
        					    <a href="{{route('blogs.create')}}" style="margin:0 10px" class="btn btn-info pull-right">Add Blogs</a>
                        </h4>
                        </div>
                   <hr>
        </div>
        <!-- End Upgrade Membership ---->


        <!-- Start Message Tabs -->
        <div class="msgtabs mtop30">
            <div class="container-fluid">
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                <div class="tab-content">
                        <table class="table table-striped table-bordered" style="width:100%">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Title</th>
                              <th>Descripton</th>
							                <th>Images</th>
                              <th>Video URL</th>
                              <th>Blogger ID</th>
                              <th>Action</th>
                            </tr>
                          </thead>
						  
                          <tbody>
						  @if(!empty($blog))
							@foreach($blog as $_blog)
  							
  						<tr>
  							<td>{{ $loop->iteration }}</td>
  							<td>{{ $_blog->title }}</td>
  							<td>{!!substr($_blog->description ,0,100)!!}</td>
  							<td>@foreach(json_decode($_blog->image) as $img)
  						   <img  class="blog_img img-circle" src="{{ asset('/uploads/'.$img)}}" title="blog">
							  @endforeach
						  	</td>
                <!-- <td>
                 <video width="100" height="100" controls>
                      <source src="{{ asset('/uploads/'.$_blog->video)}}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
               </td> -->
                <td>{{$_blog->URL}}</td>
                <td>
                  @php 
                  $blogger=\App\User::where('id',$_blog->bloger_id)->first();
                  @endphp
                  {{$_blog->bloger_id}}
                </td>
							<td style="display:flex;">
              @if($_blog->is_approve == 0)
              <a onclick="return confirm('Are you sure you want Approve this Blog?')" href="{{ route('blog.approve', $_blog->id)}}" class="btn btn-info btn-circle btn-success" title="Approve"> <i class="fa fa-check-circle" aria-hidden="true"></i> </a>
              @else
              <button class="btn btn-info btn-circle btn-success" title="Approve" disabled=""><i class="fa fa-check-circle" aria-hidden="true"></i></button>
              @endif

							<a href="{{ route('blog.edit', $_blog->id)}}" class="btn btn-info btn-circle pull-left" style="float:left;"> <i class="fa fa-pencil"></i> </a>

							<a onclick="return confirm('Are you sure you want to delete job?')" href="{{ route('blog.delete', $_blog->id)}}" class="btn btn-info btn-circle btn-danger pull-right" title="Suspend" style="float:right;"> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
							</td>
						</tr> 
					@endforeach
					@endif							
                          </tbody>
                        </table>
                    </div>
                </div>

            </div>

        
    </div>
</div>

@endsection
@section('footer')
<script type="text/javascript">

$(document).ready(function(){
    $(".warningtouser").click(function(){
        var username = $(this).attr('data-user');
        var userid = $(this).attr('data-id');
        var urlaction = 'http://avdopt-saurabhrishu.c9users.io/profile/warning/'+userid;
        $('#warninguser').text(username);
        $('#warningform').attr('action',urlaction);

    });
});

$(document).ready(function() {
  $('.table').DataTable();
} );

</script>


@endsection
