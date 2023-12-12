@extends('v7.frontend')
<link rel="stylesheet" href="{{asset('user/css/faqfront.css')}}">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
      integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
<style>
  input#hkb-search{
      border-radius: 99px;
    display: block;
    text-align: left;
    width: 500px !Important;
    margin: 0 auto;
    padding: 18px 20px 18px 45px !important;
    border: 0;
    outline: none;
    margin-bottom: 70px;
    box-shadow: 0 0 0 5px rgba(255, 255, 255, 0.15);
}
.sidebar{
      border-radius: 5px;
    background: #f4f5f5;
    padding: 0px 30px;
    margin: 0 0 20px;
    font-size: 14px;
    line-height: 1.4;
}
.icon-sec{
      margin-left: 50px;
    margin-top: -25px;
}
.faq-questions{
      text-align: center;
    background: #3b5998;
    color: #fff;
    padding: 0;
    margin: 0 auto;
}
.hkb-archive__title {
    font-size: 22px;
    margin: 0 0 30px;
    padding: 0 0 10px;
    border-bottom: 1px solid #e6e6e6;
}
.fa-search{
    position: relative;
    color: #000000b3;
    font-size: 18px;
    top: 37px;
    left: -12%;
}

.input-group{
display: block !important;
}
input#hkb-search {
  color: #000 !important;
}
@media screen and (max-width: 767px) {
  input#hkb-search{
        width: 100%!Important;
  }
  .fa-search{
    top: 37px;
    left: 15px;
    float: left;
  }

}
@media screen and (min-width: 1300px) and (max-width:1500px){
  .fa-search{
   left: -16%;
  }

}
</style>
@section('content')
<section class="aboutpagesection-grey" id="aboutpageabout">
  <!--begin container-->
    <div class="container-fluid">
    <div class="row faq-questions">
      <div class="col-md-12">
      <h3 style="color:#fff;"><span class=" stbtn3">FAQs</span></h3>
        <form action="{{route('faq-search')}}" method="POST" role="search">
        {{ csrf_field() }}
        <div class="input-group">
          <i class="fa fa-search" aria-hidden="true"></i><input id="hkb-search" class="hkb-site-search__field" type="text" value="" placeholder="Search the knowledge base..." name="s" autocomplete="off">
        </div>
      </form>
    </div>
    </div>
  </div>

    <div class="container">
  
      <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="row" style="margin:40px;">
         <!--  <div class="col-md-10">
            <h2 class="hkb-archive__title">Help Topics</h2>
          </div> -->
          <div class="col-md-4">
          
            <a href="{{route('faq.get-faq', 'My Account')}}">
            <div>
              
              <h6><img src="{{ asset('images/My Account.png') }}" class="img-tag">My Account</h6>
              <div class="icon-sec">
                How to manage your account and it's features.
              </div>
             </div>
            </a>
             <hr>
             <a href="{{route('faq.get-faq', 'Billing & Payments')}}">
          <div>
            <h6><img src="{{ asset('images/Billing & Payments.png') }}" class="img-tag">Billing & Payments</h6>
            <div class="icon-sec">
              Information about how we charge you for our services.
            </div>
          </div>
        </a>
          <hr>
          <a href="{{route('faq.get-faq', 'Copyright & Legal')}}">
          <div>
            <h6><img src="{{ asset('images/Copyright & Legal.png') }}" class="img-tag"> Copyright & Legal</h6>
            <div class="icon-sec">
              Important information about how we handle your privacy and data.
            </div>
          </div>
        </a>
          <hr>
          </div>
          <div class="col-md-4">
            <a href="{{route('faq.get-faq', 'Getting Started')}}">
          <div class="title-section">
           <h6><img src="{{ asset('images/Getting Started.png') }}" class="img-tag"> Getting Started</h6>
           <div class="icon-sec">
            Articles to get you up and running, quick and easy.
           </div>
          </div>
        </a>
          <hr>
          <a href="{{route('faq.get-faq', 'In-World')}}">
          <div>
            <h6><img src="{{ asset('images/In-World.png') }}" class="img-tag">In-World</h6>
            <div class="icon-sec">
              Documentation and troubleshooting our mobile app.
            </div>
          </div>
        </a>
          <hr>
          <a href="{{route('faq.get-faq', 'Advertising')}}">
          <div >
            <h6><img src="{{ asset('images/Advertising.png') }}" class="img-tag">Advertising</h6>
            <div class="icon-sec">Developer documentation and integration features.</div>
          </div>
         </a>
          <hr>
          </div>
          <div class="col-md-4">
       
          <aside class="sidebar" itemscope="" itemtype="https://schema.org/WPSideBar"><section id="ht-kb-exit-widget-3" class="widget hkb_widget_exit"><h3 class="widget__title" style="font-size:15px;">Need Support?</h3><div class="hkb_widget_exit__content">Can't find the answer you're looking for? Don't worry we're here to help!</div><a class="hkb_widget_exit__btn" data-ht-kb-exit-href="?hkb-redirect&amp;nonce=2b86088482&amp;check=37lap&amp;redirect=http%3A%2F%2Fdemo.herothemes.com%2Fknowall%2Fsubmit-a-ticket%2F&amp;otype=ht_kb_category&amp;oid=6&amp;source=widget" href="{{url('/tickets')}}" target="_blank" rel="nofollow">Submit Ticket</a></section></aside>


          </div>
    
      </div>
    </div>
  </div>
  <!--end container-->
</section>
@endsection
