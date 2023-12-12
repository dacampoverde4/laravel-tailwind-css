@extends('layouts.master')

@section('main-content')
<!-- Start Main Content ---->
<div class="maincontent">
	<div class="content bgwhite">						
		<div class="membership">
			<div class="container-fluid">
				<h4 class="inline_block font20"><b>Payment</b></h4>
				<a href="/pricing" class="btn btnred pull-right">Back to subscription</a>
			</div>
			<hr>
			<div class="successtabs mtopbottom text-center">
				<div class="container">
					<div class="row mtopbottom80">
						<div class="successbox padding60">
							<p><img width="100" height="100" alt="Success" src="{{ url('backend/images/success-icon.png')}}"></p>
							<h1 class="fontclr mtop30">Success!</h1>
							<h4 class=" font22 mtop30">We hope you enjoy your purchase.</h4>
							<p></p>
							<p class="mtopbottom60"><a class="gotobtn" href="/home">Go to the dashboard page</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection