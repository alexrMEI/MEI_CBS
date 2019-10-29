@extends('layouts.admin')

@section('admin.content')
	<table class="table table-bordered">
		<thead>
			<tr>
			<th scope="col">#</th>
			<th scope="col">Key</th>
			<th scope="col">Expiration date</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($licenses as $license)
				<tr>
					<th scope="row">{{ $license->id }}</th>
					<td>{{ $license->key }}</td>
					<td>{{ $license->expiration_date }}</td>
				</tr>
	        @endforeach
		</tbody>
	</table>
@endsection