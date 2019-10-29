@extends('layouts.admin')

@section('admin.content')
	<h3>Failed Login Attempts</h3>
	<table class="table table-bordered">
		<thead>
			<tr>
			<th scope="col">#</th>
			<th scope="col">Email</th>
			<th scope="col">Date</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($failedLogins as $failedLogin)
				<tr>
					<th scope="row">{{ $failedLogin->id }}</th>
					<td>{{ $failedLogin->email_address }}</td>
					<td>{{ $failedLogin->created_at }}</td>
				</tr>
	        @endforeach
		</tbody>
	</table>
@endsection