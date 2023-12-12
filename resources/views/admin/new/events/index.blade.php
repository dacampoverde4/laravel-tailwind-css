@extends('admin.New.layout.master')
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="inline_block font22"><b><img src="{{ asset('backend/images/taguser.png') }}" alt="Img" title="Img" class="announcement"> Events</b>                    
                            <a href="{{route('event.create')}}" class="btn btn-info pull-right">Add Event</a>
                        </h3>
                        <hr>
                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif
                        <form style="display:none" id="usergroup_form" class="form_inline fullwidth mtop40" method="POST" action="{{route('event.invitations')}}">
                            @csrf
                            <input type="hidden" id="evntsid" name="events_id" value="">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="FreeTokens" class="col-form-label text-md-right">{{ __('Select Groups') }}</label>
                                    <select class="searchdropdown form-control" name="groupsid[]" multiple>
                                        @foreach($usergroup as $group)
                                        <option value="{{ $group->id }}">{{ $group->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button style="margin-top: 28px;" type="submit" class="btnpad btnred border_radius">Send Invitations</button>
                            </div>
                        </form>
                        <div class="msgtabs pt50">
                            <div class="container-fluid">
                                @if(session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                                @endif
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" id="ckbCheckAll"></th>
                                                <th>#</th>
                                                <th>Title</th>
                                                <th>Category</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($events as $event)
                                            <tr>
                                                <td><input type="checkbox" value="{{ $event->id }}" name="event_id[]" class="event_id"></td>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$event->title}}</td>
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
                                                <td>
                                                    <a href="{{ route('event.edit', $event->id)}}" class="btn btn-info btn-circle"><i class="fa fa-pencil"></i></a>
                                                    <a onclick="return confirm('Are you sure you want to delete tag?')" href="{{ route('event.delete', $event->id)}}" class="btn btn-info btn-circle btn-danger" title="Suspend"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                                    @if($event->suspend ==0)
                                                    <a title="Suspend" href="{{ route('event.suspend', $event->id)}}" class="btn btn-info btn-circle"><i class="fa fa-lock" aria-hidden="true"></i></a>
                                                    @else
                                                    <a title="Active" href="{{ route('event.active', $event->id)}}" class="btn btn-info btn-circle btn-danger"><i class="fa fa-unlock" aria-hidden="true"></i></a>
                                                    @endif
                                                    @if($event->feature ==0)
                                                    <a title="Feature" href="{{ route('event.feature', $event->id)}}" class="btn btn-info btn-circle"><i class="fa fa-star" aria-hidden="true"></i></a>
                                                    @else
                                                    <a style="background-color: #f7d320;border-color: #f7d320;" title="Unfeature" href="{{ route('event.feature', $event->id)}}" class="btn btn-info btn-circle"><i class="fa fa-star" aria-hidden="true"></i></a>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach          
                                        </tbody>
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
@section('page_js')
<script>
    $(document).ready(function () {
        $("#ckbCheckAll").click(function () {
            $(".event_id").prop('checked', $(this).prop('checked'));
        });
        
        $('input[type="checkbox"]').click(function(){
            var eventids = [];
            $('.maincontent td input:checkbox:checked').each(function() {
                   eventids.push($(this).val());
                });
            $('#evntsid').val(eventids);
            if($(".maincontent input:checkbox:checked").length > 0){
                $('#usergroup_form').show('3000');
                
            }
            else{
                $('#usergroup_form').hide('3000');
            }
        });
    });
</script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.searchdropdown').select2({
            placeholder: 'Select Groups',
          multiple: true
        });
    });
</script>
<style>
    .select2-container .select2-search--inline .select2-search__field {
    padding: 8px 0 !important;
    }
</style>
@endsection