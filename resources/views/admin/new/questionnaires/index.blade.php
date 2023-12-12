@extends('admin.New.layout.master')
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                    <h3 class="inline_block font22"><b><img src="{{ asset('backend/images/questionnaries2.png') }}" alt="Img" title="Img" class="announcement">Questionnaires</b>
                    <a href="{{route('questionnaires.create', $groupId )}}" class="btn btn-info pull-right">Add Questionnaires</a>
                    <a href="{{route('admin.usergroup')}}" class="btn btn-info pull-right">Back To User Groups</a>
                    </h3>
                    <hr>
                    <div class="msgtabs pt50">
                            <div class="container-fluid">
                                @if(session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                                @endif
                                <div class="form-group">
                                <div class="row">
                                <label for="catagory" class="col-md-2">Select User Group</label>
                                <div class="col-md-8">
                                                <select class="form-control" id="user_group" onchange="redirectToQuestionnairePage(this.value)"
                                                        name="user_group" >
                                                    <option value="">Please Select</option>
                                                    @if( $usergroups )
                                                        @foreach( $usergroups as $row )
                                                            @if($usergroup)
                                                                @if($row->id==$usergroup->id)
                                                                    <option value="{{ $row->id }}" selected><?php echo $row->title ?></option>
                                                                @else
                                                                    <option value="{{ $row->id }}"><?php echo $row->title ?></option>
                                                                @endif
                                                            @else
                                                                <option value="{{ $row->id }}"><?php echo $row->title ?></option>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Sr.No.</th>
                                                <th>Title</th>
                                                <th>User Group</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($questionnaires))
                                @foreach ($questionnaires as $questionnairy)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $questionnairy->question_title }}</td>
                                        <td>
                                            @php
                                            $groupInfo = array();
                                            $groupids = explode(',',$questionnairy->group_id);

                                            if( $groupids ){
                                                foreach( $groupids as $groupid ){

                                                $title = App\Usergroup::find($groupid);
                                                    if($title){
                                                       $groupInfo[] = @$title->title;
                                                    }
                                                }
                                                    echo implode(', ', $groupInfo);
                                            }
                                            @endphp
                                        </td>
                                        <td>
                                           <a href="{{route('question.edit',$questionnairy->id)}}" class="btn btn-info btn-circle  border0"><i class="fa fa-edit"></i></a>
                                           <a href="{{route('question.destroy',$questionnairy->id)}}" onclick="return confirm('Are you sure you want to delete this Questionnary?');" class="btn btn-info btn-circle btn-danger border0"><i class="fa fa-trash"></i></a>
                                        </td>
                                     </tr>
                                @endforeach
                                @else
                                    <tr>
                                        <td colspan="10" class="text-center text-danger">No record found</td>
                                    </tr>
                                @endif
                                        </tbody>

                                {{ $questionnaires->links() }}
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
    <script>
        var questionnaire_page_url='{{ url('admin/questionnaires') }}';
        function redirectToQuestionnairePage(value)
        {
            if(value) {
                location.href = questionnaire_page_url + '/' + value;
            }
        }
    </script>
@endsection

