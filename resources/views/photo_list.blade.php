@extends('layout')

@section('content')
<div>
	Photo list
	<br>
	<a href="{{ route('photos.create') }}">Create</a>
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
					<td>{{ $d->photoname }}</td>
					<td>{{ $d->description }}</td>
					<td><a href="{{ route('photos.edit', $d->id) }}"><button>Edit</button></a> 

					<form method="POST" action="{{ route('photos.destroy', $d->id) }}">
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