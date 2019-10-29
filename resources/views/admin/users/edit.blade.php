@extends('layouts.admin')

@section('admin.content')
	<form method="POST" action="{{ route('admin.users.update', $user->id) }}">
		<div class="form-group">
			<label>Username: </label>
			<label>{{$user->username}}</label>
		</div>
		<div class="form-group">
			<label>Name: </label>
			<label>{{$user->name}}</label>
		</div>
		<div class="form-group">
			<label>Email address: </label>
			<label>{{$user->email}}</label>
		</div>
		<div class="form-group">
			<label>Roles: </label> <br>
			@foreach ($user->roles as $role)
				<label>{{$role->name}}</label> <br>
	        @endforeach
		</div>
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>
@endsection