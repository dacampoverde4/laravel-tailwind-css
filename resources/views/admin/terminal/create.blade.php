@extends('admin.layout.master')
@section('page_css')
<style>
.discount-types{
    display: none;
}
.discount-types.active{
    display: block;
}
</style>
@endsection
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="inline_block"><b>Create Terminal</b>
                            <a class="btn btn-primary pull-right" href="{{ url('admin/terminal') }}"><i class="fa fa-arrow-left"></i> Back</a>
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
                        <form class="form_inline fullwidth mtop40" action="{{ route('terminal.store') }}" method="post" >
                            @csrf
                          
                            <div class="form-group">
                                <div class="row">
                                    <label for="terminal_id" class="col-md-4 col-form-label text-md-right">Terminal Id</label>
                                    <div class="col-md-8">
                                    <input type="text" class="form-control" name="terminal_id" placeholder="Terminal Id" value="">
                                    </div>
                                    
                                    <br> <br>
                                    @if ($errors->has('parcel_name'))
                                        <div class="col-md-4">
                                        </div>
                                        <div class="error col-md-8 text-danger">{{ $errors->first('parcel_name') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label for="parcel_name" class="col-md-4 col-form-label text-md-right">Parcel Name</label>
                                    <div class="col-md-8">
                                    <input type="text" class="form-control" name="parcel_name" placeholder="Terminal Parcel Name" value="">
                                    </div>
                                    
                                    <br> <br>
                                    @if ($errors->has('parcel_name'))
                                        <div class="col-md-4">
                                        </div>
                                        <div class="error col-md-8 text-danger">{{ $errors->first('parcel_name') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label for="region_name" class="col-md-4 col-form-label text-md-right">Region Name</label>
                                    <div class="col-md-8">
                                    <input type="text" class="form-control" name="region_name" placeholder="Terminal Region Name" value="">
                                    </div>
                                    
                                    <br> <br>
                                    @if ($errors->has('region_name'))
                                        <div class="col-md-4">
                                        </div>
                                        <div class="error col-md-8 text-danger">{{ $errors->first('region_name') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label for="x" class="col-md-4 col-form-label text-md-right">X</label>
                                    <div class="col-md-8">
                                    <input type="text" class="form-control" name="x" placeholder="X value" value="">
                                    </div>
                                    
                                    <br> <br>
                                    @if ($errors->has('x'))
                                        <div class="col-md-4">
                                        </div>
                                        <div class="error col-md-8 text-danger">{{ $errors->first('x') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label for="y" class="col-md-4 col-form-label text-md-right">Y</label>
                                    <div class="col-md-8">
                                    <input type="text" class="form-control" name="y" placeholder="Y value" value="">
                                    </div>
                                    
                                    <br> <br>
                                    @if ($errors->has('y'))
                                        <div class="col-md-4">
                                        </div>
                                        <div class="error col-md-8 text-danger">{{ $errors->first('x') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label for="z" class="col-md-4 col-form-label text-md-right">Z </label>
                                    <div class="col-md-8">
                                    <input type="text" class="form-control" name="z" placeholder="Z value" value="">
                                    </div>
                                    
                                    <br> <br>
                                    @if ($errors->has('z'))
                                        <div class="col-md-4">
                                        </div>
                                        <div class="error col-md-8 text-danger">{{ $errors->first('z') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label for="rank" class="col-md-4 col-form-label text-md-right">Rank</label>
                                    <div class="col-md-8">
                                    <input type="text" class="form-control" disabled name="rank" placeholder="Terminal rank" value="">
                                    </div>
                                    
                                    <br> <br>
                                    @if ($errors->has('rank'))
                                        <div class="col-md-4">
                                        </div>
                                        <div class="error col-md-8 text-danger">{{ $errors->first('rank') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label for="status" class="col-md-4 col-form-label text-md-right">Status</label>
                                    <div class="col-md-8">
                                    <select name="status" id="" class="form-control">
                                        <option  value="0">Deactivated</option>
                                        <option value="1">Activated</option>
                                    </select>
                                    </div>
                                    
                                    <br> <br>
                                    @if ($errors->has('status'))
                                        <div class="col-md-4">
                                        </div>
                                        <div class="error col-md-8 text-danger">{{ $errors->first('status') }}</div>
                                    @endif
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
$(document).ready(function() {
    $('#js-date').datepicker({
        format: 'yyyy-mm-dd'
    });
    $(".discount_types input[type=radio]").change(function (e) {
        $(".discount-types").removeClass('active');
        $('.discount-types').hide();
        $('.'+$(this).attr('id')).show();
    });
    @if(old('discount_type'))
        $(".discount_types input[type=radio][value={{old('discount_type')}}]").change();
        $(".discount_types input[type=radio][value={{old('discount_type')}}]").prop('checked', true);
    @endif
});
</script>
@stop
