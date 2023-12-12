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
                       <h3><b><i class="fa fa-envelope"></i>Family Role</b></h3>
                       <hr>
                          <form class="form-horizontal" role="form" method="POST" action="{{route('familyrole.update',$familyrole->id)}}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                              <div class="row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>

                                <div class="col-md-6">
                                    <input id="title"  type="title" class="form-control" name="title" value="{{ $familyrole->title }}" required autofocus>
                                    @if ($errors->has('title'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            </div>
                            <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                              <div class="row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">Gender</label>

                                <div class="col-md-6">
                                  <select class="form-control searchdropdown" id="role" name="gender" required>
                                     <option value="">Select gender</option>
                                     @if($familyrole->gender == 'male')
                                     <option value="male" selected>Male</option>
                                     <option value="female">Female</option>
                                     @else
                                     <option value="male">Male</option>
                                     <option value="female" selected>Female</option>
                                     @endif
                                  </select>
                                    @if ($errors->has('gender'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                          </div>



                           <div class="form-group{{ $errors->has('sort') ? ' has-error' : '' }}">
                            <div class="row">
                                <label for="sort" class="col-md-4 col-form-label text-md-right">Sort <small>(Enter a number)</small></label>

                                <div class="col-md-6">
                                    <input id="sort"  type="number" class="form-control" name="sort" value="{{ $familyrole->sort }}" min="0" required autofocus>
                                </div>
                                @if ($errors->has('sort'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('sort') }}</strong>
                                    </span>
                                @endif
                            </div>
                           </div>

                        <div class="form-group">
                            <div class="col-md-10">
                                <button type="submit" class="btn btn-success width pull-right">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- End Message Tabs -->

@endsection

@section('page_js')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.searchdropdown').select2({
            placeholder: 'select role',
          multiple: false
        });
    });
</script>
@endsection
