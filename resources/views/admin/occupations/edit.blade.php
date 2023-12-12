@extends('admin.layout.master')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="inline_block"><b>Edit Occupation</b>
                        <a class="btn btn-primary pull-right" href="{{route('admin.occupation')}}"><i class="fa fa-arrow-left"></i> Back</a></h3>
                        <hr>
                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                       @endif
                       <form class="form_inline fullwidth mtop40" method="POST" action="{{route('admin.occupation.update',$occupation->id )}}">
                        @csrf
                        <div class="form-group">
                           <div class="row"> 
                            <label for="Title" class="col-md-3 col-form-label text-md-right">{{ __('Title') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ $occupation->title }}" required style="text-transform: capitalize !important;">

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
                                <label for="Title" class="col-md-3 col-form-label text-md-right">{{ __('Usergroup') }}</label>

                                <div class="col-md-6 col-sm-12">
                                    <div class="input-group">
                                        <select name="usergroup[]"  multiple class="form-control searchdropdown" style="width:100%;">
                                            @foreach($userGroup as $row)
                                            @php
                                                $sel = '';
                                                if( in_array($row->id, $sel_usergroup_ids) ){
                                                        $sel = "selected='selected'";
                                                    }
                                            @endphp
                                            <option  {{$sel}} value="{{ $row->id }}" style="text-transform: capitalize !important;"><?php echo $row->title ?></option>
                                            @endforeach
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        


                        <div class="form-group">
                            <div class="row">
                            <div class="col-md-9"><button type="submit" class=" btn-success pull-right border_radius">Submit</button></div>
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
            placeholder: 'select',
          multiple: true
        });
    });
</script>
@endsection