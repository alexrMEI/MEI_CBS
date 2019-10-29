@extends('layouts.admin')

@section('admin.content')
	<table class="table table-bordered">
		<thead>
			<tr>
			<th scope="col">#</th>
			<th scope="col">Name</th>
			<th scope="col">Versão</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($files as $file)
				<tr>
					<th scope="row">{{ $file->id }}</th>
					<td>{{ $file->name }}</td>
					<td>{{ $file->product_version }}</td>
				</tr>
	        @endforeach
		</tbody>
	</table>
@endsection