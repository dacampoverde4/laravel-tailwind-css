@extends('admin.New.layout.master')
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="inline_block font22"><b class="vertical_align"><img src="{{ asset('backend/images/create_user.png') }}" alt="Token" title="Token">ADD EMPLOYEE OF THE MONTH</b>
                            <a class="btn btn-info btn pull-right" href="{{ route('users.employee') }}"><i class="fa fa-arrow-left"></i> Back</a>
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
                        <form class="form_inline fullwidth mtop40" method="POST" action="{{route('users.storeemployee')}}">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Title') }}</label>
                                    <div class="col-md-9">
                                        <input id="name" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="" placeholder="Title" required >
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
                                        <textarea id="description" class="form-control{{ $errors->has('about_me') ? ' is-invalid' : '' }}"  placeholder="Description" name="description" required></textarea>
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
                                            <option value="{{ $row->id }}">{{ $row->name }}</option>
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
                                    <div class="col-md-9"><button type="submit" class="btn btn-success pull-right border_radius"><i class="fa fa-check"></i> Submit</button></div>
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
@section('page_js')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.searchdropdown').select2({
            placeholder: 'select tags',
          multiple: true
        });
    });
</script>
@endsection