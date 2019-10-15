@extends('layouts.app')

@section('content')
<div class="container">
    <h3>All products</h3>
    <div class="row justify-content-between">
        @foreach ($products as $product)
            <div class="card" style="width: 18rem; margin: 20px">
                <img src="{{ asset('storage/product-default.jpg') }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">{{ $product->description }}</p>
                    <p class="card-text">{{ $product->price }}€</p>
                    <a href="{{ route('add.to.cart', $product->id) }}" class="btn btn-primary">Add to cart</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
