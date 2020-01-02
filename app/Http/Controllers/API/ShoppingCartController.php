<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;

use App\Product;

class ShoppingCartController extends Controller
{
    public function addToCart(Product $product)
    {
        Cart::add($product->id, $product->name, 1, $product->price);
        return back();
    }

    public function removeProductFromCart($productId)
    {
        Cart::remove($productId);
        return back();
    }

    public function destroyCart()
    {
        Cart::destroy();
        return back();
    }
}
