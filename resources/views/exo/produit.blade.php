@extends('layouts.app')

@section('title')
Récapitulatif du panier
@endsection

@section('content')
<div class="container mt-5 mb-3">
    <div style="margin-top: 75px;">
        <h2 class="text-center mb-3 mt-5">Récapitulatif de votre panier</h2>
    </div>
    <a class="btn btn-primary" href="{{ route('exo.formproduit') }}">Ajouter un produit</a>
    @if (session('success'))
    <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif
    <table class="table table-hover mt-5">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nom Produit</th>
                <th scope="col">Prix</th>
                <th scope="col">Quantité</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($produits as $produit)
            <tr>
                <th scope="row">{{ $produit->id }}</th>
                <td>{{ $produit->nomproduit }}</td>
                <td>{{ $produit->prix }}</td>
                <td>{{ $produit->quantite }}</td>
                <td class="action-buttons d-flex gap-2 align-items-center">
                    <a href="{{ route('exo.details', $produit->id) }}" class="btn btn-info btn-sm">Détails</a>
                  
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">Votre panier est vide.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection