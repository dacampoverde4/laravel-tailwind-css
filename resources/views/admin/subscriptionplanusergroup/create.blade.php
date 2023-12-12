@extends('admin.layout.master')
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="inline_block font22"><b class="vertical_align"><img src="{{ asset('backend/images/create_user.png') }}" alt="Token" title="Token">  Group plan Mapping </b>
                        <a class="btn btn-info btnpad pull-right" href="{{route('subscription-plan-usergroup.index')}}"><i class="fa fa-arrow-left"></i> Back</a>
                        </h3>
                        <hr>
                        @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                        @endif
                        @if(session()->has('Error'))
                        <div class="alert alert-danger">
                            {{ session()->get('Error') }}
                        </div>
                        @endif
                    <form class="form_inline fullwidth mtop40" method="POST" action="{{route('subscription-plan-usergroup.store')}}">
                        @csrf
                         <div class="row">
                         <div class="col-md-6">Point 1</div>
                         <div class="col-md-6">Point 2</div>
                         </div>
                         <br>
                         <div class="row">
                              <div class="col-md-6"><div class="row">
                                   <label for="main_group" class="col-md-2 col-form-label text-md-right">{{ __('Groups') }}</label>
                                   <div class="col-sm-4">
                                   <select name="main_group_id" id="main_group" class="form-control{{ $errors->has('map_group_plan_id') ? ' is-invalid' : '' }}" >
                                    <option></option>
                                        @foreach ($groups as $item)
                                   <option  class="main_group_op" value="{{$item->id}}">{{$item->title}}</option>
                                   @endforeach
                              </select>
                              @if ($errors->has('main_group_id'))
                              <span class="invalid-feedback">
                                  <strong>{{ $errors->first('main_group_id') }}</strong>
                              </span>
                              @endif
                            </div>
                         </div></div>
                         <div class="col-md-6"><div class="row">
                            <label for="map_group" class="col-md-2 col-form-label text-md-right">{{ __('Groups') }}</label>
                              <div class="col-sm-4">
                              <select name="map_group_id" id="map_group" class="form-control{{ $errors->has('map_group_id') ? ' is-invalid' : '' }}" >
                                <option></option>
                                   @foreach ($groups as $item)
                                   <option  class="main_group_op" value="{{$item->id}}">{{$item->title}}</option>
                                   @endforeach
                         </select>
                         @if ($errors->has('map_group_id'))
                              <span class="invalid-feedback">
                                  <strong>{{ $errors->first('map_group_id') }}</strong>
                              </span>
                              @endif
                        </div>
                    </div></div>
                              </div>
                              <br>
                              <div class="row">
                                <div class="col-md-6"><div class="row">
                                     <label for="main_group_plans" class="col-md-2 col-form-label text-md-right">{{ __('Plans') }}</label>
                                     <div class="col-sm-4">
                                     <select name="main_group_plan_id" id="main_group_plans" class="form-control{{ $errors->has('main_group_plan_id') ? ' is-invalid' : '' }}" >
                                </select>
                                @if ($errors->has('main_group_plan_id'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('main_group_plan_id') }}</strong>
                                </span>
                                @endif
                            </div>
                           </div></div>
                           <div class="col-md-6"><div class="row">
                            <label for="map_group_plans" class="col-md-2 col-form-label text-md-right">{{ __('Plans') }}</label>
                                <div class="col-sm-4">
                                <select name="map_group_plan_id" id="map_group_plans" class="form-control{{ $errors->has('map_group_plan_id') ? ' is-invalid' : '' }}" >
                                    
                           </select>
                           @if ($errors->has('map_group_plan_id'))
                           <span class="invalid-feedback">
                               <strong>{{ $errors->first('map_group_plan_id') }}</strong>
                           </span>
                           @endif
                        </div>
                      </div></div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                        <input type="submit" value="Submit" class="btn btn-info">
                                    </div>
                                    <div class="col-md-4"></div>
                                </div>
                        </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script>
$("#main_group").change(function () {
        var group_id = $(this).children("option:selected").val();
        $("#map_group option").css('display','block');
        $("#map_group option[value=" + group_id + "]").css('display','none');
        jQuery.ajax({
					url:"{{route('admin.usergroupsdrop')}}", //the page containing php script
					method: 'POST',
               data:{'group_id': group_id,'_token': '{{ csrf_token() }}'},
					success:function(result){
                        $('#main_group_plans').html('');
                        $.each(result, function(key, value) {
                    $('#main_group_plans').append('<option value="'+value.plan_id+'">'+value.name+'</option>');

                    });
                    }
                   
    });
});
$("#map_group").change(function () {
        var group_id = $(this).children("option:selected").val();
        $("#main_group option").css('display','block');
        $("#main_group option[value=" + group_id + "]").css('display','none');
        jQuery.ajax({
					url:"{{route('admin.usergroupsdrop')}}", //the page containing php script
					method: 'POST',
               data:{'group_id': group_id,'_token': '{{ csrf_token() }}'},
					success:function(result){
                        $('#map_group_plans').html('');
                        $.each(result, function(key, value) {
                    $('#map_group_plans').append('<option value="'+value.plan_id+'">'+value.name+'</option>');
                   
                    });
                    }
    });
});

</script>
@endsection