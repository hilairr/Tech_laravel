@extends('layouts.app')

@section('title')
    Confirmation de commande
@endsection

@section('content')
<div class="container mt-5 mb-5 text-center">
    <div class="card shadow-lg p-4">
        <div class="card-body">
            <h2 class="text-success mb-4">✅ Commande validée avec succès !</h2>

            @if (session('success'))
                <div class="alert alert-success text-center">{{ session('success') }}</div>
            @endif

            <p class="mb-4">Merci pour votre achat, <strong>{{ Auth::user()->name ?? 'Cher client' }}</strong> !</p>

            <div class="alert alert-info w-75 mx-auto">
                <h5>Détails de votre commande</h5>
                <p><strong>Numéro de commande :</strong> #{{ $commande->id }}</p>
                <p><strong>Montant total :</strong> {{ number_format($commande->total, 2) }} F CFA</p>
                <p><strong>Statut :</strong> {{ ucfirst($commande->status) }}</p>
                <p><strong>Téléphone :</strong> +226 {{ $commande->phone_number }}</p>
            </div>

            <div class="d-flex justify-content-center gap-3 mt-4">
                <a href="{{ route('paniers.recu', $commande->id) }}" class="btn btn-primary">📄 Télécharger le reçu PDF</a>
                <a href="{{ route('boutiques.boutique') }}" class="btn btn-outline-success">🛍️ Continuer mes achats</a>
            </div>
        </div>
    </div>
</div>
@endsection
