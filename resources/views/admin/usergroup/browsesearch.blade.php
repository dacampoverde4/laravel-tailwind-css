@extends('admin.layout.master')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3><b><i class="fa fa-envelope"></i>Select search groups for <code>{{ $group->title }}</code> group</b></h3>
                        <hr>

                 
                        <form class="form-horizontal form_common" role="form" method="POST" action="{{ route('store.browse', $group->id) }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <div class="row">
                            <label for="title" class="col-md-3 col-form-label text-md-right">Title</label>
                            <div class="col-md-9">
                                <input id="title"  type="text" class="form-control" name="title" value="{{ $group->title }}" disabled>
                            </div>
                        </div>
                      </div>
                        @if ($errors->has('title'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                        @endif
                        
                        <div class="form-group{{ $errors->has('plans') ? ' has-error' : '' }}">
                          <div class="row">
                            <label for="plans" class="col-md-3 col-form-label text-md-right">Select Groups</label>
                            <div class="col-md-9">
                                <select class="form-control searchdropdown" multiple id="searchs" name="searchs[]" required="required">
                                    
                                    @foreach($usergroups as $usergroup)
                                        @php
                                            $sel = '';
                                            $data = ($group->searchs)? json_decode( $group->searchs ) : array();
                                            if( in_array($usergroup->id, $data) ){
                                                $sel = 'selected';
                                            }
                                        @endphp
                                        <option {{ $sel }} value="{{ $usergroup->id }}" ><?php echo $usergroup->title ?></option>
                                    @endforeach
                                </select>
                           </div>
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