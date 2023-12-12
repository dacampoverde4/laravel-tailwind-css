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
                        <h3 class="inline_block font20"><b class="vertical_align"><i class="fa fa-users" aria-hidden="true"></i> Target Audiances</b>
                            <a href="{{route('addtargetaudiance.advertisement')}}" class="btn btn-info pull-right">Add Target Audiances</a>
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
                                        <th>Usergroups</th>
                                        <th>Price</th>
                                        <th>Actions</th>
                                    </tr>
                                    @foreach($targetaudience as $value)
                                    	<tr>
                                    		<td>{{ $value->id }}</td>
                                    		<td>{{ $value->usergroup_names }}</td>
                                    		<td>{{ $value->price }}</td>
                                    		<td><a href="{{route('edittargetaudiance.advertisement', $value->id)}}" class="btn btn-info"><i class="fa fa-edit" aria-hidden="true"></i></a> <a href="{{route('deletetargetaudiance.advertisement', $value->id)}}" class="btn btn-danger pull-right"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
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
