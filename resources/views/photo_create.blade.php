@extends('layout')

@section('content')
<div>
	<h1>Photo</h1>
                        
	@if ($errors->has('photoname'))
		<span>{{ $errors->first('photoname') }}</span>		
	@endif

	@if ($errors->has('description'))
		<span>{{ $errors->first('description') }}</span>
	@endif

	<form action="{{ route('photos.store') }}" method="POST"> 
		Name <input type="text" name="photoname" value="{{ old('photoname') }}">
		 Description<input type="text" name="description" value="{{ old('description') }}">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="submit" name="submit" value="submit">
	</form>
</div>
@endsection
