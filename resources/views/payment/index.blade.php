@extends('layouts.master')

@section('htmlheader')
<style>
@media only screen and (max-width: 767px){
    .card .d-flex {
        display: block !important;
        text-align: center;
    }
    .card .btn {
        padding: 5px 10px;
        font-size: 14px;
    }
}
</style>
@endsection

@section('main-content')
        <div class="container-fluid">
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        @if(session()->has('danger'))
            <div class="alert alert-danger">
                {{ session()->get('danger') }}
            </div>
        @endif
        </div>
        <!-- Start Upgrade Membership ---->

            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="container-fluid page-titles">
                <div class="row">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor"><img src="{{ URL::to('/') }}/backend/images/wallet-icon.png" class="all_users"> MY WALLET</h3>
                    </div>
                    <div class="col-md-7 align-self-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">MY WALLET</li>
                        </ol>
                    </div>
                    <div>
                        <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                    </div>
                </div>
            </div>
            <!-------->
            <div class="container-fluid">


                                 <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <div class="d-flex flex-row">
                                     <div class="form-group col-md-7 m-t-20">


                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-success"><i class="ti-wallet"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h5 class="text-muted m-b-0">Wallet Balance</h5>
                                        <h3 class="m-b-0">{{ ( @$wallet->balance )? $wallet->balance : 0 }} Tokens</h3>
                                    </div>
                                </div>



                            </div>

                             <div class="form-group col-md-3 m-t-20 wallet_top_btns">
                                 <a class="btnred btnpad btn btn-success border_radius" href="{{ url('/pricing') }}">Premium Membership</a>

						</div>
						<div class="form-group col-md-2 m-t-20"> 	<a href="{{ url('wallet/credit') }}" class="btnred btnpad btn btn-primary border_radius">Add Tokens</a></div>
                             </div>
                            </div>


			    </div>
                        </div>
                    </div>
                <div class="row">
                <div class="col-md-12 banner wallet_ban_img">
                            <img src="http://laravel.avdopt.com/assets/images/match_quest_categoies/PAQJ0m1k2g_1573238630_.jpg" class="banner" alt="your image">
                 </div>
             </div>
            <!-------->
                <div class="row">
                    <!-- column -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
								<!--      <h4 class="card-title">Basic Table</h4>
								<h6 class="card-subtitle">Add class <code>.table</code></h6> -->
                                <div class="table-responsive">
                                    <table  id="myTable" class="display nowrap table table-hover table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>DATE</th>
                                                <th>TRANSACTIONS ID</th>
                                                <th>DEBIT</th>
                                                <th>CREDIT</th>
                                                <th>ORDER</th>
                                                <th>BALANCE</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($transactions as $transaction)
                                            <tr>
                                                <td>{{ date('m-d-Y h:i:A', strtotime( $transaction->created_at ) )  }}</td>
                                                <td>{{ $transaction->hash }}</td>
                                                <td>{{ $transaction->type == 'withdraw' ? 'L$'.$transaction->amount : ''}}</td>
                                                <td>{{ $transaction->type == 'deposit' ? 'L$'.$transaction->amount : ''}}</td>
                                                <td>{{ $transaction->meta['description'] }}</td>
                                                <td>T{{ (isset($transaction->meta['balance'])) ? $transaction->meta['balance'] : '-NA'}}</td>
                                            </tr>
                                    @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>

            </div>

    </div>

    <!--Custom JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    	    <script src="{{asset('frontend/datatables/jquery.dataTables.min.js')}}"></script>
<script>


    $('#myTable').DataTable({
        dom: 'Bfrtip',
        order: [[ 1, "ASC" ]],
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
</script>
@endsection
