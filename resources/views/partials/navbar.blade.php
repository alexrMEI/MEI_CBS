<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/products') }}">
                        Products
                    </a>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item" style="position: relative;">
                    <a id="cart-button" class="nav-link" onclick="toggleCart()" onmouseover="openCart()" onmouseout="closeCart()">
                        <i class="material-icons">shopping_cart</i>
                    </a>
                    <div id="cart" class="card cart" onmouseover="openCart()" onmouseout="closeCart()">
                        <div class="card-body">
                            <h5 class="card-title">Shopping Cart</h5>
                            <div class="container-fluid d-flex flex-column flex-wrap justify-content-center">
                                <ul class="list-group">
                                    @if($cartProducts)
                                        @foreach ($cartProducts as $product)
                                            <li class="list-group-item">
                                                <p class="card-text">{{ $product->name }}</p>
                                                <p class="card-text">{{ $product->price }}</p>
                                                <a href="{{ route('remove.from.cart', $product->id) }}" class="btn btn-primary">Remove</a>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                                <form class="w3-container w3-display-middle w3-card-4 w3-padding-16" method="POST" id="payment-form" action="{!! URL::to('cart/checkout') !!}">
                                    {{ csrf_field() }}
                                    <button class="btn btn-primary">Checkout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </li>
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>