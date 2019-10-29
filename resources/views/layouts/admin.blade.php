@extends('layouts.app')

@section('content')
<div class="admin-container d-flex flex-row flex-nowrap">
    @include('partials.sidebar')
    <div class="container py-3">
        @yield('admin.content')
    </div>
</div>
@endsection
