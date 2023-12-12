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
                        <h3><i class="fa fa-envelope"></i>Seeking Role</h3>
                        <hr>
                        <form class="form-horizontal form_common" role="form" method="POST" action="{{route('seekingrole.store')}}">
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
                            <div class="form-group{{ $errors->has('seeking_roles') ? ' has-error' : '' }}">
                              <div class="row">
                               <label for="role" class="col-md-3 col-form-label text-md-right">Seeking role<br><span>These are the family roles of adoptor</span></label>
                               <div class="col-md-9">
                                   <select class="form-control searchdropdown" id="seeking_roles" name="seeking_roles[]" multiple>
                                      @foreach($familyroles as $row)
                                       <option value="{{ $row->id }}"><?php echo $row->title ?></option>
                                      @endforeach
                                   </select>
                              </div>
                            </div>
                           </div>
                           @if ($errors->has('seeking_roles'))
                               <span class="invalid-feedback">
                                   <strong>{{ $errors->first('seeking_roles') }}</strong>
                               </span>
                           @endif
                            <div class="form-group{{ $errors->has('family_roles') ? ' has-error' : '' }}">
                              <div class="row">
                               <label for="role" class="col-md-3 col-form-label text-md-right">Family role<br><span>These are the family roles of adoptee</span></label>
                               <div class="col-md-9">
                                   <select class="form-control searchdropdown" id="family_roles" name="family_roles[]" multiple>
                                      @foreach($familyroles as $row)
                                       <option value="{{ $row->id }}"><?php echo $row->title ?></option>
                                      @endforeach
                                   </select>
                              </div>
                            </div>
                           </div>
                           @if ($errors->has('family_roles'))
                               <span class="invalid-feedback">
                                   <strong>{{ $errors->first('family_roles') }}</strong>
                               </span>
                           @endif

                           <div class="form-group{{ $errors->has('usergroups') ? ' has-error' : '' }}">
                             <div class="row">
                              <label for="role" class="col-md-3 col-form-label text-md-right">User group<br><span>These are the usergroup of adoptee</span></label>
                              <div class="col-md-9">
                                  <select class="form-control searchdropdown" id="usergroups" name="usergroups[]" multiple>
                                     @foreach($usergroups as $row)
                                      <option value="{{ $row->id }}"><?php echo $row->title ?></option>
                                     @endforeach
                                  </select>
                             </div>
                           </div>
                          </div>
                          @if ($errors->has('usergroups'))
                              <span class="invalid-feedback">
                                  <strong>{{ $errors->first('usergroups') }}</strong>
                              </span>
                          @endif

                          {{-- MIN AGE --}}
                           <div class="form-group{{ $errors->has('minage') ? ' has-error' : '' }}">
                              <div class="row">
                                <label for="title" class="col-md-3 col-form-label text-md-right">Min Age</label>
                                <div class="col-md-9">
                                    <input id="minage"  type="number" class="form-control" min="0" max="99" name="minage" value="{{ old('minage') }}" required autofocus>
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
                                <label for="title" class="col-md-3 col-form-label text-md-right">Max Age</label>
                                <div class="col-md-9">
                                    <input id="maxage"  type="number" class="form-control" min="0" max="99" name="maxage" value="{{ old('maxage') }}" required autofocus>
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
