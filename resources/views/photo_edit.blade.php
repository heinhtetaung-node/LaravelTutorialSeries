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
		<input type="hidden" name="id" value="{{ $photo->id }}">
		Name <input type="text" name="photoname" value="{{ $photo->photoname }}">
		 Description<input type="text" name="description" value="{{ $photo->description }}">

		 Gallery
		 <select name="gallery_id">
		 	@foreach($gallery as $g)
		 		<option  @if($g->id == $photo->gallery_id) {{ 'selected' }} @endif value="{{ $g->id }}">{{ $g->galleryname }}</option>
		 	@endforeach
		 </select>

		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="submit" name="submit" value="submit">
	</form>
</div>
@endsection
