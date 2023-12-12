@extends('layouts.master')
@section('htmlheader')
<link rel="stylesheet" type="text/css" href="{{ asset('css/slick.css') }}"/><link rel="stylesheet" type="text/css" href="http://kenwheeler.github.io/slick/slick/slick-theme.css"/>
<script type="text/javascript" src="{{ asset('js/slick.js') }}"></script>
@endsection

@section('main-content')
<div class="maincontent backend">
    <div class="content bgwhite">						
			
			<!-- Start Upgrade Membership ---->
			<div class="membership">
				<div class="container-fluid">
					<h4 style="border-bottom: 1px solid #ccc;" class="font16 vertical_align"><img src="{{ URL::asset('frontend/images/note-icon.png') }}" alt="">NOTE</h4>
				</div>
			</div>
<!-- Start profile Section -->
        <div class="profile_section mtopbottom20">
            <div class="container">
                <!-- Start Message Tabs -->
			<div class="notetabs pt50">
				<div class="container-fluid">

					<div class="tab-content">
						<div id="inbox" class="tab-pane fade in active">
						    @foreach($notes as $note)
							<div class="tabrow">
								<div class="row">
									<div class="col-md-6 col-sm-6">
										<label>
											<input type="checkbox" value="" name="" />
											<i></i>
										</label>
									{{ $note->note }}
									</div>
								
									<div class="col-md-6 col-sm-6 text-right"><button type="submit" class="btnred btnpad">Send</button></div>
								</div>
							</div>
							@endforeach
							{{ $notes->links() }}
					</div>
				</div>
			</div>
			<!-- End Message Tabs -->

        
            </div>
        </div>
    </div>
</div>
</div>
<!-- End profile Section -->

@endsection
