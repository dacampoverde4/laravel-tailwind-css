@php
  $featuresUsers = randomFeatureUsers();
@endphp
@if($featuresUsers)
@foreach($featuresUsers as $featuresUser)
<td width="180" valign="top" style="padding-top:10px;padding-right:20px;font-family:Arial, Helvetica, sans-serif;font-size:12px;line-height:15pt;color:#999999;text-align:center;font-weight:bold;"><div width="80" height="80" style="background-image:url({{ ( $featuresUser->profile_pic )? url('/uploads').'/'.$featuresUser->profile_pic : url('/images/default.png')}});font-size:14px" border="0" vspace="0" hspace="0"><br><br></div>
<h3 style="padding:0;font-family:Arial, Helvetica, sans-serif;font-size:12px;line-height:15pt;color:#999999;font-weight:bold;margin-top:0;margin-bottom:0px;">
{{ $featuresUser->name }}</h3>
@php
if($featuresUser->profile_pic){
	$picture = 'http://laravel.avdopt.com/uploads/'.$featuresUser->profile_pic;
}
else{
	$picture = 'http://laravel.avdopt.com/images/default.png';
}

@endphp

	<img alt="image" width="30" height="24" src="{{ $picture }}" align="right" border="0" vspace="0" hspace="0">
	<div style="background-image:url('<?php echo $picture; ?>');"></div>
</td>

@endforeach
@endif