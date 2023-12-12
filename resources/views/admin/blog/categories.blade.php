@extends('admin.layout.master')
@section('content')
<div class="maincontent">
 
    <div class="content bgwhite">
        <!-- Start Upgrade Membership ---->
        <div class="membership">
            <div class="container-fluid">
                    <h4 class="inline_block font22">
                        <b class="vertical_align"><img src="{{ asset('backend/images/allusers.png') }}" alt="Report" title="Img" class="all_users">CATEGORIES</b>
                    
				
				<a class="btn btn-info pull-right" href="{{ url('admin/blogs') }}"><i class="fa fa-arrow-left"></i> Back</a>
					    <a href="{{route('blogs.addcategory')}}" style="margin:0 10px" class="btn btn-info pull-right">Add Category</a></h4>
						
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
				 @if (session('warning'))
                        <div class="alert alert-warning">
                            {{ session('warning') }}
                        </div>
                    @endif
                <div class="tab-content">
                        <table class="table table-bordered">
                            <th>#</th>
                            <th>Title</th>
                            <th>Action</th>
							@if(!empty($category))
                            @foreach($category as $_category)   
							 <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{$_category->category_name}}</td>
                                <td style="display: flex;">
                                    <a href="{{ route('categoriesedit.blogs', $_category->id)}}" class="btn btn-info btn-circle pull-left"><i class="fa fa-pencil"></i></a>
                                    <a onclick="return confirm('Are you sure you want to delete?')" href="{{ route('destroycategories.blogs', $_category->id)}}" class="btn btn-info btn-circle btn-danger pull-right" title="Suspend"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                 </td>
                            </tr>   
                            @endforeach     
							@endif
                        </table>
                    </div>
                </div>

            </div>

        </div>
   
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.searchdropdown').select2({
            placeholder: 'Select Categories',
          multiple: true
        });
    });
</script>
<script>
$(document).ready(function(){
    $('#user_type').on('change', function() {
      if ( this.value == '3')
      //.....................^.......
      {
        $("#showcategory").show();
          $("#designation").show();
      }
      else
      {
        $("#showcategory").hide();
        $("#designation").hide();
      }
      
    });
});
</script>
@endsection
@section('page_js')

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.searchdropdown').select2({
            placeholder: 'Select Groups',
          multiple: true
        });
    });
</script>

@endsection
