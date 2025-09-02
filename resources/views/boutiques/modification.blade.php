```blade
@extends('layouts.app')

@section('title')
    Modifier un Produit
@endsection

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h3>Modifier le produit</h3>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('boutiques.update', $boutique->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <label for="nomproduit" class="form-label">Nom du produit</label>
                            <input type="text" class="form-control @error('nomproduit') is-invalid @enderror" id="nomproduit" name="nomproduit" value="{{ old('nomproduit', $boutique->nomproduit) }}" required>
                            @error('nomproduit')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="prix" class="form-label">Prix du produit</label>
                            <input type="number" class="form-control @error('prix') is-invalid @enderror" id="prix" name="prix" min="0" step="0.01" value="{{ old('prix', $boutique->prix) }}" required>
                            @error('prix')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="prixpromo" class="form-label">Prix promotionnel</label>
                            <input type="number" class="form-control @error('prixpromo') is-invalid @enderror" id="prixpromo" name="prixpromo" min="0" step="0.01" value="{{ old('prixpromo', $boutique->prixpromo) }}">
                            @error('prixpromo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="6">{{ old('description', $boutique->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Télécharger une nouvelle image</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                            @if ($boutique->image)
                                <div class="mt-2">
                                    <p>Image actuelle :</p>
                                    <img src="{{ Storage::url($boutique->image) }}" alt="{{ $boutique->nomproduit }}" class="img-fluid" style="max-width: 200px;">
                                </div>
                            @endif
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Mettre à jour</button>
                            <a href="{{ route('boutiques.boutique') }}" class="btn btn-secondary ms-2">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
```