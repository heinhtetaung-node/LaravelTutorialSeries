@extends('layout')

@section('content')
<div>
	<h1>Gallery</h1>    

	@if ($errors->has('galleryname'))
		<span>{{ $errors->first('galleryname') }}</span>		
	@endif

	@if ($errors->has('gallerydescription'))
		<span>{{ $errors->first('gallerydescription') }}</span>
	@endif

	<form action="{{ route('gallery.store') }}" method="POST"> 
		<input type="hidden" name="id" value="{{ $gallery->id }}">
		Name <input type="text" name="galleryname" value="{{ $gallery->galleryname }}">
		 Description<input type="text" name="gallerydescription" value="{{ $gallery->gallerydescription }}">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="submit" name="submit" value="submit">
	</form>
</div>
@endsection
