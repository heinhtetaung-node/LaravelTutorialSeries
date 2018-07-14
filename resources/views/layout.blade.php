<!DOCTYPE html>
<html>
<head>
	<title>Laravel Tutorial</title>
</head>
<body>
	<table border="1">
		<tr>
			<td><a href="{{ url('/') }}">Home</a></td>
			<td><a href="{{ route('photos.index') }}">Photos</a></td>
		</tr>		
	</table>	
      
    @yield('content')
</body>
</html>