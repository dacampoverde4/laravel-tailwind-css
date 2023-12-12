@extends('admin.layout.master')
@section('page_css')
<style type="text/css">
    table.table-user-information td{
        text-align: left !important;
    }
</style>
@endsection
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="inline_block font22"><b>CREATE PUSH NOTIFICATION</b>
                            <a class="btn btn-info btnpad pull-right" href="{{ route('pushnotifications.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
                        </h3>
                        <hr>
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <table class="table table-user-information">
                                        <tbody>
                                            <tr>
                                                <th>Name :</th>
                                                <td>{{ $pushnotification->name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Call to Action :</th>
                                                <td><a href="{{ $pushnotification->url }}" target="_blank">{{ $pushnotification->button_text }}</a></td>
                                            </tr>
                                            <tr>
                                                <th>Content :</th>
                                                <td>{{ $pushnotification->content }}</td>
                                            </tr>
                                            <tr>
                                                <th>Show to new User :</th>
                                                <td>{{ $pushnotification->content }}</td>
                                            </tr>
                                            <tr>
                                                <th>Showing count :</th>
                                                <td>@if($pushnotification->show_to_new_users) <span class="btn  btn-success btn-xs">Yes</span> @else <span class="btn  btn-danger btn-xs">No</span> @endif</td>
                                            </tr>
                                            <tr>
                                                <th>Showing Seconds after login :</th>
                                                <td>{{ $pushnotification->seconds_to_show_after_login }}</td>
                                            </tr>
                                            <tr>
                                                <th>User Groups :</th>
                                                <td>
                                                    <ol>
                                                    @foreach($pushnotification->usergroups as $row)
                                                    <li>{{ $row->title }}</li>
                                                    @endforeach
                                                    </ol>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Membership Plans :</th>
                                                <td>
                                                    <ol>
                                                    @foreach($pushnotification->plans as $row)
                                                    <li>{{ $row->name }}</li>
                                                    @endforeach
                                                    </ol>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Created Date :</th>
                                                <td>{{date('M d, Y', strtotime($pushnotification->created_at))}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <div class="">
                                        <p>Banner: </p>
                                        <img src="{{ asset($pushnotification->bannerimage) }}" alt="your image" style="width: 300px;" />
                                    </div>
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
<script type="text/javascript">
function readURL(input, profile_preview_img) {
    console.log('input.files: ',input.files)
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $(profile_preview_img).attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$(".remove_image").click(function () {
    var form_group = $(this).closest('.form-group');
    $(form_group).find('input[type=file]').val('');
    $(form_group).find('.image_preview_div img').attr('src', '');
    $(this).hide();
    $(form_group).find('.image_preview_div img').hide();
});
$("input[type=file]").change(function(){
    var profile_preview_img = $(this).closest('.form-group').find('.image_preview_div img');
    $(profile_preview_img).show();
    readURL(this, profile_preview_img);
    $(this).closest('.form-group').find(".remove_image").show();
});
</script>
@endsection