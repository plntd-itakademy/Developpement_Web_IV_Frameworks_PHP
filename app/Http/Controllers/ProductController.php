<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function show(string $id): View
    {
        return view('product.show', [
            'product' => Product::findOrFail($id)
        ]);
    }

    public function index(): View
    {
        return view('product.index', [
            'products' => DB::table('products')->get()
        ]);
    }
}
