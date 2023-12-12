@extends('admin.New.layout.master')
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h4 class="inline_block font22"><b><img src="{{ asset('backend/images/notes2.png') }}" alt="Note" title="Img" class="">Notes</b>                  
                            <a href="{{route('note.create', $groupId )}}" class="btn btn-info pull-right">Add Note</a>
                            <a href="{{route('admin.usergroup')}}" class="btn btn-info pull-right">Back To User Groups</a>
                        </h4>
                        <hr>
                        <div class="msgtabs mtop30">
                            <div class="container-fluid">
                                @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                                @endif
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Sr.No.</th>
                                                <th>Note Title</th>
                                                <th>User Group</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
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
                                        </tbody>
                                    </table>
                                    {{ $notes->links() }}s
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