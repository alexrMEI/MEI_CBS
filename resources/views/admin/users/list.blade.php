@extends('layouts.admin')

@section('admin.content')
	<table class="table table-bordered">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Name</th>
				<th scope="col">Username</th>
				<th scope="col">Email</th>
				<th scope="col">Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($users as $user)
				<tr>
					<th scope="row">{{ $user->id }}</th>
					<td>{{ $user->name }}</td>
					<td>{{ $user->username }}</td>
					<td>{{ $user->email }}</td>
					<td><a href="{{ url('/admin/users/' . $user->id) }}">Edit</a></td>
				</tr>
	        @endforeach
		</tbody>
	</table>
@endsection