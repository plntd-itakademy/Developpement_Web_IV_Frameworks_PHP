@extends('layouts.app')
@section('title', 'Panier')

@section('content')
<div class="container">
    <h1>Panier</h1>

    @if(count($cart_items) > 0)
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Prix unitaire</th>
                    <th>Quantité</th>
                    <th>Total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart_items as $item)
                    <tr>
                        <td><a href="{{ route('products.show', ['id' => $item['product']['id']]) }}">{{ $item['product']['title'] }}</a></td>
                        <td>{{ $item['product']['price'] }}€</td>
                        <td>
                            <form action="{{ route('cart.update', ['id' => $item['product']->id]) }}" method="GET">
                                @csrf
                                <input type="number" class="form-control" name="quantity" value="{{ $item['quantity'] }}" min="1" max="5">
                                <button type="submit" class="btn btn-primary btn-sm">Modifier</button>
                            </form>
                        </td>
                        <td>{{ $item['product']['price'] * $item['quantity'] }}€</td>
                        <td>
                            <a href="{{ route('cart.remove', ['id' => $item['product']->id]) }}" class="btn btn-danger btn-sm">Supprimer</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="text-right">
        <h4>Total : {{ $total }}€</h4>
        <form action="{{ route('orders.place') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Passer la commande</button>
        </form>
    </div>

    @else
    <div class="alert alert-info" role="alert">
        Votre panier est vide.
    </div>

    <div class="text-center">
        <a href="{{ route('products.index') }}" class="btn btn-primary">Retourner à la liste des produits</a>
    </div>
    @endif

</div>
@endsection
