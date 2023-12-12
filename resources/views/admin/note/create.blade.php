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
                        <h3 class="inline_block font20"><b><i class="fa fa-envelope"></i>Create Note</b></h3>
                           <form class="form_inline fullwidth mtop40" method="POST" action="{{route('note.store')}}">
                            {{ csrf_field() }}                  
                            <div class="form-group">
                               <div class="row">
                                    <label for="note" class="col-md-4 col-form-label text-md-right">Note</label>
                                    <div class="col-md-6">
                                        <input type="hidden" name="user_group" value="{{ $groupId }}"/>
                                        <textarea id="note" class="form-control" name="note" value="" required=""></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-10"><button type="submit" class="btn-success pull-right border_radius">Submit</button></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection