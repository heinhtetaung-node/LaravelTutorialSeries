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
			<td><a href="{{ route('gallery.index') }}">Gallery</a></td>
			<td><a href="{{ route('admin.register') }}">Admin</a></td>
			<td>				
				<a href="{{ route('logout') }}"
	                onclick="event.preventDefault();
	                         document.getElementById('logout-form').submit();">
	                Logout
	            </a>

	            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	                {{ csrf_field() }}
	            </form>
			</td>
		</tr>		
	</table>	
      
    @yield('content')
</body>
</html>