@extends('layouts.master')
@section('htmlheader')
<style>
a.certificateLink {
    font-size: 14px;
    text-align: right;
    float: right;
    font-weight: 500;
    color: #007bff;
}
.fa.fa-angle-right.arrowIcon {
	font-size: 22px;
	font-weight: 600;
	margin: 1px 15px 0 0;
	float: left;
}
</style>
@endsection
@section('main-content')

 <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><i class="fa fa-files-o" aria-hidden="true"></i> My Certificates</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">My Certificates</li>
                    </ol>
                </div>

            </div>
<!-- Start Main Content ---->
    <div class="container-fluid" id="certificatesListing">
        <div class="row">
        <div class="col-xs-12 col-md-10">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#adoption">Adoption Certificates</a></li>
            </ul>

            <div class="tab-content">
                <div id="adoption" class="tab-pane in active">

                  <table class="table">
                      <tbody>
                          @if(count($getTrialCertificate)>0)
                            @foreach($getTrialCertificate as $certificate)
                                <tr>
                                    <td>
                                    <i class="fa fa-angle-right arrowIcon"></i><b>{{$certificate->userid->display_name_on_pages}}</b> & <b>{{$certificate->matcherid->display_name_on_pages}}</b> adoption certificate.
                                    </td>
                                    <td>
                                        <a href="{{ url('certificate')}}/{{base64_encode($certificate->id)}}" class="certificateLink">See Certificate</a>
                                    </td>
                                </tr>
                            @endforeach
                          @else
                            <center><h4 class="p-20">You have no certificates! Please complete a successful adoption to receive an adoption certificate.</h4></center>
                          @endif
                      </tbody>
                  </table>
                </div>

            </div>
        </div>
    </div>
  </div>
<!-- End Main Content ---->
@endsection
