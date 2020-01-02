<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Licenças') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/custom.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <meta name="google-signin-scope" content="profile email">
    <meta name="google-signin-client_id" content="701642659233-gvflkbfd62kaerkkv4m50jnqdnmrq6p9.apps.googleusercontent.com">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <script src="https://www.paypal.com/sdk/js?client-id=Af9Cqta-_ZlnJTDIlKBToAGM5etqil_7O1khFrtq1iVwMezOsT9Khn4tFiNwDGr9aSoov6He0JDsx8lh&currency=EUR"></script>

</head>
<body>

    @include('partials.navbar')

    <div class="container" id="app">
        <div class="row justify-content-between">
            <h2>Our products</h2>
            @foreach ($products as $product)
                <div class="card" style="width: 18rem; margin: 20px">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <p id="price" class="card-text">{{ $product->price }}</p>
                        <a href="{{ route('add.to.cart', $product->id) }}" class="btn btn-primary">Add to cart</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
