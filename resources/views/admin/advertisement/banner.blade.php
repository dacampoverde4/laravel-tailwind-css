@extends('admin.layout.master')
@section('content')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="inline_block font20"><b class="vertical_align"><i class="fa fa-life-bouy" aria-hidden="true"></i> Banners</b>
                            <a href="{{route('addbanner.advertisement')}}" class="btn btn-info pull-right">Add Banner</a>
                        </h3>
                        <hr>
                        <div class="msgtabs pt50">
                            <div class="container-fluid">
                                @if(session()->has('success'))
                                <div class="">
                                    <div class="alert alert-success">
                                        {{ session()->get('success') }}
                                    </div>
                                </div>
                                @endif

                                @if(session()->has('error'))
                                <div class="">
                                    <div class="alert alert-error">
                                        {{ session()->get('error') }}
                                    </div>
                                </div>
                                @endif

                                <div class="table-responsive m-t-40">
                                    <table class="table table-bordered">
                                    <tr>
                                        <th>Id</th>
                                        <th>Banner Width</th>
                                        <th>Banner Height</th>
                                        <th>Page Location</th>
                                        <th>Weekly Price</th>
                                        <th>Monthly Price</th>
                                        <th>Actions</th>
                                    </tr>
                                    @foreach($banners as $banner)
                                    	<tr>
                                    		<td>{{ $banner->id }}</td>
                                            <td>{{ $banner->banner_width }}</td>
                                    		<td>{{ $banner->banner_height }}</td>
                                    		<td>{{ $banner->page_location }}</td>
                                            <td>{{ $banner->weekly_price }}</td>
                                    		<td>{{ $banner->monthly_price }}</td>
                                            <td><a href="{{route('editbanner.advertisement', $banner->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></a> <a href="{{route('deletebanner.advertisement', $banner->id)}}" class="btn btn-danger btn-sm pull-right"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                                    	</tr>
                                    @endforeach
	                                </table>
	                            </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
