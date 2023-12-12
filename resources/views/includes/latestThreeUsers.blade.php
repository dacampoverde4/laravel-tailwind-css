@php
	$users = latestThreeMember();
@endphp
	<table>
		@foreach($users as $user)
			<tr>
				<td style="padding: 0 20px;"><div class="imgbox"  style="width: 60px;height: 60px; object-fit: cover; background-image:url({{ ( $user->profile_pic )? url('/uploads').'/'.$user->profile_pic : url('/images/default.png')}});"></div></td>
				<td style="padding: 0 20px;">{{ $user->name }}</td>
				<td style="padding: 0 20px;"><a class="button" href="{{ url('userprofile')}}/{{ base64_encode($user->id) }}" style="    background: #d86461;font-size: 14px;padding: 0 3px;text-align: center;color:#ffffff; display:block;">Visit Profile<span style="font-size:14px; font-weight:bold; line-height:50%;">→</span></a></td>
			</tr>
		@endforeach
</table>
