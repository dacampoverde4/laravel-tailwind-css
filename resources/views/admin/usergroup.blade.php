@extends('layouts.master')

@section('main-content')
<div class="maincontent">
        <div class="content bgwhite">                       
            
            <!-- Start Upgrade Membership ---->
            <div class="membership">
                <div class="container-fluid">
                    <h4 class="inline_block font20"><b><img src="{{ asset('backend/images/roles.png') }}" alt="Gruop" title="Img" class="">UserGroup</b></h4>
                                                
                            <a href="{{route('usergroup.create')}}" class="btn btnred pull-right">Add Group</a>
                </div>
                <hr>
            </div>
            <!-- End Upgrade Membership ---->


            <!-- Start Message Tabs -->
            <div class="msgtabs pt50">
                <div class="container-fluid">
                  <div class="tab-content">
                        <div id="inbox" class="tab-pane fade in active">

                            <table class="table table-bordered mtop20">
                                       <th>Sr.No.</th>
                                        <th>Title</th>
                                        <th>Age(Min.)</th>
                                        <th>Age(Max.)</th>
                                        <th>Gender Role</th>
                                        <th>Action</th>
                               @foreach($genderrole as $row)
                              <?php print_r(json_decode($row->genderrole));  ?>
                                     <tr>

                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{$row->title}}</td>
                                        <td>{{$row->minage}}</td>
                                        <td>{{$row->maxage}}</td>
                                        <td>{{$row->genderrole}}</td>
                                        <td><a href="{{route('usergroup.edit',$row->id)}}" class="btn btn-info btn-circle"><i class="fa fa-pencil"></i></a>
            <a href="{{route('usergroup.delete',$row->id)}}" class="btn btn-danger btn-circle"><i class="fa fa-trash-o"></i></button></td>
                                     



                                     </tr>   
                                    
                                @endforeach
                                   
                                </table>
                              
                            </div>
                            
                            
                          
                          

                            

                        
                        
                                                  
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- End Message Tabs -->

        </div>      
    </div>
@endsection
