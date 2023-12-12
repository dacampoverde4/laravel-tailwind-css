@extends('v7.frontend')
<link rel="stylesheet" href="{{asset('user/css/faqfront.css')}}">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
      integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
@section('content')
<section class="aboutpagesection-grey" id="aboutpageabout">
  <!--begin container-->
  <div class="container">
    <div class="col-md-12">
      <h3><span class="discover-btn3">FAQs</span></h3>
    </div>
    <div class="container">
      <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="row">
          <div class="col-md-8">
            <?php   ?>
           <h3><img src="{{ asset('images/'.$category.'.png') }}" class="img-tag"> {{$category}}</h3>
            @foreach ($faqs_info as $item)
              
            <div>
            <h6><b>{{$item->question}}</b><h6>
           </div>
           <div>
            {{$item->answer}}
           </div>
           <hr>
           @endforeach
          </div>
          <div class="col-md-4">
          
          </div>
        {{-- <div class="col-md-6">
        @if(!empty($faq1))
        @foreach ($faq1 as $faq)
                <div class="panel panel-default">
                  <div class="panel-heading" role="tab"
                       id="heading{{ $faq->id }}">
                    <h4 class="panel-title">
                      <a role="button" class="collapsed" style="text-align: left;"
                         data-toggle="collapse" data-parent="#accordion"
                         href="#collapse{{ $faq->id }}" aria-expanded="false"
                         aria-controls="collapse{{ $faq->id }}">{{ $faq->question }}
                      </a>
                    </h4>
                  </div>
                  <div class="panel-body">
                    <div id="collapse{{ $faq->id }}" class="panel-collapse collapse"
                         role="tabpanel" aria-labelledby="heading{{ $faq->id }}">
                      <p>
                        {{ $faq->answer }}
                      </p>
                    </div>
                  </div>
                </div>
            @endforeach
            @endif
        </div>
        <div class="col-md-6">
             @if(!empty($faq2))
             @foreach ($faq2 as $faq)
                  <div class="panel panel-default">
                    <div class="panel-heading" role="tab"
                         id="heading{{ $faq->id }}">
                      <h4 class="panel-title">
                        <a role="button" class="collapsed" style="text-align: left;"
                           data-toggle="collapse" data-parent="#accordion"
                           href="#collapse{{ $faq->id }}" aria-expanded="false"
                           aria-controls="collapse{{ $faq->id }}"> {{ $faq->question }}
                        </a>
                      </h4>
                    </div>
                    <div class="panel-body">
                      <div id="collapse{{ $faq->id }}" class="panel-collapse collapse"
                           role="tabpanel" aria-labelledby="heading{{ $faq->id }}">
                        <p>
                          {{ $faq->answer }}
                        </p>
                      </div>
                    </div>
                  </div>
             @endforeach
             @endif
        </div> --}}
      </div>
    </div>
  </div>
  <!--end container-->
</section>
@endsection
