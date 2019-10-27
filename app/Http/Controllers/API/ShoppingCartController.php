<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Product;

class ShoppingCartController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addProduct(Request $request, $productId)
    {
        $cart = $request->session('cart', array());

        $product = Product::find($productId);

        $request->session()->push('cart', $product);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function removeProduct(Request $request, $productId)
    {
        $product = Product::find($productId);

        $cart = session()->pull('cart', []); // Second argument is a default value
        if(($key = array_search($product, $cart)) !== false) {
            unset($cart[$key]);
        }
        session()->put('cart', $cart);

        return back();
    }

    public function checkout(Request $request) {

        $request = new OrdersCreateRequest();
        $request->headers["prefer"] = "return=representation";        
    }
}
