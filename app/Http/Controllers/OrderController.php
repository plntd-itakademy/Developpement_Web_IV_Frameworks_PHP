<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function place(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('home');
        }

        $user_id = Auth::id();
        $user = User::find($user_id);

        $quantity = $request->quantity;
        $product_id = $request->product_id;
        $product = Product::find($product_id);

        if (!$product) {
            return redirect()->route('products.index');
        }

        $order = new Order([
            'user_id' => $user_id,
        ]);
        $order->save();

        $order->products()->attach($product_id, [
            'quantity' => $quantity,
            'unit_price' => $product->price,
        ]);

        return view('orders.summary', [
            'order' => $order,
            'product' => $product,
            'user' => $user
        ]);
    }
}
