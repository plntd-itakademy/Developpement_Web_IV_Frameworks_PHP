<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function place()
    {
        $user_id = Auth::id();
        $user = User::find($user_id);

        $cart_items = session('cart', []);

        if (count($cart_items) === 0) {
            return redirect()->route('cart.view');
        }

        $order = new Order([
            'user_id' => $user_id,
        ]);
        $order->save();

        $total_price = 0;

        foreach ($cart_items as $item) {
            $product = Product::find($item['product']->id);

            if ($product) {
                $quantity = $item['quantity'];
                $unit_price = $product->price;

                $order->products()->attach($product->id, [
                    'quantity' => $quantity,
                    'unit_price' => $unit_price,
                ]);

                $total_price += $quantity * $unit_price;
            }
        }

        session()->forget('cart');

        return view('order.summary', [
            'order' => $order,
            'products' => $order->products,
            'user' => $user,
            'total_price' => $total_price
        ]);
    }
}
