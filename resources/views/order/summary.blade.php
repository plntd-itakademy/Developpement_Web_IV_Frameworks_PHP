@extends('layouts.app')
@section('title', 'Détail de la commande')

@section('content')
    <h1>Détail de la commande</h1>
    <p>Numéro de commande : {{ $order->id }}</p>
    <p>Produit : {{ $product->title }}</p>
    <p>Quantité : {{ $order->quantity }}</p>
    <p>Prix total : ${{ $product->price * $order->quantity }}</p>
    <p>Client : {{ $user->name }}</p>
@endsection