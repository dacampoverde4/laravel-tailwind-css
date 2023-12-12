@extends('admin.layout.master')
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="inline_block"><b>Trial Plans</b>
                        <a class="btn btn-info btnpad pull-right" href="{{ url('admin/trialPlans')}}"><i class="fa fa-arrow-left"></i> Back</a>
                        </h3>
                        <hr>
                         @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif
                        
                        <form class="form_inline fullwidth mtop40" method="post" action="">
                        @csrf
                        
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12"><label for="name">Title:</label></div>
                                <div class="col-md-12">
                                     <input type="text" class="form-control" name="title" id="title" value="" placeholder="Title" value="">
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
                                <div class="col-md-12"><label for="name">Subscription Plans:</label></div>
                                <div class="col-md-12">
                                     <select id="" name="subscription_id" class="form-control">
                                        <option>Select Plan</option>
                                       @foreach($plans as $plan)
                                            <option value="{{ $plan->id }}">{{ $plan->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('subscription_id'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('subscription_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12"><label for="price">No of days:</label></div>
                                <div class="col-md-12">
                                    <input type="number" class="form-control" name="days" id="days" value="" placeholder="Days" min="1">
                                    @if ($errors->has('days'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('days') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                         <div class="form-group">
                            <div class="row">
                                <div class="col-md-12"><label for="name">User group:</label></div>
                                <div class="col-md-12">
                                     <select  name="user_group_id[]" class="form-control searchdropdown" multiple="multiple">
                                        <option>Select</option>
                                        @foreach($user_group as $user)
                                            <option value="{{$user->id}}">{{ $user->title}}</option>
                                        @endforeach
                                    </select>
                                  
                                </div>
                            </div>
                        </div>
                       
                       
                        <div class="form-group">
                            <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-9"><button type="submit" class="btn btn-success pull-right border_radius">Submit</button></div>
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