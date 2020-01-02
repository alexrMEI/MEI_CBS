@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Welcome!</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="{{ url('/products') }}">
                        Check out our products
                    </a>
                </div>
                <div>
                    <button type="button" class="btn btn-success" onclick="location.href='{{ route('mailForm') }}'">Mail + Key</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
