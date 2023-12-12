@extends('admin.layout.master')
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="inline_block"><b>Add Page</b>
                            <a class="btn btn-primary pull-right" href="{{ route('pages.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
                        </h3>
                        <hr>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('warning'))
                            <div class="alert alert-warning">
                                {{ session('warning') }}
                            </div>
                        @endif
                        <form class="form_inline fullwidth mtop40" action="{{ route('pages.store') }}"
                              method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <div class="row">
                                    <label for="page_title" class="col-md-2 col-form-label text-md-right">Page Title</label>
                                    <div class="col-md-10">
                                    <input type="text" class="form-control" name="page_title" placeholder="Page Title">
                                    </div>
                                    <br> <br>
                                    @if ($errors->has('page_title'))
                                        <div class="col-md-2">
                                        </div>
                                        <div class="error col-md-10 text-danger">{{ $errors->first('page_title') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label for="content" class="col-md-2 col-form-label text-md-right">Content</label>
                                    <div class="col-md-10">
                                    <textarea name="content" class="form-control" id="content" rows="8"
                                              cols="80"></textarea>
                                    </div>
                                    <br> <br>
                                    @if ($errors->has('content'))
                                        <div class="col-md-2">
                                        </div>
                                        <div class="error col-md-10 text-danger">{{ $errors->first('content') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                            <label for="section" class="col-md-2 col-form-label text-md-right">Section</label>
                                        <div class="col-md-4">
                                            <select class="form-control col-md-8" name="section" id="section">
                                                <option value="NONE">NONE</option>
                                                <option value="HEADER">Header</option>
                                                <option value="FOOTER">Footer</option>
                                            </select>
                                        </div>
                                    <div id="column_div" style="display:none" class="col-md-6">
                                        <label for="column" class="col-md-3 col-form-label text-md-right">Column</label>
                                            <select class="form-control col-md-4" name="column" id="column">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                            </select>
                                    </div>
                                </div>
                            </div>

                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-9"><input type="submit" class="btn btn-success pull-right border_radius" name="submit" value="Save">
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
<script type="text/javascript">
    CKEDITOR.replace('content');

    $(document).ready(function()
    {
        var section_val = $('#section').val();
        if (section_val!="" && section_val!="FOOTER") {
            $("#column").val('');
        }
    });
    $("#section").change(function()
    {
        var section_val = $(this).val();
        if(section_val!='' && section_val=='FOOTER')
        {
            $("#column").val('1');
            $("#column_div").css('display','');
        }
        else
        {
            $("#column_div").css('display','none');
            $("#column").val('');
        }
    });
</script>
@stop
