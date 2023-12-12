@extends('layouts.master')
@section('main-content')
    <div class="maincontent">
        <div class="content bgwhite">                      
            <!-- Start Upgrade Membership ---->
            <div class="membership">
                <div class="container-fluid">
                    <h4 class="font22 inline_block">
                        <b class="vertical_align">
                            <img src="{{ asset('backend/images/user.png') }}" alt="Species" title="Img" class="gender_img">
                            Edit Species
                        </b>
                    </h4>
                    <a href="{{route('admin.species.index')}}" class="btn btnred pull-right">Back</a>
                </div>
                <hr>
            </div>
            <!-- Start Message Tabs -->
            <div class="msgtabs mtop30">
                <div class="container-fluid">
                    <div class="tab-content">
                        <div id="inbox" class="tab-pane fade in active">
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
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9 col-xl-8">
                                    <form class="form-horizontal" role="form" method="POST" action="{{route('admin.species.update',$species->id)}}">
                                        {{ csrf_field() }}
                                        <div class="form-group{{ $errors->has('species_name') ? ' has-error' : '' }}">
                                            <label for="species_name" class="col-xs-12 col-sm-4 col-md-3 col-lg-3 col-xl-4 control-label">
                                                Species Name
                                            </label>
                                            <div class="col-xs-12 col-sm-7 col-md-6 col-lg-6 col-xl-4 ">
                                                <input id="species_name"  type="text" class="form-control" name="species_name" value="{{$species->name}}" autofocus>

                                                @if ($errors->has('species_name'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('species_name') }}</strong>
                                                    </span>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3 col-xl-8">

                                            </div>
                                            <div class="col-xs-12 col-sm-7 col-md-6 col-lg-6 col-xl-4 ">
                                                <button type="submit" class="btn btnred width">
                                                    Update
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
        </div>
    </div>
@endsection
