<!DOCTYPE html>
<html>
<head>
    <title>Panier</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    @extends('layouts.app')

    @section('title')
        Mon Panier
    @endsection

    @section('content')
        <div class="container pt-5 py-5">
            <h1>Votre Panier</h1>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @forelse ($paniers as $panier)
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5>{{ $panier->boutique->nomproduit }}</h5>
                                <p>Prix unitaire: {{ number_format($panier->prix_unitaire, 2) }} F CFA</p>
                                <p>Prix total: {{ number_format($panier->prix_total, 2) }} F CFA</p>
                            </div>
                            <div>
                                <!-- Update Form -->
                                <form action="{{ route('paniers.updateCart', $panier->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" name="quantite" value="{{ $panier->quantite }}" min="1" class="form-control d-inline-block w-auto">
                                    <button type="submit" class="btn btn-primary btn-sm">Mettre à jour</button>
                                </form>
                                <!-- Delete Form -->
                                <form action="{{ route('paniers.removeFromCart', $panier->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center">Votre panier est vide.</p>
            @endforelse

            <div class="text-end">
                <h4>Total Commande: {{ number_format($totalCommande, 2) }} F CFA</h4>
            </div>

            <a href="{{ route('boutiques.boutique') }}" class="btn btn-secondary">Continuer les achats</a>
        </div>
    @endsection
</body>
</html>