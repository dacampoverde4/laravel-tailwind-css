@extends('admin.New.layout.master')
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="inline_block"><b>Edit </b>
                            <a class="btn btn-info pull-right" href="{{ url('admin/users/employee') }}"><i class="fa fa-arrow-left"></i> Back</a>
                        </h3>
                        <hr>
                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif
                        @if (session('warning'))
                        <div class="alert alert-warning">
                            {{ session('warning') }}
                        </div>
                        @endif
                        <form class="form_inline fullwidth mtop40" method="POST" action="{{route('users.updateemployee', $jobs->id)}}">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Title') }}</label>
                                    <div class="col-md-9">
                                        <input id="name" type="text" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{$jobs->title}}"  placeholder="Title"  required >
                                        @if ($errors->has('title'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label for="description" class="col-md-3 col-form-label text-md-right">{{ __('Description') }}</label>
                                    <div class="col-md-9">
                                        <textarea id="description" class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }} " name="description"  placeholder="Description" required>{{$jobs->description}}</textarea>
                                        @if ($errors->has('description'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label for="catagory" class="col-md-3 col-form-label text-md-right">Staff</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="user_type" name="employee_name" required="required" >
                                            @if(!empty($staff)  )    
                                            <option value="" >Please Select Name</option>
                                            @foreach( $staff as $row )
                                            @if ($loop->first)
                                            <script type="text/javascript">
                                                getGoup({{ $row->id }});
                                            </script>
                                            @endif
                                            @if($jobs->staff_id ==  $row->id )
                                            <option value="{{ $row->id }}" selected>{{ $row->name }}</option>
                                            @else
                                            <option value="{{ $row->id }}" >{{ $row->name }}</option>
                                            @endif
                                            @endforeach
                                            @else
                                            <option value="" >Empty here !!</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-9"><button type="submit" class="btn btn-success pull-right border_radius"><i class="fa fa-check"></i> Update</button></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection