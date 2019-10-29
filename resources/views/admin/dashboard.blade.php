@extends('layouts.admin')

@section('admin.content')
	<h3>Admin index</h3>
	<a href="{{ url('/admin/authentication') }}">Authentication</a>
@endsection