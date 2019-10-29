@extends('layouts.admin')

@section('admin.content')
	<table class="table table-bordered">
		<thead>
			<tr>
			<th scope="col">#</th>
			<th scope="col">Name</th>
			<th scope="col">Price</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($products as $product)
				<tr>
					<th scope="row">{{ $product->id }}</th>
					<td>{{ $product->name }}</td>
					<td>{{ $product->price }}</td>
				</tr>
	        @endforeach
		</tbody>
	</table>
@endsection