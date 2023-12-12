@extends('admin.layout.master')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@section('content')
<style>
  label > span {
    font-size: 10px;
    line-height: 10px;
  }
  #visible_relationship, #visible_occupation{
      left:unset;
      opacity:1;
      width: 32px;
      height: 32px;
  }
</style>
  <div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                         <h3><b class="vertical_align"><i class="fa fa-envelope"></i>User Group</b></h3>
                         <hr>


                        <form class="form-horizontal" role="form" method="POST" action="{{route('usergroup.update',$usergroup->id)}}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                             <div class="row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>

                                <div class="col-md-6">
                                    <input id="title"  type="title" class="form-control" name="title" value="{{ $usergroup->title }}" required autofocus>
                                    @if ($errors->has('title'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <div class="row">
                                <label for="minage" class="col-md-4 col-form-label text-md-right">Age(Min.)</label>

                                <div class="col-md-6">
                                    <input id="minage"  type="number" class="form-control" name="minage" value="{{ $usergroup->minage }}" required autofocus>
                                    @if ($errors->has('minage'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('minage') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <div class="row">
                                <label for="maxage" class="col-md-4 col-form-label text-md-right">Age(Max.)</label>

                                <div class="col-md-6">
                                    <input id="maxage"  type="number" class="form-control" name="maxage" value="{{ $usergroup->maxage }}" required autofocus>
                                </div>
                                @if ($errors->has('maxage'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('maxage') }}</strong>
                                    </span>
                                @endif
                            </div>
                          </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <div class="row">
                                <label for="role" class="col-md-4 col-form-label text-md-right">Gender role</label>

                                <div class="col-md-6">
                                    <select class="form-control searchdropdown" multiple id="role" name="gender[]" required="required">
                                    @foreach($role as $row)
                                        @php
                                            $sel = '';
                                            $getgenderrole = ($usergroup->genderrole)? json_decode( $usergroup->genderrole ) : array();
                                            if( in_array($row->id, $getgenderrole) ){
                                                $sel = "selected='selected'";
                                            }
                                        @endphp
                                        <option {{ $sel }} value="{{ $row->id }}" ><?php echo $row->title ?></option>
                                    @endforeach
                                    @if ($errors->has('gender'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('gender') }}</strong>
                                        </span>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">Family role</label>

                            <div class="col-md-6">
                                <select class="form-control searchdropdown" multiple id="frole" name="family[]" required="required">
                                @foreach($frole as $row)
                                    @php
                                        $sel = '';
                                        $getfamily_roles = ($usergroup->family_roles)? json_decode( $usergroup->family_roles ) : array();
                                        if( in_array($row->id, $getfamily_roles) ){
                                            $sel = "selected='selected'";
                                        }
                                    @endphp
                                    <option {{ $sel }} value="{{ $row->id }}" ><?php echo $row->title ?></option>
                                @endforeach
                                @if ($errors->has('family'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('family') }}</strong>
                                    </span>
                                @endif
                            </select>
                        </div>
                    </div>
                </div>

                   <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <div class="row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">Adoption<br><span>These are the family roles that the usergroup may adopt</span></label>

                              <div class="col-md-6">
                                        <select class="form-control searchdropdown" multiple id="arole" name="adoption_roles[]" required="required">
                                              @foreach($frole as $arow)
                                                    @php
                                                    $sel = '';
                                                    $get_adoption_roles = ($usergroup->adoption_roles)? json_decode( $usergroup->adoption_roles ) : array();
                                                    if( in_array($arow->id, $get_adoption_roles) ){
                                                          $sel = "selected='selected'";
                                                      }
                                                  @endphp
                                                  <option {{ $sel }} value="{{ $arow->id }}" ><?php echo $arow->title ?></option>
                                                  @endforeach
                                                @if ($errors->has('adoption_roles'))
                                                    <span class="invalid-feedback">
                                                            <strong>{{ $errors->first('adoption_roles') }}</strong>
                                                    </span>
                                                @endif
                                        </select>
                          </div>
                      </div>
               </div>
               <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <div class="row">
                       <label for="role" class="col-md-4 col-form-label text-md-right">Request<br><span>These are the family roles that the usergroup may request adoption from</span></label>

                                               <div class="col-md-6">
                                                       <select class="form-control searchdropdown" multiple id="rrole" name="adoption_request_roles[]" required="required">
                                                       @foreach($frole as $rrow)
                                                           @php
                                                              $sel = '';
                                                              $get_adoption_request_roles = ($usergroup->adoption_request_roles)? json_decode( $usergroup->adoption_request_roles ) : array();
                                                                 if( in_array($rrow->id, $get_adoption_request_roles) ){
                                                                       $sel = "selected='selected'";
                                                                   }
                                                             @endphp
                                                       <option {{ $sel }} value="{{ $rrow->id }}" ><?php echo $rrow->title ?></option>
                                                             @endforeach
                                                               @if ($errors->has('adoption_request_roles'))
                                                                     <span class="invalid-feedback">
                                                                         <strong>{{ $errors->first('adoption_request_roles') }}</strong>
                                                                     </span>
                                                               @endif
                                                         </select>
                                                   </div>
              </div>
          </div>
          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
           <div class="row">
                  <label for="role" class="col-md-4 col-form-label text-md-right">HUDs<br><span>These are the huds that a usergroup can view.</span></label>

                                          <div class="col-md-6">
                                                  <select class="form-control searchdropdown" multiple id="huds" name="huds[]" required="required">
                                                  @foreach($huds as $row)
                                                      @php
                                                         $sel = '';
                                                         $get_huds = ($usergroup->huds)? json_decode( $usergroup->huds ) : array();
                                                            if( in_array($row->id, $get_huds) ){
                                                                  $sel = "selected='selected'";
                                                              }
                                                        @endphp
                                                  <option {{ $sel }} value="{{ $row->id }}" ><?php echo $row->title ?></option>
                                                        @endforeach
                                                          @if ($errors->has('huds'))
                                                                <span class="invalid-feedback">
                                                                    <strong>{{ $errors->first('huds') }}</strong>
                                                                </span>
                                                          @endif
                                                    </select>
                                              </div>
         </div>
     </div>
                        <div class="form-group{{ $errors->has('plans') ? ' has-error' : '' }}">
                          <div class="row">
                             <label for="Plan" class="col-md-4 col-form-label text-md-right">MemberShip Plan</label>
                                <div class="col-md-6">
                                <select class="form-control searchdropdown" id="plans" name="plans[]" multiple>
                                    @foreach($plans as $row)
                                        @php
                                            $sel = '';
                                            $getplans = ($usergroup->membership_plans)? json_decode( $usergroup->membership_plans ) : array();
                                            if( in_array($row->id, $getplans) ){
                                                $sel = "selected='selected'";
                                            }
                                        @endphp
                                        <option {{ $sel }} value="{{ $row->id }}" ><?php echo $row->name ?></option>
                                    @endforeach
                                </select>
                           </div>
                        </div>
                    </div>
                        <div class="form-group{{ $errors->has('tags') ? ' has-error' : '' }}">
                            <div class="row">
                                <label for="maxage" class="col-md-4 col-form-label text-md-right">Group Tag</label>

                                <div class="col-md-6">
                                    <select name="tags" class="form-control">
                                    @foreach($usergroupstags as $usergroupstag)
                                        <option @if($usergroup->tags == $usergroupstag->id) selected @endif value="{{ $usergroupstag->id }}">{{ $usergroupstag->title }}</option>
                                    @endforeach
                                </select>
                                </div>
                                @if ($errors->has('tags'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('tags') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('sort') ? ' has-error' : '' }}">
                            <div class="row">
                                <label for="sort" class="col-md-4 col-form-label text-md-right">Sort <small>(Enter a number)</small></label>

                                <div class="col-md-6">
                                    <input id="sort"  type="number" class="form-control" name="sort" value="{{ $usergroup->sort }}" min="0" required autofocus>
                                </div>
                                @if ($errors->has('sort'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('sort') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('visible_relationship') ? ' has-error' : '' }}">
                           <div class="row">
                                <label for="visible_relationship" class="col-md-4 col-form-label text-md-right">Visible Relationship </label>
                                <div class="col-md-1" style="padding-left:0;margin-left: 14px;">
                                @php 
                                    $sel = '';
                                    if($usergroup->visible_relationship == "1") 
                                        $sel ='checked="checked"';
                                @endphp
                                    <input id="visible_relationship"  {{$sel}} type="checkbox" class="form-control" name="visible_relationship" value="1">
                                </div>
                                @if ($errors->has('visible_relationship'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('visible_relationship') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('visible_occupation') ? ' has-error' : '' }}">
                           <div class="row">
                                <label for="visible_occupation" class="col-md-4 col-form-label text-md-right">Visible Occupation </label>
                                <div class="col-md-1" style="padding-left:0;margin-left: 14px;">
                                @php 
                                    $sel = '';
                                    if($usergroup->visible_occupation == "1") 
                                        $sel ='checked="checked"';
                                @endphp
                                    <input id="visible_occupation"   {{$sel}} type="checkbox" class="form-control" name="visible_occupation" value="1">
                                </div>
                                @if ($errors->has('visible_occupation'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('visible_occupation') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 ">
                                <button type="submit" class="btn btn-success width pull-right">
                                    Submit
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

@endsection

@section('page_js')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.searchdropdown').select2({
            placeholder: 'select role',
          multiple: true
        });
    });
</script>
@endsection
