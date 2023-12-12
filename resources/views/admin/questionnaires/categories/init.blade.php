@extends('admin.layout.master')
@section('content')
<div class="row">
        <!-- Column -->
        <div class="col-lg-12 col-xlg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="inline_block font22"><b><img src="{{ asset('backend/images/questionnaries2.png') }}" alt="Img" title="Img" class="announcement"> Match Quest</b></h3>
                            <hr>
                            <div class="form-group">
                                <div class="row">
                                    <label for="catagory" class="col-md-4 col-form-label text-md-right">Select User
                                    Group</label>
                                    <div class="col-md-8">
                                        <select class="form-control" id="user_group" onchange="redirectToQuestionnairePage(this.value)"
                                        name="user_group" >
                                        <option value="">Please Select</option>
                                        @if( $usergroups )
                                        @foreach( $usergroups as $row )
                                        <option value="{{ $row->id }}"><?php echo $row->title ?></option>
                                        @endforeach
                                        @endif
                                        </select>
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
