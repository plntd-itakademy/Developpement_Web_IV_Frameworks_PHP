@extends('layouts.app')
@section('title', 'Détail de la commande')

@section('content')
    <div class="container">
        <h1>Détail de la commande</h1>
        <p>Numéro de commande : {{ $order->id }}</p>
        <p>Client : {{ $user->name }}</p>
        <p>Prix total : {{ $total_price }}</p>

        <h3>Les produits :</h3>
        @foreach ($products as $product)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->title }}</h5>
                    <p class="card-text">Prix unitaire : {{ $product->pivot->unit_price }}</p>
                    <p class="card-text">Quantité : {{ $product->pivot->quantity }}</p>
                </div>
            </div>
        @endforeach
    </div>
@endsection