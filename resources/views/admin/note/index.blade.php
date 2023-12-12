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
                    <h3 class="inline_block font22"><b class="vertical_align"><img src="{{ asset('backend/images/notes2.png') }}" alt="Note" title="Img" class="">Notes</b>   
                    <div class="pull-right">             
                        <a href="{{route('note.create', $groupId )}}" class="btn btn-success ">Add Note</a> &nbsp;
                        <a href="{{route('admin.usergroup')}}" class="btn btn-success ">Back To User Groups</a>
                    </div>
                   </h3>   
                    <hr>
                            <table class="table table-striped table-bordered">
                                    <tr>
                                       <th>Sr.No.</th>
                                       <th>Note Title</th>
                                       <th>User Group</th>
                                        <th>Action</th>
                                    </tr>
                                    @foreach($notes as $note)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $note->note }}</td>
                                        <td>{{ $note->usergroup->title }}</td>
                                        <td>
                                            <a href="{{ route('note.edit', ['groupId'=>$groupId,'id'=> $note->id] ) }}" class="btn btn-info btn-circle"><i class="fa fa-pencil"></i></a>
                                            <a onclick="return confirm('Are you sure you want to delete this user?')" href="{{ route('note.delete', $note->id) }}" class="btn btn-danger btn-circle"><i class="fa fa-trash-o"></i></a>
                                            
                                        </td>
                                    </tr>
                                    @endforeach

                                </table>
                                 {{ $notes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
