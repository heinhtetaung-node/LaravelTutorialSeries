@extends('layout')

@section('content')
<div>
	Gallery list
	<br>
	<a href="{{ route('gallery.create') }}">Create</a>
	<table>
		<thead>
			<tr>
				<th>Id</th>
				<th>Name</th>
				<th>Description</th>
				<th>Options</th>
			</tr>
		</thead>
		<tbody>
			
			@foreach($datas as $d)
				<tr>
					<td>{{ $d->id }}</td>
					<td>{{ $d->galleryname }}</td>
					<td>{{ $d->gallerydescription }}</td>
					<td><a href="{{ route('gallery.edit', $d->id) }}"><button>Edit</button></a> 

					<form method="POST" action="{{ route('gallery.destroy', $d->id) }}">
						<button>Delete</button>
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						{{ method_field('DELETE') }}
					</form>
					</td>
				</tr>
			@endforeach

		</tbody>
	</table>
</div>
@endsection