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
                        <h3 class="inline_block"><b>Edit Page</b>
                            <a class="btn btn-primary pull-right" href="{{ url('admin/coupons') }}"><i class="fa fa-arrow-left"></i> Back</a>
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
                        <form class="form_inline fullwidth mtop40" action="{{ route('coupons.update', $coupon->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input name="_method" type="hidden" value="PATCH">
                            <div class="form-group">
                                <div class="row">
                                    <label for="coupon_code" class="col-md-4 col-form-label text-md-right">Coupon Code</label>
                                    <div class="col-md-8">
                                    <input type="text" class="form-control" name="coupon_code" placeholder="Coupon Code" value="{{$coupon->coupon_code}}">
                                    <p class="note">Note: Please add capital alphabets and should have 6.</p>
                                    </div>
                                    
                                    <br> <br>
                                    @if ($errors->has('coupon_code'))
                                        <div class="col-md-4">
                                        </div>
                                        <div class="error col-md-8 text-danger">{{ $errors->first('coupon_code') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label for="coupon_count" class="col-md-4 col-form-label text-md-right">how many times the coupon can be used by user?</label>
                                    <div class="col-md-8">
                                    <input type="text" class="form-control" name="coupon_count" placeholder="Coupon Count" value="{{$coupon->count}}">
                                    </div>
                                    <br> <br>
                                    @if ($errors->has('coupon_count'))
                                        <div class="col-md-4">
                                        </div>
                                        <div class="error col-md-8 text-danger">{{ $errors->first('coupon_count') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4 text-md-right">
                                        <label class="col-form-label">Select discount for ?</label>
                                    </div>
                                    <div class="col-md-8 demo-radio-button discount_types">
                                        @foreach($coupon_discount_types as $row)
                                            <input name="discount_type" type="radio" id="{{ $row->slug }}" value="{{ $row->id }}" @if($coupon->coupon_discount_type_id == $row->id) checked="checked" @endif>
                                            <label for="{{ $row->slug }}">{{ $row->name }}</label>
                                        @endforeach
                                    </div>
                                    @if ($errors->has('discount_type'))
                                        <div class="col-md-4"></div>
                                        <div class="error col-md-8 text-danger">{{ $errors->first('discount_type') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group discount-types token_off both @if($coupon->discountType->slug == 'token_off' || $coupon->discountType->slug == 'both') active @endif">
                                <div class="row">
                                    <label for="token_amt" class="col-md-4 col-form-label text-md-right">Tokens</label>
                                    <div class="col-md-8">
                                    <input type="text" class="form-control" name="token_amt" placeholder="Tokens" value="{{ old('token_amt') ? old('token_amt'): $coupon->token_amt }}">
                                    </div>
                                    <br> <br>
                                    @if ($errors->has('token_amt'))
                                        <div class="col-md-4">
                                        </div>
                                        <div class="error col-md-8 text-danger">{{ $errors->first('token_amt') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group discount-types discount_percentage both @if($coupon->discountType->slug == 'discount_percentage' || $coupon->discountType->slug == 'both') active @endif">
                                <div class="row">
                                    <label for="discount" class="col-md-4 col-form-label text-md-right">Discount</label>
                                    <div class="col-md-8">
                                    <input type="text" class="form-control" name="discount" placeholder="Discount" value="{{ old('discount') ? old('discount'): $coupon->discount }}">
                                    </div>
                                    <br> <br>
                                    @if ($errors->has('discount'))
                                        <div class="col-md-4">
                                        </div>
                                        <div class="error col-md-8 text-danger">{{ $errors->first('discount') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label for="token_amt" class="col-md-4 col-form-label text-md-right">Expiry Date</label>
                                    <div class="col-md-8">
                                    <input type="text" class="form-control" name="expiry_date" placeholder="Expiry Date" id="js-date" value="{{$coupon->expiry_date}}">
                                    </div>
                                    <br> <br>
                                    @if ($errors->has('expiry_date'))
                                        <div class="col-md-4">
                                        </div>
                                        <div class="error col-md-8   text-danger">{{ $errors->first('expiry_date') }}</div>
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
