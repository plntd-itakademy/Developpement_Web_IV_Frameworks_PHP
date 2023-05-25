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

        $products = $order->products;

        $total_price = 0;
        foreach ($order->products as $product) {
            $total_price += $product->pivot->quantity * $product->pivot->unit_price;
        }

        return view('order.summary', [
            'order' => $order,
            'products' => $products,
            'user' => $user,
            'total_price' => $total_price
        ]);
    }
}
