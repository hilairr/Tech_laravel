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

        <!-- Formulaire de recherche -->
        <div class="row mb-4">
            <div class="col-md-12">
                <form id="search-form" class="d-flex justify-content-center">
                    <input type="text" id="search-input" name="search" class="form-control me-2 " placeholder="Rechercher un produit par nom" value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">Rechercher</button>
                </form>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-md-3 g-4 mt-3" id="product-grid">
            <div class="col-md-12">
                <p class="bg-info text-center mt-5 p-2">Choisissez nos produits à moindre coût</p>
            </div>

            @forelse ($boutiques as $boutique)
                <div class="col product-card" data-name="{{ strtolower($boutique->nomproduit) }}">
                    <div class="card h-100 d-flex flex-column">
                        <div class="image-container p-2" style="height: 250px; overflow: hidden;">
                            <img src="{{ asset('image/' . $boutique->image) }}"
                                 class="img-fluid d-block mx-auto w-100 h-100"
                                 style="object-fit: cover;"
                                 alt="{{ $boutique->nomproduit }}"
                                 onmouseover="agrandirImage(this)"
                                 onmouseout="reduireImage(this)">
                        </div>
                        <div class="card-body d-flex flex-column flex-grow-1">
                            <h5 class="card-title">{{ $boutique->nomproduit }}</h5>
                            <p class="card-text flex-grow-1" style="overflow: auto;">
                                {{ $boutique->description ?? 'Aucune description disponible.' }}
                            </p>
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
                            <!-- Ajoutez ici les boutons d'édition et de suppression si nécessaire, par exemple pour les admins -->
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
@endsection

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

        // Recherche responsive en temps réel
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('search-input');
            const productCards = document.querySelectorAll('.product-card');
            const productGrid = document.getElementById('product-grid');

            // Fonction pour filtrer les produits
            function filterProducts() {
                const searchTerm = searchInput.value.toLowerCase().trim();

                let hasResults = false;

                productCards.forEach(card => {
                    const productName = card.getAttribute('data-name');
                    if (productName.includes(searchTerm)) {
                        card.style.display = 'block';
                        hasResults = true;
                    } else {
                        card.style.display = 'none';
                    }
                });

                // Afficher un message si aucun résultat
                let noResultsMessage = document.getElementById('no-results-message');
                if (!hasResults && searchTerm !== '') {
                    if (!noResultsMessage) {
                        noResultsMessage = document.createElement('div');
                        noResultsMessage.id = 'no-results-message';
                        noResultsMessage.classList.add('col-md-12');
                        noResultsMessage.innerHTML = '<p class="text-center text-muted">Aucun produit trouvé pour cette recherche.</p>';
                        productGrid.appendChild(noResultsMessage);
                    }
                } else {
                    if (noResultsMessage) {
                        noResultsMessage.remove();
                    }
                }
            }

            // Écouter les changements sur l'input de recherche
            searchInput.addEventListener('input', filterProducts);

            // Si une recherche est déjà présente (via URL), appliquer le filtre
            if (searchInput.value !== '') {
                filterProducts();
            }

            // Prévenir le rechargement de la page si on veut garder le formulaire (optionnel)
            const searchForm = document.getElementById('search-form');
            searchForm.addEventListener('submit', function (e) {
                e.preventDefault();
                filterProducts();
            });
        });
    </script>
@endsection