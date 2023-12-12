@extends('layouts.master')

@section('main-content')
<?php
  use App\FamilyRole;
 ?>
<!-- Start Main Content ---->


        <!-- Start Upgrade Membership ---->
        <!--<div class="membership">-->
        <!--    <div class="container-fluid">-->
        <!--        <h4 class="font22"><b class="vertical_align"><img src="{{ asset('backend/images/mymatch.png') }}" alt="" class="all_users"><span>MY MATCHES</span></b></h4>-->
        <!--    </div>-->
        <!--</div>-->
        <div class="container-fluid page-titles">
            <div class="row">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><img src="{{ asset('backend/images/mymatch.png') }}" alt="" class="all_users"> My Matches</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">My Matches</li>
                    </ol>
                </div>
            </div>
        </div>

        @if ( !isthisSubscribed() && !getmanualfeatures('token_view_my_matches_'))
            @include('includes.debitTokens', ['featurevalue'=>'token_monthly_connection_value_','featureclass'=>'chat','featurename'=>'token_view_my_matches_', 'featureMessage'=>'Hey '. ucfirst( Auth::user()->display_name_on_pages ) .'!. Upgrade your membership today to experience unlimited chat.'])
    	@endif
        <!-- End Upgrade Membership ---->
        <!-- Start Match Tabs -->
  <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                <div class="col-md-12">
                    <div class="el-element-overlay">
                        <div class="row">
                    @if ( isthisSubscribed() || getmanualfeatures('token_view_my_matches_'))
                    <div class="col-xs-12 col-md-12 sucessmessage"></div>
                        @if( $matches )
                            @foreach( $matches as $match )
                                 @php
                                    $userid = $match->user_id;
                                    if( $match->user_id == Auth::user()->id ){
                                        $userid = $match->matcher_id;
                                    }
                                    $userdata = \App\User::find($userid);
                                    $getFamilyRoleInfo = \App\UsersFamilyRole::where('user_id', $userid)->pluck('family_role_id')->toArray();
                                    if (count($getFamilyRoleInfo) > 0) {
                                       $familyroles = \App\FamilyRole::whereIn('id', $getFamilyRoleInfo)->get();
                                    } else {
                                       $familyroles = \App\FamilyRole::all();
                                    }

                                    // check Request sent or not
                                    $checkReq = \App\Trials::WhereRaw('( (user_id = ' . Auth::user()->id . ' && matcher_id = ' . $userid . ' ) OR (user_id = ' . $userid . ' && matcher_id = ' . Auth::user()->id . ' ))')->get()->last();

                                    if($checkReq){
                                      $adopter_family_role = FamilyRole::find($checkReq->trial_family_role)->title;
                                      $adopter_family_gender = (FamilyRole::find($checkReq->trial_family_role)->gender == 'female')  ? "she" : "he" ;
                                      $adoptee_family_role = FamilyRole::find($checkReq->adoptee_family_role)->title;
                                      $adoptee_family_gender = (FamilyRole::find($checkReq->adoptee_family_role)->gender == 'female')? "she" : "he";

                                      if(Auth::user()->id != $checkReq->user_id){

                                          $reciverUrl = url("userprofile").'/'.base64_encode($checkReq->user_id);
                                          $reciverName = $checkReq->userid->display_name_on_pages;
                                          $reciverLink = '<a href="'.$reciverUrl.'">'.$reciverName.'</a>';
                                          $adopt_message = "By signing this certificate, you promise to give ".$reciverLink." all of the love and care that ".$adoptee_family_gender."  require in return, your ".$adoptee_family_role." will give you all the love, comfort and attention you need. Failure to meet adoption requirements herein, may result in dissolution. ";
                                      }else{

                                          $reciverUrl = url("userprofile").'/'.base64_encode($checkReq->matcher_id);
                                          $reciverName = $checkReq->matcherid->display_name_on_pages;
                                          $reciverLink = '<a href="'.$reciverUrl.'">'.$reciverName.'</a>';
                                          $adopt_message = "By signing this certificate, you promise to give ".$reciverLink." all of the love and care that ".$adopter_family_gender." require in return, your ".$adopter_family_role." will give you all the love, comfort and attention you need. Failure to meet adoption requirements herein, may result in dissolution. ";
                                      }

                                    }

                                @endphp
                                @if( $userdata )

                                  <div class="col-lg-3 col-md-6">
                        <div class="card shadow_sec">
                          <a href="{{route('viewprofile', base64_encode( $userid ))}}" class="userProfileLinks">
                            <div class="el-card-item">
                                <div class="el-card-avatar el-overlay-1 img_outer_sec"> <img src="{{ $userdata->profile_pic_url  }}" /> @if( $userdata->is_online )
                                        <span class="green"></span>
                                    @endif
                                    <!-- <div class="el-overlay scrl-dwn">
                                        <ul class="el-info">
                                            <li><a class="btn default btn-outline image-popup-vertical-fit" href="{{ $userdata->profile_pic_url  }}"><i class="icon-magnifier"></i></a></li>
                                            <li><a class="btn default btn-outline" href="{{route('viewprofile', base64_encode( $userid ))}}"><i class="icon-link"></i></a></li>
                                        </ul>
                                    </div> -->
                                </div>
                                <div class="el-card-content">
                                    <h3 class="box-title">{{ ucfirst( $userdata->display_name_on_pages ) }}</h3> <small>{{ @$userdata->usergroup->title }}</small>
                                    <br/> </div>
                            </div>
                          </a>
                          @php


                          if($checkReq){
                            if ($checkReq->is_success == 1  && $checkReq->adoption_success != 1 ){
                              echo '<a class="btn btn-success" data-toggle="modal" id="btnModal'.$checkReq->id.'" data-target="#sendRequestBtn'.$checkReq->id.'"> Adopt </a>';
                          @endphp
                          <!-- Modal -->
                           <div class="modal fade" id="sendRequestBtn{{$checkReq->id}}" role="dialog">
                                 <div class="modal-dialog adptreq">
                                     <div class="modal-content">
                                         <!-- Modal Header -->
                                         <div class="modal-header align-items-center">
                                             <h4 class="modal-title" id="myModalLabel">Adopt Request</h4>
                                             <button type="button" class="close" data-dismiss="modal">
                                                 <span aria-hidden="true">&times;</span>
                                                 <span class="sr-only">Close</span>
                                             </button>
                                         </div>


                                         <div class="modal-body">
                                             <p class="statusMsg"></p>
                                             <form class="form-horizontal form_common submitAdoptForm" id="submitAdoptForm" role="form" name="submitAdoptForm" method="POST">
                                              <input type="hidden" name="trial" value="{{ $checkReq->id }}" id="trial"/>


                                               <div class="row">
                                                 <div class="form-group d-flex">
                                                    <div class="col-md-1">
                                                        <input type="checkbox" class="form-control checkbox" id="agree" name="agree">
                                                    </div>
                                                    <div class="col-md-11 terms">
                                                           <p>{!! @$adopt_message !!}</p>
                                                      </div>
                                                     </div>
                                                 </div>
                                                  <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                 <button type="button" class="btn btn-primary submitBtn" id="submit">Yes, Please</button>



                                             </form>
                                         </div>
                                         </div>

                                 </div>
                             </div>


                          @php


                            }
                          }else{
                            echo '<a class="btn btn-success" href="'.url('schedule').'/'.base64_encode($userid).'"> Trial Date</a>';
                          }

                          @endphp
                        </div>
                    </div>


                                @endif
                            @endforeach
                        @endif
                    @endif
                    </div>
                    </div>

   </div>
                        </div>
                    </div>
                </div>
                 </div>
        <!-- End Match Tabs -->

