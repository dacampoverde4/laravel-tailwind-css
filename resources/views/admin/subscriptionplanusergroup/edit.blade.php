@extends('admin.layout.master')
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="inline_block font22"><b class="vertical_align"><img src="{{ asset('backend/images/create_user.png') }}" alt="Token" title="Token">Group Plan Mapping Editing</b>
                        <a class="btn btn-info btnpad pull-right" href="{{route('subscription-plan-usergroup.index')}}"><i class="fa fa-arrow-left"></i> Back</a>
                        </h3>
                        <hr>
                        @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                        @endif
                    <form class="form_inline fullwidth mtop40" method="POST" action="{{route('subscription-plan-usergroup.update',$group->id)}}">
                        @csrf
                        <input name="_method" type="hidden" value="PATCH">
                        <input name="id" type="hidden" id="id" value="{{$group->id}}">
                         <div class="row">
                         <div class="col-md-6">Point 1</div>
                         <div class="col-md-6">Point 2</div>
                         </div>
                         <br>
                         @if($group)
                         <div class="row">
                              <div class="col-md-6"><div class="row">
                                   <div class="col-sm-2">Groups</div>
                                   <div class="col-sm-4">
                                   <select name="main_group_id" id="main_group" class="form-control{{ $errors->has('main_group') ? ' is-invalid' : '' }}" >
                                    <option></option>
                                    
                                        @foreach ($groups as $item)
                                   <option value="{{$item->id}}"{{ $item->id == $point1 ? 'selected' : '' }}>{{$item->title}}</option>
                                   @endforeach
                              </select></div>
                              @if ($errors->has('main_group_id'))
                              <span class="invalid-feedback">
                                  <strong>{{ $errors->first('main_group_id') }}</strong>
                              </span>
                              @endif
                         </div></div>
                         <div class="col-md-6"><div class="row">
                              <div class="col-sm-2">Groups</div>
                              <div class="col-sm-4">
                              <select name="map_group_id" id="map_group" class="form-control{{ $errors->has('maingroup') ? ' is-invalid' : '' }}" >
                                <option></option>
                                   @foreach ($groups as $item)
                                   <option value="{{$item->id}}"{{ $item->id == $point2 ? 'selected' : '' }}>{{$item->title}}</option>
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
                                     <div class="col-sm-2">Plans</div>
                                     <div class="col-sm-4">
                                     <select name="main_group_plan_id" id="main_group_plans" class="form-control{{ $errors->has('main_group_plan_id') ? ' is-invalid' : '' }}" >
                                        @foreach ($plans as $item)
                                        <option value="{{$item->plan_id}}"{{ $item->id == $point1plan->plan_id ? 'selected' : '' }}>{{$item->name}}</option>
                                        @endforeach
                                </select>
                                @if ($errors->has('main_group_plan_id'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('main_group_plan_id') }}</strong>
                                </span>
                                @endif
                            </div>
                           </div></div>
                           <div class="col-md-6"><div class="row">
                                <div class="col-sm-2">Plans</div>
                                <div class="col-sm-4">
                                <select name="map_group_plan_id" id="map_group_plans" class="form-control{{ $errors->has('map_group_plan_id') ? ' is-invalid' : '' }}" >
                                   @foreach ($plans as $item)
                                   <option value="{{$item->plan_id}}"{{ $item->plan_id == $point2plan->plan_id ? 'selected' : '' }}>{{$item->name}}</option>
                                   @endforeach
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
@endif
            </div>
        </div>
    </div>
</div>

@endsection