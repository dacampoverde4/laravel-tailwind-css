@extends('admin.New.layout.master')
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3>
                            <a class="btn btn-info pull-right" href="{{ url('admin/subscriptionplans/create') }}"><i class="fa fa-plus"></i> Add</a>
                        </h3>
                        <hr>
                        <div class="msgtabs pt50">
                            <div class="container-fluid">
                                @if(session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                                @endif
                                <div class="table-responsive m-t-40">
                                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Title</th>
                                                <th>Token</th>
                                                <th>Billing Interval</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ( $plans )
                                            @foreach ($plans as $plan)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $plan->name }}</td>
                                                <td>T{{ ( $plan->price ) }}</td>
                                                @php
                                                $billings = array('day' => 'Daily', 'week' => 'Weekly', 'month' => 'Monthly', 'quarter' => 'Every 3 months', 'semiannual' => 'Every 6 months', 'year' => 'Yearly' )
                                                @endphp
                                                <td>{{ isset( $billings[$plan->billing_interval] )? $billings[$plan->billing_interval] : '' }}</td>
                                                <td>
                                                    <a onclick="return confirm('Are you sure you want to delete this plan?')" href="{{route('plan.destroy', $plan->id)}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                                    <a href="{{route('plan.edit', $plan->id)}}" class="btn btn-info"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
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
@section('page_js')
<script type="text/javascript">
    $(document).ready(function() {
       $('.table').DataTable();
    } );
</script>
@endsection