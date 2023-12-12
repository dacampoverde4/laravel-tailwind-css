@extends('admin.layout.master')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@section('content')
<style>
  label > span {
    font-size: 10px;
    line-height: 10px;
  }
</style>
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3><i class="fa fa-envelope"></i> Seeking Role</h3>
                        <hr>
                        @if (\Session::has('success'))
             <div class="alert alert-success">
                 {!! \Session::get('success') !!}
             </div>

         @endif
                        <form class="form-horizontal" role="form" method="POST" action="{{route('seekingrole.update',$seekingrole->id)}}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                             <div class="row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>

                                <div class="col-md-6">
                                    <input id="title"  type="title" class="form-control" name="title" value="{{ $seekingrole->title }}" required autofocus>
                                    @if ($errors->has('title'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            </div>
                            <div class="form-group{{ $errors->has('seeking_roles') ? ' has-error' : '' }}">
                                <div class="row">
                                <label for="role" class="col-md-4 col-form-label text-md-right">Seeking role<br><span>These are the family roles of adoptor</span></label>

                                <div class="col-md-6">
                                    <select class="form-control searchdropdown" multiple id="seeking_roles" name="seeking_roles[]" required="required">
                                    @foreach($familyroles as $row)
                                        @php
                                            $sel = '';
                                            $getseeking_roles = ($seekingrole->seeking_roles)? json_decode( $seekingrole->seeking_roles ) : array();
                                            if( in_array($row->id, $getseeking_roles) ){
                                                $sel = "selected='selected'";
                                            }
                                        @endphp
                                        <option {{ $sel }} value="{{ $row->id }}" ><?php echo $row->title ?></option>
                                    @endforeach
                                    @if ($errors->has('seeking_roles'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('seeking_roles') }}</strong>
                                        </span>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                            <div class="form-group{{ $errors->has('family_roles') ? ' has-error' : '' }}">
                                <div class="row">
                                <label for="role" class="col-md-4 col-form-label text-md-right">Family role<br><span>These are the family roles of adoptee</span></label>

                                <div class="col-md-6">
                                    <select class="form-control searchdropdown" multiple id="family_roles" name="family_roles[]" required="required">
                                    @foreach($familyroles as $row)
                                        @php
                                            $sel = '';
                                            $getfamily_roles = ($seekingrole->family_roles)? json_decode( $seekingrole->family_roles ) : array();
                                            if( in_array($row->id, $getfamily_roles) ){
                                                $sel = "selected='selected'";
                                            }
                                        @endphp
                                        <option {{ $sel }} value="{{ $row->id }}" ><?php echo $row->title ?></option>
                                    @endforeach
                                    @if ($errors->has('family_roles'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('family_roles') }}</strong>
                                        </span>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('usergroups') ? ' has-error' : '' }}">
                        <div class="row">
                        <label for="role" class="col-md-4 col-form-label text-md-right">User group<br><span>These are the usergroup of adoptee</span></label>

                        <div class="col-md-6">
                            <select class="form-control searchdropdown" multiple id="usergroups" name="usergroups[]" required="required">
                                @foreach($usergroups as $row)
                                    @php
                                        $sel = '';
                                        $getusergroups = ($seekingrole->usergroups)? json_decode( $seekingrole->usergroups ) : array();
                                        if( in_array($row->id, $getusergroups) ){
                                            $sel = "selected='selected'";
                                        }
                                    @endphp
                                    <option {{ $sel }} value="{{ $row->id }}" ><?php echo $row->title ?></option>
                                @endforeach
                                    @if ($errors->has('usergroups'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('usergroups') }}</strong>
                                        </span>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    {{-- MIN AGE --}}
                   <div class="form-group{{ $errors->has('minage') ? ' has-error' : '' }}">
                      <div class="row">
                        <label for="title" class="col-md-4 col-form-label text-md-right">Min Age</label>
                        <div class="col-md-6">
                            <input id="minage"  type="number" class="form-control" min="0" max="99" name="minage" value="{{ $seekingrole->minage }}" required autofocus>
                        </div>
                      </div>
                    </div>
                    @if ($errors->has('minage'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('minage') }}</strong>
                    </span>
                    @endif


                  {{-- MAX AGE  --}}
                    <div class="form-group{{ $errors->has('maxage') ? ' has-error' : '' }}">
                      <div class="row">
                        <label for="title" class="col-md-4 col-form-label text-md-right">Max Age</label>
                        <div class="col-md-6">
                            <input id="maxage"  type="number" class="form-control" min="0" max="99" name="maxage" value="{{ $seekingrole->maxage }}" required autofocus>
                        </div>
                      </div>
                    </div>
                    @if ($errors->has('maxage'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('maxage') }}</strong>
                    </span>
                    @endif

                        <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-9"><button type="submit" class="btn btn-success pull-right border_radius"><i class="fa fa-check"></i> Submit</button></div>
                                </div>
                            </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
