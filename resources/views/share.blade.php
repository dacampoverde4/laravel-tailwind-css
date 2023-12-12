<!DOCTYPE html>
<html>
    <title>Social Media Sharing</title>
<head>
        <meta property="og:url"           content="http://avdopt.com/laravel/share/{{ $data_array->id }}" />
        <meta property="og:type"          content="website" />
        <meta property="og:title"         content="{{ $data_array->title }}" />
        <meta property="og:description"   content="{{ $data_array->description }}" />
        @foreach(json_decode($data_array->image) as $img)
        @endforeach
        <meta property="og:image"         content="{{ asset('/uploads/'.$img)}}" />
        <meta property="fb:app_id"         content="2155520864748239" />
			
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@aquatec5"> 
        <meta name="twitter:creator" content="@aquatec5">
        <meta name="twitter:title" content="{{ $data_array->title }}">
        <meta name="twitter:description" content="{{ $data_array->description }}">
        @foreach(json_decode($data_array->image) as $img)
        @endforeach
        <meta name="twitter:image" content="{{ asset('/uploads/'.$img)}}">
	
</head>
<body>
</body>
</html>
		
