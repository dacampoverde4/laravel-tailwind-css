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
                      <h3 class="inline_block font20"><b class="vertical_align"><i class="fa fa-envelope"></i>Edit Note</b>
                       <a href="{{route('usergroup.notes', $groupId)}}" class="btn btn-success pull-right">Back</a></h3>
                       <hr>
                          @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif
                        <form class="form_inline fullwidth mtop40" method="POST" action="{{route('note.update', $note->id)}}">
                            {{ csrf_field() }}                  
                            <div class="form-group">
                               <div class="row">
                                    <label for="note" class="col-md-4 col-form-label text-md-right"> Note Title</label>
                                    <div class="col-md-8">
                                        <textarea id="note" class="form-control" name="note" required="">{{ $note->note }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-9"><button type="submit" class="btnpad btn-success pull-right border_radius">Update</button></div>
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
            placeholder: 'select role',
          multiple: true
        });
    });
</script>
@endsection
