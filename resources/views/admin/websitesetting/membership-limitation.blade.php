@extends('layouts.master')

@section('main-content')
<div class="maincontent">
    <div class="content bgwhite">                       

        <!-- Start Upgrade Membership ---->
        <div class="membership">
            <div class="container-fluid">
                @php
                $grouptitle = App\Usergroup::find($id);
                @endphp
                
                    <h4 class="inline_block font20"><i class="fa fa-envelope"></i> Membership Limitations for {{ $grouptitle->title }}</h4>
                </div>
           <hr>
        </div>
        <!-- End Upgrade Membership ---->
        <!-- Start Message Tabs -->
        <div class="msgtabs pt50 websitemembership websitemembershipusergroup">
            <div class="container-fluid">
                <div class="token-amount">
                    <form class="form_inline fullwidth mtop40" method="POST" action="{{ route('saveWebsiteSetting') }}">
                        @csrf
                        <br>
                        <h3>Inbox Chat</h3>
                        <hr>
                        <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right"></label>
                                <div class="col-md-6">
                                    <input type="checkbox" class="checkbox" data-attr="#subscription" style="display: inline-table;width: 16px;height: 16px;" name="websiteSettings[message_issubscriptionenabled_{{$id}}]" value="1" @if( @$metaData['message_issubscriptionenabled_'.$id]=='1') checked @endif> Subscription
                                    <input type="checkbox" class="checkbox" data-attr="#tokencount" style="display: inline-table;width: 16px;height: 16px;" name="websiteSettings[message_istokenenabled_{{$id}}]" value="1" @if( @$metaData['message_istokenenabled_'.$id]=='1') checked @endif> Token
                                </div>
                        </div>
    					<div class="form-group row" id="subscription" style="display:none">
                                <label class="col-md-4 col-form-label text-md-right">Select Plan</label>
                                <div class="col-md-6">
                                    <select name="websiteSettings[message_selectplan_{{$id}}]" class="searchdropdown form-control" multiple>
                                        <option value="Profession">Profession</option>
                                        <option value="Enterprise">Enterprise</option>
                                        <option value="test">test</option>
                                    </select>
                        
                                </div>
                        </div>
                        <div class="form-group row" id="tokencount" style="display:none">
                                <label class="col-md-4 col-form-label text-md-right">No. of tokens have to purchase</label>
                                <div class="col-md-6">
                                    <input type="number" class="form-control" name="websiteSettings[message_notoken_{{$id}}]" value="{{ $metaData['message_notoken_'.$id] or '' }}" required="">
                                </div>
                        </div>
                        <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Monthly Max Connections</label>
                                <div class="col-md-6">
                                    <input type="number" class="form-control" name="websiteSettings[message_monthlymaxconnections_{{$id}}]" value="{{ $metaData['message_monthlymaxconnections_'.$id] or '' }}" required="">
                                </div>
                        </div>
                        <br>
                        <h3>Trial</h3>
                        <hr>
                        <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Trial Token</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="websiteSettings[message_trialtoken_{{$id}}]" value="{{ $metaData['message_trialtoken_'.$id] or '' }}" required="">
                                </div>
                        </div>
                        <br>
                         <h3>Display name change</h3>
                        <hr>
                        <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">How many time user will change</label>
                                <div class="col-md-6">
                                    <input type="number" class="form-control" name="websiteSettings[message_userchangedisplay_{{$id}}]" value="{{ $metaData['message_userchangedisplay_'.$id] or '' }}" required="">
                                </div>
                        </div>
                        <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right"></label>
                                <div class="col-md-6">
                                    <input type="checkbox" class="checkbox" data-attr="#subscriptiondisplayname" style="display: inline-table;width: 16px;height: 16px;" name="websiteSettings[message_issubscriptionenableddisplayname_{{$id}}]" value="1" @if( @$metaData['message_issubscriptionenableddisplayname_'.$id]=='1') checked @endif> Subscription
                                    <input type="checkbox" class="checkbox" data-attr="#tokencountdisplayname" style="display: inline-table;width: 16px;height: 16px;" name="websiteSettings[message_istokenenableddisplayname_{{$id}}]" value="1" @if( @$metaData['message_istokenenableddisplayname_'.$id]=='1') checked @endif> Token
                                </div>
                        </div>
    					<div class="form-group row" id="subscriptiondisplayname" style="display:none">
                                <label class="col-md-4 col-form-label text-md-right">Select Plan</label>
                                <div class="col-md-6">
                                    <select name="websiteSettings[message_selectplandisplayname_{{$id}}]" class="searchdropdown form-control" multiple>
                                        <option value="Profession">Profession</option>
                                        <option value="Enterprise">Enterprise</option>
                                        <option value="test">test</option>
                                    </select>
                        
                                </div>
                        </div>
                        <div class="form-group row" id="tokencountdisplayname" style="display:none">
                                <label class="col-md-4 col-form-label text-md-right">No. of tokens have to purchase</label>
                                <div class="col-md-6">
                                    <input type="number" class="form-control" name="websiteSettings[message_notokendisplayname_{{$id}}]" value="{{ $metaData['message_notokendisplayname_'.$id] or '' }}" required="">
                                </div>
                        </div>
                        <br>
                         <h3>Profile Visitors</h3>
                        <hr>
                        <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">No. of free profile visit</label>
                                <div class="col-md-6">
                                    <input type="number" class="form-control" name="websiteSettings[message_freeprofilevisit_{{$id}}]" value="{{ $metaData['message_freeprofilevisit_'.$id] or '' }}" required="">
                                </div>
                        </div>
                        <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right"></label>
                                <div class="col-md-6">
                                    <input type="checkbox" class="checkbox" data-attr="#subscriptionprofilevisitor" style="display: inline-table;width: 16px;height: 16px;" name="websiteSettings[message_issubscriptionenableddisplayname_{{$id}}]" value="1" @if( @$metaData['message_issubscriptionenableddisplayname_'.$id]=='1') checked @endif> Subscription
                                    <input type="checkbox" class="checkbox" data-attr="#tokencountprofilevisitor" style="display: inline-table;width: 16px;height: 16px;" name="websiteSettings[message_istokenenableddisplayname_{{$id}}]" value="1" @if( @$metaData['message_istokenenableddisplayname_'.$id]=='1') checked @endif> Token
                                </div>
                        </div>
    					<div class="form-group row" id="subscriptionprofilevisitor" style="display:none">
                                <label class="col-md-4 col-form-label text-md-right">Select Plan</label>
                                <div class="col-md-6">
                                    <select name="websiteSettings[message_selectplanprofilevisitor_{{$id}}]" class="searchdropdown form-control" multiple>
                                        <option value="Profession">Profession</option>
                                        <option value="Enterprise">Enterprise</option>
                                        <option value="test">test</option>
                                    </select>
                        
                                </div>
                        </div>
                        <div class="form-group row" id="tokencountprofilevisitor" style="display:none">
                                <label class="col-md-4 col-form-label text-md-right">No. of tokens have to purchase</label>
                                <div class="col-md-6">
                                    <input type="number" class="form-control" name="websiteSettings[message_notokenprofilevisitor_{{$id}}]" value="{{ $metaData['message_notokenprofilevisitor_'.$id] or '' }}" required="">
                                </div>
                        </div>
                        <br>
                         <h3>Change Profile Picture</h3>
                        <hr>
                        <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">How many time user change his picture</label>
                                <div class="col-md-6">
                                    <input type="number" class="form-control" name="websiteSettings[message_changeprofilepicno_{{$id}}]" value="{{ $metaData['message_changeprofilepicno_'.$id] or '' }}" required="">
                                </div>
                        </div>
                        <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Time duration to change his picture</label>
                                <div class="col-md-6">
                                    <input type="number" class="form-control" name="websiteSettings[message_changeprofiletime_{{$id}}]" value="{{ $metaData['message_changeprofiletime_'.$id] or '' }}" required="">
                                </div>
                        </div>
                        
                        <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">No. of free profile visit</label>
                                <div class="col-md-6">
                                    <input type="number" class="form-control" name="websiteSettings[message_freeprofilevisit_{{$id}}]" value="{{ $metaData['message_freeprofilevisit_'.$id] or '' }}" required="">
                                </div>
                        </div>
                        <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right"></label>
                                <div class="col-md-6">
                                    <input type="checkbox" class="checkbox" data-attr="#subscriptionprofilepicchange" style="display: inline-table;width: 16px;height: 16px;" name="websiteSettings[message_issubscriptionenableddisplayname_{{$id}}]" value="1" @if( @$metaData['message_issubscriptionenableddisplayname_'.$id]=='1') checked @endif> Subscription
                                    <input type="checkbox" class="checkbox" data-attr="#tokencountprofilepicchange" style="display: inline-table;width: 16px;height: 16px;" name="websiteSettings[message_istokenenableddisplayname_{{$id}}]" value="1" @if( @$metaData['message_istokenenableddisplayname_'.$id]=='1') checked @endif> Token
                                </div>
                        </div>
    					<div class="form-group row" id="subscriptionprofilepicchange" style="display:none">
                                <label class="col-md-4 col-form-label text-md-right">Select Plan</label>
                                <div class="col-md-6">
                                    <select name="websiteSettings[message_selectprofilepicchange_{{$id}}]" class="searchdropdown form-control" multiple>
                                        <option value="Profession">Profession</option>
                                        <option value="Enterprise">Enterprise</option>
                                        <option value="test">test</option>
                                    </select>
                        
                                </div>
                        </div>
                        <div class="form-group row" id="tokencountprofilepicchange" style="display:none">
                                <label class="col-md-4 col-form-label text-md-right">No. of tokens have to purchase</label>
                                <div class="col-md-6">
                                    <input type="number" class="form-control" name="websiteSettings[message_notokenprofilepicchange_{{$id}}]" value="{{ $metaData['message_notokenprofilepicchange_'.$id] or '' }}" required="">
                                </div>
                        </div>
                         <br>
                         <h3>No. of Photos allowed</h3>
                        <hr>
                        <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right"></label>
                                <div class="col-md-6">
                                    <input type="checkbox" class="checkbox" data-attr="#subscriptionphotosallowed" style="display: inline-table;width: 16px;height: 16px;" name="websiteSettings[message_issubscriptionenableddisplayname_{{$id}}]" value="1"  @if( @$metaData['message_issubscriptionenableddisplayname_'.$id]=='1') checked @endif> Subscription
                                    <input type="checkbox" class="checkbox" data-attr="#tokencountphotosallowed" style="display: inline-table;width: 16px;height: 16px;" name="websiteSettings[message_istokenenableddisplayname_{{$id}}]" value="1" @if( @$metaData['message_istokenenableddisplayname_'.$id]=='1') checked @endif> Token
                                </div>
                        </div>
    					<div class="form-group row" id="subscriptionphotosallowed" style="display:none">
                                <label class="col-md-4 col-form-label text-md-right">Select Plan</label>
                                <div class="col-md-6">
                                    <select name="websiteSettings[message_selectphotosallowed_{{$id}}]" class="searchdropdown form-control" multiple>
                                        <option value="Profession">Profession</option>
                                        <option value="Enterprise">Enterprise</option>
                                        <option value="test">test</option>
                                    </select>
                        
                                </div>
                        </div>
                        <div class="form-group row" id="tokencountphotosallowed" style="display:none">
                                <label class="col-md-4 col-form-label text-md-right">No. of tokens have to purchase</label>
                                <div class="col-md-6">
                                    <input type="number" class="form-control" name="websiteSettings[message_notokenphotosallowed_{{$id}}]" value="{{ $metaData['message_notokenphotosallowed_'.$id] or '' }}" required="">
                                </div>
                        </div>
                        <br>
                         <h3>Photos Album</h3>
                        <hr>
                        <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Max No. of photos upload by paid user </label>
                                <div class="col-md-6">
                                    <input type="number" class="form-control" name="websiteSettings[message_maxphotosupload_{{$id}}]" value="{{ $metaData['message_maxphotosupload_'.$id] or '' }}" required="">
                                </div>
                        </div>
                        <div class="col-md-10">
                            <button type="submit" class="btnpad btnred pull-right border_radius">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div> 

@endsection

@section('footer')
<script type="text/javascript">
    $(document).ready(function(){
        $(".websitemembership .checkbox").change(function() {
            var atr = $(this).attr('data-attr');
            if(this.checked) {
                $(atr).show();
            }
            else{
                $(atr).hide();
            }
        });
        $('.checkbox').each(function () {
            var atr = $(this).attr('data-attr');
            if(this.checked) {
                $(atr).show();
            }
            else{
                $(atr).hide();
            }
        });
    });
</script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.searchdropdown').select2({
            placeholder: 'select plan',
          multiple: true
        });
    });
</script>
@endsection
