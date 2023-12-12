@extends('layouts.master')

@section('main-content')
<link rel="stylesheet" type="text/css" href="{{ asset('user/css/message_style.css') }}">


    <div class="container-fluid page-titles m-b-0">
        <div class="row">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor"><img src="{{ asset('backend/images/message.png') }}" alt="Report" title="Img"
                                                 class="all_users">&nbsp; Message</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Message</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="container-fluid">


        <!-- Start Upgrade Membership ---->

        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- <button type="button" class="btn btn-primary btnred pull-right leave_note" data-toggle="modal" data-id="1"
                data-target="#myModalNote">Compose
        </button> --}}

        @if ( !isthisSubscribed() )
            <div class="row mtop30 upgrade">
                <div class="col-md-10">
                    <div class="upgdinfo bggray font300">
                        <p>Hey John! It will cost 1 token to open a conversation withi Amy. Upgrade your membership to
                            send ullimited messages</p>
                    </div>
                </div>
                <div class="col-md-2">
                    <a style="padding: 18px 0px;" href="{{ url('pricing') }}" class="btn btnred width100">Upgrade
                        Membership</a>
                </div>
            </div>
        @endif





    <!-- End Upgrade Membership ---->
        @if ( isthisSubscribed() )
            
            <ul class="actionbtns">
                <li style="display:none" class="deletebtn"><a href="javascript:void(0)" class="btn btnred btn-danger btnpad ml20"> <i class="fa fa-trash" aria-hidden="true"></i> Trash</a>
                </li>
            </ul>
            <strong><h5 class="mt10">How do you break the ice with someone you like? Pass them a Note!</h5></strong>
            
            <!-- Start Message Tabs -->
            <div class="card tab_sec msg_tab_content">
                <div class="row">
                    <div class="col-md-5 pr0">
                        <ul class="nav nav-tabs customtab" role="tablist">
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#inbox" role="tab"><span
                                            class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Inbox</span></a>
                            </li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#sent" role="tab"><span
                                            class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Sent</span></a>
                            </li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#drafts" role="tab"><span
                                            class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Drafts</span></a>
                            </li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#trash" role="tab"><span
                                            class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Trash</span></a>
                            </li>
                        </ul>
                        <form method="post" action="{{ route('messages.delete') }}">
                @csrf
                <input type="hidden" value="" id="ids" name="ids">
                <input type="hidden" value="1" id="getcolumn" name="getcolumn">
                <input type="submit" id="fire" style="visibility: hidden;">
            </form>
                    </div>
                    <div class="col-md-7">
                        <div class="adsimgsec ads_728_90_size ptb10">
                            <img src="{{ url('/images/728x90.png')}}" class="img-responsive">
                        </div>
                    </div>
                </div>
                

                <div class="tab-content">
                    <div id="inbox" class="tab-pane  active" role="tabpanel">
                        @if ($inboxmessages->count() > 0)
                        @foreach($inboxmessages as $inboxmessage)
                            @if($inboxmessage->user)
                                @php
                                    $parent_message = App\UserMessage::find($inboxmessage->parent_id);
                                @endphp
                                <div class="tabrow">
                                    <div class="row">
                                        <div class="col-xs-12 col-md-3 col-sm-3">
                                            <div class="tabrow-user">
                                                <label>
                                                    <input type="checkbox" value="{{ $inboxmessage->id }}"
                                                           name="inboxmessage[]"/>
                                                    <i></i>
                                                </label>
                                                <a class="text-muted waves-effect waves-dark" href="{{ route('viewprofile', base64_encode($inboxmessage->user_id)) }}">
                                                    <img src="{{url('/uploads/'.$inboxmessage->user->profile_pic)}}" alt="user" class="profile_pic msg_user_profile" />
                                                </a>
                                                <a class="text" href="{{ route('viewprofile', base64_encode($inboxmessage->user_id)) }}">
                                                    {{ $inboxmessage->user->display_name_on_pages }}
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-6 col-sm-6">

                                            <div id="inboxmsgtext_{{ $inboxmessage->id }}" style="display: none;">{!! $inboxmessage->message !!}</div>
                                            <div data-toggle="modal" href="#myModalNote" style="cursor: pointer;" data-id="{{ $inboxmessage->id }}"
                                                data-message="{{ $inboxmessage->message }}" data-sender="{{ $inboxmessage->user_id }}" data-parent="{{ $parent_message['message'] }}" data-messagetype="{{ $inboxmessage->type }}">
                                                {!! $inboxmessage->message !!}</div>
                                            {{-- @if (!empty($parent_message))
                                                <hr>
                                                <p>{{ $parent_message['message'] }}</p>
                                            @endif --}}
                                        </div>
                                        <div class="col-xs-4 col-md-1 col-sm-3">{{ $inboxmessage->created_at->format('H:i') }}</div>
                                        <div class="col-xs-4 col-md-1 col-sm-3 text-center">
                                            <a href="{{route('messages.singlemsgdelete',$inboxmessage->id)}}" title="Delete">
                                                <i class="fa fa-trash text-danger"></i>
                                            </a>
                                        </div>
                                        <div class="col-xs-4 col-md-1 col-sm-1 text-center">
                                            <a data-tooltip="tolltip" data-placement="left" title="Reply" data-toggle="modal" href="#myModalNote" class="fa fa-mail-reply fa-lg" style="cursor: pointer;" data-id="{{ $inboxmessage->id }}"
                                                data-message="{{ $inboxmessage->message }}" data-sender="{{ $inboxmessage->user_id }}" data-messagetype="{{ $inboxmessage->type }}"></a>
                                        </div>
                                    </div>
                                </div>
                            @else
                                @php
                                    $parent_message = App\UserMessage::find($inboxmessage->parent_id);
                                @endphp
                                <div class="tabrow">
                                    <div class="row">
                                        <div class="col-md-3 col-sm-3">
                                            <div class="tabrow-user">
                                                <label>
                                                    <input type="checkbox" value="{{ $inboxmessage->id }}"
                                                           name="inboxmessage[]"/>
                                                    <i></i>
                                                </label>
                                                <img src="{{url('/uploads/default.png')}}" alt="user" class="profile_pic" />
                                                Unknown
                                            </div>
                                        </div>
                                        <div class="col-md-7 col-sm-6">
                                            {!! $inboxmessage->message !!}
                                            {{-- @if (!empty($parent_message))
                                                <hr>
                                                <p>{{ $parent_message['message'] }}</p>
                                            @endif --}}
                                        </div>
                                        <div class="col-md-1 col-sm-3">{{ $inboxmessage->created_at->format('H:i') }}</div>
                                    </div>
                                </div>
                                @endif
                        @endforeach
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                {{ $inboxmessages->appends(request()->query())->links() }}
                            </div>
                        </div>
                        
                    @else
                    <div class="tabrow">
                        <div class="row">
                            <div class="col-md-12">
                                    <p class="text-center">You have no new messages in the inbox.</p>
                            </div>
                        </div>
                    </div>
                    @endif
                    </div>
                    <div id="sent" class="tab-pane" role="tabpanel">
                        @if ($sentmessages->count() > 0)
                        @foreach($sentmessages as $sentmessage)
                            @if( $sentmessage->reciever)
                                @php
                                    $parent_message = App\UserMessage::find($sentmessage->parent_id);
                                @endphp
                                <div class="tabrow">
                                    <div class="row">
                                        <div class="col-md-3 col-sm-3">
                                            <div class="tabrow-user">
                                                <label>
                                                    <input type="checkbox" value="{{ $sentmessage->id }}"
                                                           name="inboxmessage[]"/>
                                                    <i></i>
                                                </label>
                                                <a class="text-muted waves-effect waves-dark" href="{{ route('viewprofile', base64_encode($sentmessage->reciever_id)) }}">
                                                   <img src="{{url('/uploads/'.$sentmessage->reciever->profile_pic)}}" alt="user" class="profile_pic" />
                                               </a>
                                               <a class="text" href="{{ route('viewprofile', base64_encode($sentmessage->reciever_id)) }}">
                                                   {{ $sentmessage->reciever->display_name_on_pages }}
                                               </a>
                                           </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            {!! $sentmessage->message !!}
                                            {{-- @if (!empty($parent_message))
                                                <hr>
                                                <p>{{ $parent_message['message'] }}</p>
                                            @endif --}}
                                        </div>
                                        <div class="col-md-3 col-sm-3 text-right">{{ $sentmessage->created_at->format('H:i') }}</div>
                                    </div>
                                </div>
                            @else
                                @php
                                    $parent_message = App\UserMessage::find($sentmessage->parent_id);
                                @endphp
                                <div class="tabrow">
                                    <div class="row">
                                        <div class="col-md-3 col-sm-3">
                                            <div class="tabrow-user">
                                                <label>
                                                    <input type="checkbox" value="{{ $sentmessage->id }}"
                                                           name="inboxmessage[]"/>
                                                    <i></i>
                                                </label>
                                                <img src="{{url('/uploads/default.png')}}" alt="user" class="profile_pic" />
                                                Unknown
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            {!! $sentmessage->message !!}
                                            {{-- @if (!empty($parent_message))
                                                <hr>
                                                <p>{{ $parent_message['message'] }}</p>
                                            @endif --}}
                                        </div>
                                        <div class="col-md-3 col-sm-3 text-right">{{ $sentmessage->created_at->format('H:i') }}</div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                {{ $sentmessages->appends(request()->query())->links() }}
                            </div>
                        </div>

                        @else
                            <div class="tabrow">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="text-center">You have not sent any messages yet.</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div id="drafts" class="tab-pane" role="tabpanel">
                      <div class="tabrow">
                          <div class="row">
                              <div class="col-md-12">
                                  <p class="text-center">Your Draft is empty.</p>
                              </div>
                          </div>
                      </div>
                    </div>
                    <div id="trash" class="tab-pane" role="tabpanel">
                        @if ($trashmessages->count() > 0)
                        @foreach($trashmessages as $trashmessage)
                            @if( $trashmessage->user)
                                @php
                                    $parent_message = App\UserMessage::find($trashmessage->parent_id);
                                @endphp
                                <div class="tabrow">
                                    <div class="row">
                                        <div class="col-md-3 col-sm-3">
                                            <div class="tabrow-user">
                                                <label>
                                                    <input type="checkbox" value="{{ $trashmessage->id }}"
                                                           name="inboxmessage[]"/>
                                                    <i></i>
                                                </label>
                                                <a class="text-muted waves-effect waves-dark" href="{{ route('viewprofile', base64_encode($trashmessage->user_id)) }}">
                                                   <img src="{{url('/uploads/'.$trashmessage->user->profile_pic)}}" alt="user" class="profile_pic" />
                                               </a>
                                               <a class="text" href="{{ route('viewprofile', base64_encode($trashmessage->user_id)) }}">
                                                   {{ $trashmessage->user->display_name_on_pages }}
                                               </a>
                                           </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            {!! $trashmessage->message !!}
                                            {{-- @if (!empty($parent_message))
                                                <hr>
                                                <p>{{ $parent_message['message'] }}</p>
                                            @endif --}}
                                        </div>
                                        <div class="col-md-3 col-sm-3 text-right">{{ $trashmessage->created_at->format('H:i') }}</div>
                                    </div>
                                </div>
                            @else
                                @php
                                    $parent_message = App\UserMessage::find($trashmessage->parent_id);
                                @endphp
                                <div class="tabrow">
                                    <div class="row">
                                        <div class="col-md-3 col-sm-3">
                                            <div class="tabrow-user">
                                            <label>
                                                <input type="checkbox" value="{{ $trashmessage->id }}"
                                                       name="inboxmessage[]"/>
                                                <i></i>
                                            </label>
                                            <img src="{{url('/uploads/default.png')}}" alt="user" class="profile_pic" />
                                            Unknown
                                        </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            {!! $trashmessage->message !!}
                                            {{-- @if (!empty($parent_message))
                                                <hr>
                                                <p>{{ $parent_message['message'] }}</p>
                                            @endif --}}
                                        </div>
                                        <div class="col-md-3 col-sm-3 text-right">{{ $trashmessage->created_at->format('H:i') }}</div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                {{ $trashmessages->appends(request()->query())->links() }}
                            </div>
                        </div>
                        
                        @else
                            <div class="tabrow">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="text-center">Your trash is empty.</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

    @endif
    <!-- End Message Tabs -->


        <div class="modal fade" id="myModalNote">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title inline_block">Send Message</h2>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                @php
                    $matches = App\Match::WhereRaw( ' is_match = 1 AND ( user_id = ' . Auth::user()->id .' OR  matcher_id = ' . Auth::user()->id .' )' )
                            ->get();
                @endphp
                <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group">
                        <form class="form-group" action="{{ route('messages.reply') }}" method="post">
                            @csrf
                            <input type="hidden" name="parent_id" id="parent_id" />
                            <input type="hidden" name="sender_id" id="sender_id"/>
                            <label for="recieved_message">Recieved Message</label> </br>
                            {{-- <input type="text" name="recieved_message" id="recieved_message" readonly/></br> </br> --}}
                            {{-- <textarea class="form-control" name="recieved_message" id="recieved_message" rows="3" cols="80" readonly></textarea></br> --}}
                            <div class="text">
                                <p id="recieved_message" name="recieved_message"></p>
                                <hr>
                                <p id="parent_message" name="parent_message"></p>
                            </div>
                            {{-- <p name="recieved_message" id="recieved_message"></p> --}}
                            <input type="hidden" value="{{ ucfirst( Auth::user()->id ) }}" name="reciever_id"/>

                            <div class="note_sec">
                                <label class="col-form-label mtop20">Note</label>
                                <input type="hidden" id="hiddenid" value="0">
                                <select name="note" id="noteselect" class="form-control">
                                    @php
                                        $notes = App\Note::where('user_group', Auth::user()->group)->get();
                                        foreach($notes as $note){
                                            echo '<option value="'.$note->note.'">'.$note->note.'</option>';
                                        }
                                    @endphp
                                    @if ( isthisSubscribed() )
                                        <option value="other">Other</option>
                                    @endif
                                </select>
                                @if ( isthisSubscribed() )
                                    <div class="textareanote"></div>
                                @else

                                @endif
                                <br>
                                {{-- <label for="reply_message">Reply Message</label> </br>
                                <textarea name="reply_message" rows="3" cols="80"></textarea> </br> </br> --}}
                                <input type="submit" class="btn-primary btnpad btnred border_radius" value="Reply">
                            </div>
                        </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script type="text/javascript">

        $(document).ready(function () {
            $("ul.actionbtns").hide();

            $("#noteselect").change(function () {
                var selectvalue = $("#noteselect option:selected").val();
                if (selectvalue == 'other') {
                    $(this).remove();
                    $('.textareanote').append('<textarea type="text" class="form-control" name="note"></textarea>');
                }
            });

            $("ul.tablist li").click(function () {
                $(".tab-content input").prop('checked', false);
                $('#ids').val(' ');
            });
            $("#inbox input, #sent input, #drafts input").change(function () {
                var checkboxes = [];
                $('.tab-content input:checked').each(function () {
                    checkboxes.push($(this).val());
                });
                $('#ids').val(checkboxes);
                if ($(".tab-content input:checkbox:checked").length > 0) {
                    $('.deletebtn').fadeIn();
                    $("ul.actionbtns").show();
                } else {
                    $('.deletebtn').fadeOut();
                    $("ul.actionbtns").hide();

                }
            });
            $(".deletebtn").click(function () {
                $('#fire').trigger('click');

            });
            $(".tablist li").click(function () {
                $('#getcolumn').val('');
            });
            $(".tablist li:first-child").click(function () {
                $('#getcolumn').val('1');
            });
            $(".tablist li:nth-child(2)").click(function () {
                $('#getcolumn').val('2');
            });
            $("#trash input").change(function () {
                var checkboxes = [];
                $('.tab-content input:checked').each(function () {
                    checkboxes.push($(this).val());
                });
                $('#ids').val(checkboxes);
                if ($(".tab-content input:checkbox:checked").length > 0) {
                    $('.deletebtn a').html('<i class="fa fa-undo"></i> Restore');
                    $('.deletebtn').show();
                    $('#getcolumn').val('3');
                } else {
                    $('.deletebtn').hide();
                }
            });

        });


    </script>

    <script>
        $(document).ready(function () {
            jQuery('ul.nav-tabs li a').click(function () {
                jQuery('.tab-pane').removeClass('fade active show');
                var id = jQuery(this).attr('href');
                jQuery(id).addClass('fade active show');
            });
        });
    </script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.searchdropdown').select2({
                multiple: true
            });
        });

        $(function () {
            $('#myModalNote').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var parent_id = button.data('id'); // Extract info from data-* attributes
                var recieved_message = button.data('message'); // Extract info from data-* attributes
                var inboxmsgtext = $("#inboxmsgtext_"+parent_id).text();
                var sender_id = button.data('sender');
                var parent_messsage = button.data('parent');
                var message_type = button.data('messagetype');
                console.log(parent_id, " inboxmsgtext == ",inboxmsgtext);
                if(message_type == 'message_notification'){
                    $(".note_sec").css("display", "none");
                }else{
                    $(".note_sec").css("display", "block");
                }
                // alert(parent_id+"|"+recieved_message+"|"+sender_id);
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this);
                modal.find('#parent_id').val(parent_id);
                $('#sender_id').val(sender_id);
                modal.find('#recieved_message').text(inboxmsgtext);
                $('#parent_message').text(parent_messsage);
            });
        });
        $(document).ready(function(){
            $('[data-tooltip="tooltip"]').tooltip();
        });
    </script>
@endsection
