@extends('layouts.master')

@section('main-content')
<div class="maincontent">
    <div class="content bgwhite">

        <!-- Start Upgrade Membership ---->
        <div class="membership">
            <div class="container-fluid">
                    <h4 class="inline_block font22"><b><img src="{{ asset('backend/images/taguser.png') }}" alt="Img" title="Img" class="announcement">FAQ</b></h4>
                    <a href="{{ route('faq.create') }}" class="btn btnred pull-right">Add Question</a>
                </div>
           <hr>
        </div>
        <!-- End Upgrade Membership ---->


        <!-- Start Message Tabs -->
        <div class="msgtabs pt50">
            <div class="container-fluid">
                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
                @if(session()->has('error'))
                    <div class="alert alert-error">
                        {{ session()->get('error') }}
                    </div>
                @endif
                <div class="tab-content">
                    <div id="inbox" class="tab-pane fade in active">
                        <table class="table table-bordered">
                            <th>#</th>
                            <th>Category</th>
                            <th>Question</th>
                            <th>Answer</th>
                            <th>Action</th>
                            @foreach($faqs as $faq)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                {{-- <td style="width: 370px; text-overflow: 'ellipsis';">{{ $faq->question }}</td> --}}
                                {{-- <td style="width: 400px; text-overflow: 'ellipsis';">{{ $faq->answer }}</td> --}}
                                <td style="width: 250px;">{{ $faq->category }}</td>
                                <td style="width: 250px;">{{ str_limit($faq->question, $limit = 50, $end = '...') }}</td>
                                <td>{{ str_limit($faq->answer, $limit = 250, $end = '...') }}</td>
                                <td style="width: 120px;">
                                    <a href="{{ route('faq.show', $faq->id)}}" class="btn btn-primary btn-circle"><i class="fa fa-eye"></i></a>
                                    <a href="{{ route('faq.edit', $faq->id)}}" class="btn btn-info btn-circle"><i class="fa fa-pencil"></i></a>
                                    <a onclick="return confirm('Are you sure you want to delete tag?')" href="{{ route('faq.delete', $faq->id)}}" class="btn btn-info btn-circle btn-danger" title="Suspend"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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

@endsection
