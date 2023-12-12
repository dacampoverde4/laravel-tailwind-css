@extends('layouts.master')

@section('page_level_styles')
<link rel="stylesheet" type="text/css" href="{{ asset('frontendnew/css/userads_style.css') }}">
<link href="{{ URL::asset('new-assets/common/plugins/bootstrap-fileinput/bootstrap-fileinput.css')}}" rel="stylesheet" type="text/css" />
@yield('page_level_styles')

@section('main-content')
 <div class="container-fluid page-titles">
    <div class="row">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor"><i class="fa fa-life-bouy"></i> Create Adevertisements</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Create Adevertisements</li>
            </ol>
        </div>
    </div>
</div>
<!-- Start Main Content ---->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
        	<div class="card">
        		<div class="card-body">
                    <div class="row mtb10">
                        <div class="col-md-12 ">
                            <h5>Create Advertisement</h5>
                        </div>
                    </div>
                    
                    <form method="POST" action="{{ route('saveuseradvertise.manageads') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb10">
                            <div class="col-md-3">
                                <label>Select Banner:</label>
                            </div>

                            <div class="col-md-9">
                                <select name="mybanners[]" class="searchbanners" id="mybanners" multiple>
                                    @foreach($banners as $banner)
                                        <option value="{{ $banner->id }}">{{ $banner->title }} - {{ $banner->banner_width }}X{{ $banner->banner_height }} : {{ $banner->page_location }} page</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="selected_banner" id="selected_banner" value="0">
                        <div class="form_append_sec"></div>
                        <div class="row mb10">
                            <div class="col-md-3">
                                <label>Select Targetaudience:</label>
                            </div>

                            <div class="col-md-9">
                                <select name="mytargetaudience[]" class="searchtargetaudience" id="mytargetaudience" multiple>
                                    @foreach($targetaudience as $value)
                                        <option value="{{ $value->id }}">{{ $value->usergroup_names }} - {{ $banner->price }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb10">
                            <div class="col-md-3">
                                <label>Select Plan for:</label>
                            </div>

                            <div class="col-md-9">
                                <div class="radio">
                                  <label><input type="radio" name="planfor" value="weekly" checked>Weekly</label>
                                </div>
                                <div class="radio">
                                  <label><input type="radio" name="planfor" value="monthly">Monthly</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-9">
                                <button type="submit" class="btn btn-success border_radius">Submit</button>
                            </div>
                        </div>    
                    </form>
                    
        			
        		</div>
        	</div>
        </div>            
    </div>
</div>
<!-- End Main Content ---->
@endsection
@section('footer')
<script src="{{ URL::asset('new-assets/common/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('new-assets/common/plugins/select2/js/select2.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".searchbanners").select2({
            placeholder: "Select a banners",
            allowClear: true
        });

        $(".searchtargetaudience").select2({
            placeholder: "Select a Target Audience",
            allowClear: true
        });
    })
    var selected_banner = '';
    selected_banner = $("#selected_banner").val();
    $('#mybanners').on('select2:select', function (e) {
        var lastSelectedItem = e.params.data;
        console.log(e.params.data);
        selected_banner++;

        var data = $('#mybanners').select2('data');
        var selected_count = data.length;
        
        var html = '';
        /*for (i = 1; i <= selected_count; i++) { 
            
        }*/

        html += '<div class="row mb10" id="banner_sec_row_'+lastSelectedItem.id+'">';
            html += '<div class="col-md-3">';
            html += '<label>banner image:</label>';
            html += '</div>';
            html += '<div class="col-md-9 multiple_usr_checkboxes_sec">';
            html += '<input type="file" name="banner_image[]" class="form-control" accept="image/jpeg, image/png">';
            html += '</div>';
            html += '<div class="clearfix mb10"></div>';
            html += '<div class="col-md-3">';
            html += '<label>banner url:</label>';
            html += '</div>';
            html += '<div class="col-md-9 multiple_usr_checkboxes_sec">';
            html += '<input type="text" name="banner_url[]" class="form-control">';
            html += '</div>';
            html += '</div>';
            $(".form_append_sec").append(html);
        
        $("#selected_banner").val(selected_banner);
    });

    $('#mybanners').on("select2:unselect", function(e){
        var unselected_id =   e.params.data.id;
        selected_banner--;
        console.log('unselected_id == ',unselected_id);
        var sel_val = $('#mybanners').val();
        if(sel_val == null){
            $("#selected_banner").val();
        }
        $("#banner_sec_row_"+unselected_id).remove();
    });

    
    
</script>
@endsection