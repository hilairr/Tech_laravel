
@extends('layouts.app')

@section('title')
    Ma Boutique
@endsection
    
@section('content')
    <div class="container pt-5 py-5">
        @if (session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <p class="bg-info text-center mt-5 p-2">Choisissez nos produits à moindre coût</p>
                <a class="btn btn-primary mb-3" href="{{ route('boutiques.formboutique') }}">Ajouter un produit</a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                @forelse ($boutiques as $boutique)
                    @if ($loop->first)
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">Image</th>
                                    <th scope="col">Nom du produit</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Prix</th>
                                    <th scope="col">Prix promotionnel</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                    @endif
                        <tr data-name="{{ strtolower($boutique->nomproduit) }}">
                            <td class="text-center">
                                <img src="{{ $boutique->image ? Storage::url($boutique->image) : asset('images/default.jpg') }}"
                                     class="img-fluid"
                                     style="max-width: 100px; height: auto;"
                                     alt="{{ $boutique->nomproduit }}"
                                     onmouseover="agrandirImage(this)"
                                     onmouseout="reduireImage(this)">
                            </td>
                            <td>{{ $boutique->nomproduit }}</td>
                            <td>{{ $boutique->description ?? 'Aucune description disponible.' }}</td>
                            <td>
                                <s class="text-muted">{{ number_format($boutique->prix, 2) }} F CFA</s>
                            </td>
                            <td>
                                <span class="fw-bold text-success">{{ number_format($boutique->prixpromo, 2) }} F CFA</span>
                            </td>
                            <td>
                                <!-- Add to Cart Form -->
            

                                <!-- Edit and Delete Buttons -->
                                <div class="mt-2">
                                    <a href="{{ route('boutiques.edit', $boutique->id) }}" class="btn btn-warning btn-sm me-2">
                                        Modifier
                                    </a>
                                    <form action="{{ route('boutiques.destroy', $boutique->id) }}" method="POST" class="d-inline-block"
                                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            Supprimer
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @if ($loop->last)
                            </tbody>
                        </table>
                    @endif
                @empty
                    <div class="col-md-12">
                        <p class="text-center text-muted">Aucun produit disponible pour le moment.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    @section('scripts')
        <script>
            function agrandirImage(img) {
                img.style.transform = 'scale(1.2)';
                img.style.transition = 'transform 0.3s ease';
            }

            function reduireImage(img) {
                img.style.transform = 'scale(1)';
                img.style.transition = 'transform 0.3s ease';
            }
        </script>
    @endsection
@endsection