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

        $total = 0;
        foreach ($cart_items as $item) {
            $total += $item['product']->price * $item['quantity'];
        }

        return view('cart', [
            'cart_items' => $cart_items,
            'total' => $total
        ]);
    }

    public function add($id, Request $request)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('products.index');
        }

        $cartItems = session('cart', []);
        $itemIndex = $this->findCartItemIndex($cartItems, $product->id);

        if ($itemIndex !== -1) {
            $cartItems[$itemIndex]['quantity'] += $request->quantity;
        } else {
            $cartItems[] = [
                'product' => $product,
                'quantity' => $request->quantity
            ];
        }

        session(['cart' => $cartItems]);

        return redirect()->route('cart.view');
    }

    public function remove($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('products.index');
        }

        $cart_items = session('cart', []);

        foreach ($cart_items as $key => $item) {
            if ($item['product']->id === $product->id) {
                unset($cart_items[$key]);
            }
        }

        session(['cart' => $cart_items]);

        return redirect()->route('cart.view');
    }

    public function update($id, Request $request)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('products.index');
        }

        $cart_items = session('cart', []);

        foreach ($cart_items as $key => $item) {
            if ($item['product']->id === $product->id) {
                $cart_items[$key]['quantity'] = $request->quantity;
            }
        }

        session(['cart' => $cart_items]);

        return redirect()->route('cart.view');
    }

    private function findCartItemIndex($cartItems, $productId)
    {
        foreach ($cartItems as $index => $item) {
            if ($item['product']->id === $productId) {
                return $index;
            }
        }

        return -1;
    }
}
