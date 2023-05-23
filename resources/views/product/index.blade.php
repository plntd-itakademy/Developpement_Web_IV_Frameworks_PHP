@extends('layouts.app')
@section('title', 'Tous les produits')

@section('content')
    @foreach ($products as $product)
    <h1>{{ $product->title }}</h1>
    <p>{{ $product->description }}</p>
    <p>Prix : {{ $product->price }}€</p>
    <a href="{{ route('products.show', ['id' => $product->id]) }}">Voir le produit</a>
    @endforeach
@endsection