@extends('layouts.master')

@section('main-content')
<div class="maincontent">
    <div class="content bgwhite">                       

        <!-- Start Upgrade Membership ---->
        <div class="membership">
            <div class="container-fluid">
                    <h4 class="inline_block font20"><i class="fa fa-envelope"></i>Features</h4>
                           <a href="{{route('create.feature')}}" class="btn btnred pull-right">Add Feature</a>
                           
                </div>
           <hr>
        </div>
        <!-- End Upgrade Membership ---->


        <!-- Start Message Tabs -->
        <div class="msgtabs pt50">
            <div class="container-fluid">
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                <div class="tab-content">
                    <div id="inbox" class="tab-pane fade in active"><?php $i = 1; ?>
                        <table class="table table-bordered">
                            <tr>
                                <th>#</th>
                                <th>title</th>
                                <th>Action</th>
                            </tr>
                            @foreach($features as $feature)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $feature->title }}</td>
                                <td>
                                    <a href="{{ route('edit.feature', $feature->id)}}" class="btn btn-info btn-circle"><i class="fa fa-pencil"></i></a>
                                    <a href="{{ route('setting.feature', $feature->id)}}" class="btn btn-info btn-circle"><i class="fa fa-wrench" aria-hidden="true"></i></a>
                                    <a onclick="return confirm('Are you sure you want to delete this user?')" href="{{ route('delete.feature', $feature->id) }}" class="btn btn-danger btn-circle"><i class="fa fa-trash-o"></i></a>
                                    
                                </td>
                            </tr>
                            <?php $i++; ?>
                            @endforeach
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div> 

@endsection