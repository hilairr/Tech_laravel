@extends('layouts.app')

@section('title')
    Détails du produit
@endsection

@section('content')
<div class="container mt-5 mb-3">
    <div style="margin-top: 75px;">
        <h2 class="text-center mb-3 mt-5">Détails du produit</h2>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-info text-white text-center">
                    <h3>{{ $produit->nomproduit }}</h3>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            @if ($produit->image)
                                <img src="{{ asset('storage/' . $produit->image) }}" alt="{{ $produit->nomproduit }}" class="img-fluid" style="max-width: 100%; height: auto;">
                            @else
                                <p class="text-center">Aucune image disponible</p>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <h5>Prix</h5>
                            <p>{{ number_format($produit->prix, 2) }} fcf</p>
                            <h5>Quantité</h5>
                            <p>{{ $produit->quantite }}</p>
                            <h5>Description</h5>
                            <p>{{ $produit->description ?? 'Aucune description' }}</p>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <a href="{{ route('exo.produit') }}" class="btn btn-secondary">Retour au récapitulatif</a>
                        <a href="{{ route('exo.modification', $produit->id) }}" class="btn btn-warning">Modifier</a>
                        <form action="{{ route('exo.destroy', $produit->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer ce produit ?');" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection