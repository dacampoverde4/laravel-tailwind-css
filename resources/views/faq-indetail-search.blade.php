@extends('v7.frontend')
<link rel="stylesheet" href="{{asset('user/css/faqfront.css')}}">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
      integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
<style>
  .hkb-search-noresults {
    text-align: center;
    padding: 30px 0;
}
input#hkb-search{
      border-radius: 99px;
    display: block;
    text-align: center;
    width: 50%;
    margin: 0 auto;
    padding: 18px 20px 18px 45px;
    border: 0;
    outline: none;
    box-shadow: 0 0 0 5px rgba(255, 255, 255, 0.15);
}
</style>
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
            <?php  //echo count($faqs);echo '<pre>';print_r($faqs); ?>
           
            @foreach ($faqs as $item)
              
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
        
        
        @if(count($faqs)==0)
          <div class="col-md-12">
            <div class="hkb-search-noresults">
              <h2 class="hkb-search-noresults__title">
                No Results        </h2>
              <p>Your search for "dfsdfsd" returned no results. Perhaps try something else?</p>
            </div>
          </div>
          @endif

          
       
      </div>
    </div>
  </div>
  <!--end container-->
</section>
@endsection
