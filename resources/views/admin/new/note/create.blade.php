@extends('admin.New.layout.master')
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h4 class="inline_block font20"><i class="fa fa-envelope"></i> Create Note</h4>
                        <hr>
                        <form class="form_inline fullwidth mtop40" method="POST" action="{{route('note.store')}}">
                            {{ csrf_field() }}                  
                            <div class="form-group">
                                <div class="row">
                                    <label for="note" class="col-md-3 col-form-label text-md-right">Note</label>
                                    <div class="col-md-9">
                                        <input type="hidden" name="user_group" value="{{ $groupId }}"/>
                                        <textarea id="note" class="form-control" name="note" value="" required=""></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12"><button type="submit" class="btn btn-success pull-right border_radius"><i class="fa fa-check"></i> Submit</button></div>
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