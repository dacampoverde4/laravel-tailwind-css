@extends('admin.layout.master')
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="inline_block font22"><b class="vertical_align"><img src="{{ asset('backend/images/featuresetting.png') }}" alt="Report" title="Img" class="all_users">FEATURE SETTINGS</b>
                        <a href="{{ route('admin.feature.setting.create') }}" class="btn btn-info pull-right">Add feature</a>
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
                                    <table class="table table-bordered mtop20">
                                        <tr>
                                           <th>Sr.No.</th>
                                            <th>Name</th>
                                            <th>Tokens</th>
                                            <th>Bill Interval</th>
                                            <th>UserGroup</th>
                                            <th>Visibility</th>
                                            <th>Info</th>
                                            <th>Action</th>
                                        </tr>
                                       @foreach( $featuresetting as $features )
                                         <tr>
                                            <td>{{ $loop->iteration }} </td>
                                            <td>{{ $features->name }}</td>
                                            <td>{{ $features->tokens }}</td>
                                            <td>{{ $features->billing_interval }}</td>
                                            <td>{{ $features->usergroup->title }}</td>
                                            <td>
                                                @php
                                                    $groupAll = array();
                                                    $getgroup = ( $features->visibility )? json_decode( $features->visibility  ) : array();
                                                    
                                                    if( $getgroup ){
                                                        foreach( $getgroup as $groups ){
                                                            $group = App\Usergroup::find($groups);
                                                            
                                                            if( $group ){
                                                                $groupAll[] = $group->title;
                                                            }
                                                        }
                                                        echo implode(', ', $groupAll);
                                                    }
                                                @endphp
                                            </td>
                                            <td>@php echo $features->info @endphp</td>
                                            <td>
                                                <a href="{{ route('admin.feature.setting.edit', $features->id) }}" class="btn btn-info btn-circle"><i class="fa fa-pencil"></i></a>
                                                <a href="{{ route('admin.feature.setting.delete', $features->id) }}" onclick="return confirm('Are you sure you want to delete this feature setting?')" class="btn btn-danger btn-circle"><i class="fa fa-trash-o"></i> </a>
                                            </td>
                                         </tr>  
                                        @endforeach
                                   
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
