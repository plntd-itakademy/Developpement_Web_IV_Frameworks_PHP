@extends('layouts.app')
@section('title', 'Détail du produit')

@section('content')
    <h1>{{ $product->title }}</h1>
    <p>{{ $product->description }}</p>
    <p>Prix : {{ $product->price }}€</p>

    <form method="POST" action="{{ route('orders.place') }}">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <label for="quantity">Quantité :</label>
        <input type="number" id="quantity" name="quantity" min="1" max="5" value="1">

        <button type="submit">Commander maintenant</button>
    </form>
@endsection