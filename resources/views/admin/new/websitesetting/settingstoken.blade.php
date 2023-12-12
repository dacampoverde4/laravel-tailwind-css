@extends('admin.New.layout.master')
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="inline_block font22"><b class="vertical_align"><img src="{{ asset('backend/images/setamount.png') }}" alt="Img" title="Img" class="announcement"> SET TOKEN AMOUNT</b></h3>
                        <hr>
                        <div class="msgtabs mtop30">
                            <div class="container-fluid">
                                @if(session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                                @endif
                                <div class="token-amount">
                                    <form class="form_inline fullwidth" method="POST" action="{{ route('saveWebsiteSetting') }}">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="token_amount" class="col-md-3 col-form-label text-md-right">Price for per token</label>
                                            <div class="col-md-9">
                                                <input id="token_amount" type="number" class="form-control" name="websiteSettings[token_amount]" placeholder="$" value="{{ $metaData['token_amount'] or '' }}" required="">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-success pull-right border_radius"><i class="fa fa-check"></i> Submit</button>
                                        </div>
                                    </form>
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