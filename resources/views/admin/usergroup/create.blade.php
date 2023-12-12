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
                        <form class="form-horizontal form_common" role="form" method="POST" action="{{route('usergroup.store')}}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                          <div class="row">
                            <label for="title" class="col-md-3 col-form-label text-md-right">Title</label>
                            <div class="col-md-9">
                                <input id="title"  type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>
                            </div>
                          </div>
                        </div>
                        @if ($errors->has('title'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                        @endif
                        <div class="form-group{{ $errors->has('minage') ? ' has-error' : '' }}">
                          <div class="row">
                            <label for="agegroup" class="col-md-3 col-form-label text-md-right">Age(Min.)</label>
                            <div class="col-md-9">
                                <input id="minage"  type="number" class="form-control" name="minage" value="{{ old('minage') }}" required autofocus>
                            </div>
                          </div>
                        </div>
                        @if ($errors->has('minage'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('minage') }}</strong>
                            </span>
                        @endif

                         <div class="form-group{{ $errors->has('maxage') ? ' has-error' : '' }}">
                           <div class="row">
                            <label for="maxage" class="col-md-3 col-form-label text-md-right">Age(Max.)</label>
                            <div class="col-md-9">
                                <input id="maxage"  type="number" class="form-control" name="maxage" value="{{ old('maxage') }}" required autofocus>
                            </div>
                          </div>
                        </div>
                        @if ($errors->has('maxage'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('maxage') }}</strong>
                            </span>
                        @endif
                         <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                          <div class="row">
                            <label for="role" class="col-md-3 col-form-label text-md-right">Gender role</label>
                            <div class="col-md-9">
                                <select class="form-control searchdropdown" id="role" name="gender[]" multiple>
                                   @foreach($genderrole as $row)
                                    <option value="{{ $row->id }}"><?php echo $row->title ?></option>
                                   @endforeach
                                </select>
                           </div>
                         </div>
                        </div>
                        @if ($errors->has('gender'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('gender') }}</strong>
                            </span>
                        @endif

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                          <div class="row">
                           <label for="role" class="col-md-3 col-form-label text-md-right">Family role</label>
                           <div class="col-md-9">
                               <select class="form-control searchdropdown" id="frole" name="family[]" multiple>
                                  @foreach($familyrole as $row)
                                   <option value="{{ $row->id }}"><?php echo $row->title ?></option>
                                  @endforeach
                               </select>
                          </div>
                        </div>
                       </div>
                       @if ($errors->has('family'))
                           <span class="invalid-feedback">
                               <strong>{{ $errors->first('family') }}</strong>
                           </span>
                       @endif

                       <div class="form-group{{ $errors->has('adoption_roles') ? ' has-error' : '' }}">
                        <div class="row">
                          <label for="role" class="col-md-3 col-form-label text-md-right">Adoption<br><span>These are the family roles that the usergroup may adopt</span></label>
                          <div class="col-md-9">
                              <select class="form-control searchdropdown" id="adoption_roles" name="adoption_roles[]" multiple>
                                 @foreach($familyrole as $row)
                                  <option value="{{ $row->id }}"><?php echo $row->title ?></option>
                                 @endforeach
                              </select>
                         </div>
                      </div>
                    </div>
                      @if ($errors->has('adoption_roles'))
                          <span class="invalid-feedback">
                              <strong>{{ $errors->first('adoption_roles') }}</strong>
                          </span>
                      @endif

                      <div class="form-group{{ $errors->has('adoption_request_roles') ? ' has-error' : '' }}">
                        <div class="row">
                         <label for="role" class="col-md-3 col-form-label text-md-right">Request<br><span>These are the family roles that the usergroup may request adoption from</span></label>
                         <div class="col-md-9">
                             <select class="form-control searchdropdown" id="adoption_request_roles" name="adoption_request_roles[]" multiple>
                                @foreach($familyrole as $row)
                                 <option value="{{ $row->id }}"><?php echo $row->title ?></option>
                                @endforeach
                             </select>
                        </div>
                       </div>
                      </div>
                     @if ($errors->has('adoption_request_roles'))
                         <span class="invalid-feedback">
                             <strong>{{ $errors->first('adoption_request_roles') }}</strong>
                         </span>
                     @endif

                     <div class="form-group{{ $errors->has('huds') ? ' has-error' : '' }}">
                       <div class="row">
                        <label for="role" class="col-md-3 col-form-label text-md-right">HUDs<br><span>These are the huds that a usergroup can view.</span></label>
                        <div class="col-md-9">
                            <select class="form-control searchdropdown" id="huds" name="huds[]" multiple>
                               @foreach($huds as $row)
                                <option value="{{ $row->id }}"><?php echo $row->title ?></option>
                               @endforeach
                            </select>
                       </div>
                      </div>
                     </div>
                    @if ($errors->has('huds'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('huds') }}</strong>
                        </span>
                    @endif

                        <div class="form-group{{ $errors->has('plans') ? ' has-error' : '' }}">
                           <div class="row">
                            <label for="plans" class="col-md-3 col-form-label text-md-right">Membership Plans</label>
                            <div class="col-md-9">
                                <select class="form-control searchdropdown" id="plans" name="plans[]" multiple>
                                   @foreach($plans as $plan)
                                    <option value="{{ $plan->id }}"><?php echo $plan->name ?></option>
                                   @endforeach
                                </select>
                           </div>
                        </div>
                      </div>

                        <div class="form-group{{ $errors->has('tags') ? ' has-error' : '' }}">
                          <div class="row">
                            <label for="tags" class="col-md-3 col-form-label text-md-right">Group Tag</label>
                            <div class="col-md-9">
                                <select name="tags" class="form-control">
                                    @foreach($usergroupstags as $usergroupstag)
                                        <option value="{{ $usergroupstag->id }}">{{ $usergroupstag->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                      </div>
                        @if ($errors->has('tags'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('tags') }}</strong>
                        </span>
                        @endif

                        <div class="form-group{{ $errors->has('sort') ? ' has-error' : '' }}">
                           <div class="row">
                                <label for="sort" class="col-md-3 col-form-label text-md-right">Sort <small>(Enter a Number)</small></label>
                                <div class="col-md-9">
                                    <input id="sort"  type="number" class="form-control" name="sort" value="" min="0" required autofocus>
                                </div>
                            </div>
                        </div>
                        @if ($errors->has('sort'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('sort') }}</strong>
                        </span>
                        @endif
                        <div class="form-group{{ $errors->has('visible_relationship') ? ' has-error' : '' }}">
                           <div class="row">
                                <label for="visible_relationship" class="col-md-3 col-form-label text-md-right">Visible Relationship </label>
                                <div class="col-md-1" style="padding-left:0;margin-left: 14px;">
                                    <input id="visible_relationship"  type="checkbox" class="form-control" name="visible_relationship" value="1">
                                </div>
                            </div>
                        </div>
                        @if ($errors->has('visible_relationship'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('visible_relationship') }}</strong>
                        </span>
                        @endif
                        <div class="form-group{{ $errors->has('visible_occupation') ? ' has-error' : '' }}">
                           <div class="row">
                                <label for="visible_occupation" class="col-md-3 col-form-label text-md-right">Visible Occupation </label>
                                <div class="col-md-1" style="padding-left:0;margin-left: 14px;">
                                    <input id="visible_occupation"  type="checkbox" class="form-control" name="visible_occupation" value="1">
                                </div>
                            </div>
                        </div>
                        @if ($errors->has('visible_occupation'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('visible_occupation') }}</strong>
                        </span>
                        @endif

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
            placeholder: 'select',
          multiple: true
        });
    });
</script>
@endsection
