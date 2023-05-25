<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function view(): View
    {
        $cart_items = session('cart', []);

        return view('cart', ['cart_items' => $cart_items]);
    }

    public function add(Request $request)
    {
        $product = Product::find($request->product_id);
        dd($product);

        if (!$product) {
            return redirect()->route('products.index');
        }

        $cart_items = session('cart', []);
        $cart_items[$product->id] = $product;
        session(['cart' => $cart_items]);

        return redirect()->route('cart.view');
    }

    public function remove(Request $request)
    {
        $product = Product::find($request->product_id);

        if (!$product) {
            return redirect()->route('products.index');
        }

        $cart_items = session('cart', []);
        unset($cart_items[$product->id]);
        session(['cart' => $cart_items]);

        return redirect()->route('cart.view');
    }
}
