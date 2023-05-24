@extends('layouts.app')
@section('title', 'Accueil')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Bienvenue sur notre site e-commerce</h1>
                <p>Découvrez notre sélection de produits.</p>
            </div>
        </div>

        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h2 class="card-title">{{ $product->title }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <p class="card-text">{{ $product->price }}€</p>
                            <a href="{{ route('products.show', ['id' => $product->id]) }}" class="btn btn-primary">Voir le produit</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row">
            <div class="col-md-12 text-center">
                <a href="{{ route('products.index') }}" class="btn btn-primary">Voir tout</a>
            </div>
        </div>
    </div>
@endsection
