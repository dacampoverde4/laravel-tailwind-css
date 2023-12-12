@extends('layouts.master')

@section('main-content')

    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->

    <div class="container-fluid page-titles">
        <div class="row">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor"><img src="{{ asset('backend/images/taguser.png') }}" alt="" class="all_users">
                    Saved Events</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Saved Events</li>
                </ol>
            </div>
            <div>
                <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10">
                    <i class="ti-settings text-white"></i></button>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <!-- End Upgrade Membership ---->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="col-md-12 pd_all0">
            <div class="card">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs customtab" role="tablist">
                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#inbox" role="tab"><span
                                    class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Events</span></a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="inbox" role="tabpanel">
                        <div class="tblesec_ser">
                            <table class="table table-bordered">
                                <th>#</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Date</th>
                                <th width="15%">Location</th>
                                <th width="10%">Action</th>
                                @if(count($saved_events)>0)
                                    @foreach($saved_events as $event)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td><a class=""
                                                   href="{{ route('event.single', $event->id)}}">{{$event->title}}</a>
                                            </td>
                                            <td>
                                                @if($event->category)
                                                    @php
                                                        $name = array();
                                                        $ids = json_decode($event->category);
                                                        if($ids){
                                                            $allCats = \App\EventCategory::find($ids);
                                                            if($allCats){
                                                                foreach($allCats as $cat){
                                                                    $name[] = $cat->term_name;
                                                                }
                                                                echo implode(', ',$name);
                                                            }
                                                        }

                                                    @endphp
                                                @endif
                                            </td>
                                            <td>{{$event->event_date_display}}</td>
                                            <td>
                                                @if($event->location_url)
                                                    <a target="_blank" class="btn btn-sm btn-success"
                                                       href="{{$event->location_url }}">Visit Location</a>
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>
                                                <a href="javascript:void(0);"
                                                   onclick="deleteItem({{$event->id}},'{{route('saved.event.delete',$event->id)}}')"
                                                   class="btn btn-danger btn-circle">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="10" class="text-center text-danger">No record found</td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                        {{ $saved_events->links() }}

                    </div>


                </div>
            </div>
        </div>

    </div>


@endsection

@section('footer')

@endsection