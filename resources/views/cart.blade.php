@extends('layouts.app')
@section('title', 'Panier')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Panier</h1>
        </div>

        <div class="row">
            <table class="table">
                @foreach ($cart_items as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