<script>
    $(document).ready(function(){
        $(".matches").click(function(){
            $('#trialid').val($(this).attr('table-id'));
            var userid = $(this).data('user');
            var imgSrc = $(this).find('img').attr('src');
            var href = $(this).find('a').attr('href');
            var popup = $("#myModal");
            popup.find("#macher_id").val(userid);
            popup.find(".macher_image").attr("src", imgSrc);
            popup.find(".matcher_name").text(href);
        });


            $("button#submit").click(function(e){
              e.preventDefault();
                var agree = 0;
                if ($('#agree').is(":checked"))
                {
                  agree = 1;
                }
                var id =$("#trial").val();
                $.ajax({
                    method: "POST",
                    url: "{{url('ajaxrequest/adopt-request')}}",
                    data: {
                        // adoptee_family_role: $("#adoptee_family_role").val(),
                        agree: agree,
                        trial: $("#trial").val(),
                        _token: "{{csrf_token()}}"
                    },
                })
                .done(function( data ) {
                console.log(data);
                if(data.status == 200){
                    $("#btnModal"+id).remove();
                    $(".sucessmessage").empty();
                    $(".sucessmessage").html("<h5 class='success'><i class='fa fa-check'> </i> "+data.message+"</h5>");
                    // $("#sendRequestBtn .modal-footer").empty();
                      $('#sendRequestBtn'+id).modal('toggle');
                    setInterval(function(){  $("#sendRequestBtn"+id).remove(); }, 1000);
                    //
                }else if(data.status == 400){
                    $("#sendRequestBtn"+id+" .modal-body .terms .failure").remove();
                    $("#sendRequestBtn"+id+" .modal-body .terms").append("<p class='failure'> "+data.message+"</p>");
                    $("#sendRequestBtn"+id+" .modal-footer").empty();
                }else{
                    $("#sendRequestBtn"+id+" .modal-body").html("<h5 class='failure'><i class='fa fa-check'> </i> "+data.message+"</h5>");
                    $("#sendRequestBtn"+id+" .modal-footer").empty();
                }
              //location.reload();
            });
          });
    });
</script>
<!-- End Main Content ---->
@endsection
@section('footer')
    @include('modals/trials-modals')
@endsection
