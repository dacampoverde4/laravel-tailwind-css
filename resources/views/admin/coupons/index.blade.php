@extends('admin.layout.master')
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="inline_block font22"><b class="vertical_align">Coupons</b>
                        <a class="btn btn-primary pull-right" href="{{ route('coupons.create') }}"><i class="fa fa-plus"></i> Add Coupon</a>
                        </h3>
                        <hr>
                        <div class="gender_box mtop30">
                            <div class="container-fluid">
                                @if(session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                                @endif
                                <div class="table-responsive m-t-40">
                                    <table class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Coupon Code</th>
                                            <th>Count</th>
                                            <th>Total Token</th>
                                            <th>Discount</th>
                                            <th>Expiry At</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if($coupons)
                                            @foreach($coupons as $coupon)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $coupon->coupon_code }}</td>
                                                    <td>{{ $coupon->count }}</td>
                                                    <td>{{ $coupon->token_amt }}</td>
                                                    <td>{{ $coupon->discount }}</td>
                                                    <td>{{ date('M d, Y', strtotime($coupon->expiry_date)) }}</td>
                                                    <td>
                                                        <a href="{{route('coupons.edit',$coupon->id)}}" class="btn btn-info btn-circle">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                            <a onclick="return confirm('Are you sure you want to delete this coupon?')" href="{{route('coupons.destroy',$coupon->id)}}" class="btn btn-danger btn-circle">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="4">No coupons available.</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
