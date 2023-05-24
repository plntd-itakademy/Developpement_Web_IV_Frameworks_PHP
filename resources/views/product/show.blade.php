@extends('layouts.app')
@section('title', 'Détail du produit')


@section('content')
    <div class="container">
        <div class="card mx-auto" style="max-width: 800px;">
            <div class="card-body">
                <h1 class="card-title">{{ $product->title }}</h1>
                <p class="card-text">{{ $product->description }}</p>
                <p class="card-text">{{ $product->price }}€</p>

                <form method="POST" action="{{ route('orders.place') }}" class="mb-4">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="form-group">
                        <label for="quantity">Quantité :</label>
                        <input type="number" id="quantity" name="quantity" min="1" max="5" value="1" class="form-control form-control-sm" style="width: 50px; margin-bottom: 10px;">
                    </div>
                    <button type="submit" class="btn btn-primary">Commander maintenant</button>
                </form>
            </div>
        </div>
    </div>
@endsection