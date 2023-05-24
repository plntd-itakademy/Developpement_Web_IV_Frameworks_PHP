@extends('layouts.app')
@section('title', 'Tous les produits')

@section('content')
    <div class="container">
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="card-title">{{ $product->title }}</h1>
                            <p class="card-text">{{ $product->description }}</p>
                            <p class="card-text">{{ $product->price }}€</p>
                            <a href="{{ route('products.show', ['id' => $product->id]) }}" class="btn btn-primary">Voir le produit</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection