
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

        <div class="row row-cols-1 row-cols-md-3 g-4 mt-3">
            <div class="col-md-12">
                <p class="bg-info text-center mt-5 p-2">Choisissez nos produits à moindre coût</p>
               
            </div>

            @forelse ($boutiques as $boutique)
                <div class="col product-card" data-name="{{ strtolower($boutique->nomproduit) }}">
                    <div class="card h-100">
                        <div class="d-flex justify-content-center align-items-center p-2">
                            <img src="{{asset('image/' . $boutique->image) }}"
                                class="img-fluid d-block mx-auto w-100"
                                alt="{{ $boutique->nomproduit }}"
                                onmouseover="agrandirImage(this)"
                                onmouseout="reduireImage(this)">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $boutique->nomproduit }}</h5>
                            <p class="card-text">{{ $boutique->description ?? 'Aucune description disponible.' }}</p>
                            <div class="card-body">
                                <s class="text-muted">{{ number_format($boutique->prix, 2) }} F CFA</s>
                                <span class="fw-bold text-success">{{ number_format($boutique->prixpromo, 2) }} F CFA</span>

                                <!-- Add to Cart Form -->
                                <form action="{{ route('paniers.store', $boutique->id) }}" method="POST" class="mt-4">
                                    @csrf
                                    <input type="number" name="quantity" value="1" min="1" class="form-control d-inline-block w-auto me-2">
                                    <button type="submit" class="btn btn-primary">
                                        Ajouter au panier
                                    </button>
                                </form>

                                <!-- Edit and Delete Buttons -->
                                
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-md-12">
                    <p class="text-center text-muted">Aucun produit disponible pour le moment.</p>
                </div>
            @endforelse
        </div>
    </div>

    @section('scripts')
        <script>
            function agrandirImage(img) {
                img.style.transform = 'scale(1.1)';
                img.style.transition = 'transform 0.3s ease';
            }

            function reduireImage(img) {
                img.style.transform = 'scale(1)';
                img.style.transition = 'transform 0.3s ease';
            }
        </script>
    @endsection
@endsection
