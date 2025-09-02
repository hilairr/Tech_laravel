@extends('layouts.app')

@section('title')
    Mon Panier
@endsection

@section('content')
    <div class="container mt-5 mb-5">
        <div class="col-md-12">
            <p class="bg-info text-center mt-5 p-5">Récapitulatif de votre panier</p>
        </div>

        @if (session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        @if ($cartItems->isEmpty())
            <p class="text-center text-muted">Votre panier est vide.</p>
            <a href="{{ route('boutiques.boutique') }}" class="btn btn-primary col-md-3 mx-auto d-block text-info">Retour à la boutique</a>
        @else
            <form action="{{ route('paniers.updateCart') }}" method="POST">
                @csrf
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID Produit</th>
                            <th>Produit</th>
                            <th>Prix unitaire</th>
                            <th>Quantité</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartItems as $item)
                            <tr>
                                <td>{{ $item->boutique_id }}</td>
                                <td>{{ $item->boutique->nomproduit }}</td>
                                <td>{{ number_format($item->boutique->prixpromo > 0 ? $item->boutique->prixpromo : $item->boutique->prix, 2) }} F CFA</td>
                                <td>
                                    <input type="number" name="quantity[{{ $item->id }}]" value="{{ $item->quantity }}" min="1" class="form-control w-25 d-inline">
                                </td>
                                <td>{{ number_format(($item->boutique->prixpromo > 0 ? $item->boutique->prixpromo : $item->boutique->prix) * $item->quantity, 2) }} F CFA</td>
                                <td>
                                    <form action="{{ route('paniers.removeFromCart', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Voulez-vous vraiment supprimer cet article du panier ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="text-end fw-bold">Total de la commande :</td>
                            <td>{{ number_format($total, 2) }} F CFA</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary col-md-3 mx-auto">Mettre à jour le panier</button>
                    <a href="{{ route('boutiques.boutique') }}" class="btn btn-secondary col-md-3 mx-auto">Continuer les achats</a>
                    <a href="{{ route('paniers.validation') }}" class="btn btn-secondary col-md-3 mx-auto">Valider votre commande</a>

                </div>
            </form>
        @endif
    </div>
@endsection