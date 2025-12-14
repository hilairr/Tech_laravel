@extends('layouts.app')

@section('title', 'Golden-Tech – Accueil')

@section('content')

<style>
    /* HERO */
    .hero {
        background: #0d0d0d;
        padding: 120px 0;
        color: white;
    }

    .hero-title {
        font-size: 3rem;
        font-weight: 700;
        line-height: 1.2;
    }

    .btn-gold {
        background: #d4b26a;
        border: none;
        padding: 12px 28px;
        border-radius: 8px;
        font-weight: 600;
    }

    .category-icon {
        font-size: 40px;
        color: #d4b26a;
    }

    /* Produits phares */
    .product-card {
        border: none;
        border-radius: 20px;
        padding: 25px;
        background: #ffffff;
        transition: .3s;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
    }

    /* Newsletter */
    .newsletter {
        background: #0d0d0d;
        color: white;
        padding: 60px 0;
    }
</style>

<!-- SECTION HERO -->
<section class="hero text-center">
    <div class="container">
        <h1 class="hero-title mb-4">
            Découvrez l’élégance de<br> la technologie
        </h1>



        <div class="mt-5">
            <img src="{{ asset('image/conception.jpg') }}" class="img-fluid" style="max-height: 350px;">
        </div>
        <a href="{{ route('boutiques.boutique') }}" class="btn btn-gold mt-3">Acheter maintenant</a>

    </div>
</section>


<!-- SECTION CATÉGORIES -->
<section class="py-5">
    <div class="container text-center">
        <div class="row justify-content-center gy-4">

            <div class="col-4 col-md-3">
                <div>
                    <i class="bi bi-phone category-icon"></i>
                </div>
                <p class="mt-2">Smartphones</p>
            </div>

            <div class="col-4 col-md-3">
                <div>
                    <i class="bi bi-laptop category-icon"></i>
                </div>
                <p class="mt-2">Ordinateurs</p>
            </div>

            <div class="col-4 col-md-3">
                <div>
                    <i class="bi bi-smartwatch category-icon"></i>
                </div>
                <p class="mt-2">Montres connectées</p>
            </div>

        </div>
    </div>
</section>


<!-- SECTION PRODUITS PHARES -->
<section class="py-5 bg-light">
    <div class="container">

        <h2 class="fw-bold mb-5">Produits phares</h2>

        <div class="row gy-4">

            <!-- Produit 1 -->
            <div class="col-md-4">
                <div class="product-card text-center">
                      <img src="{{ asset('image/montre1.jpg') }}"  class="img-fluid mb-3" style="height: 150px;">
                    <h5>Smartpmant</h5>
                    <p class="text-muted">À partir de 299,99 €</p>
                    <a class="btn btn-gold" href="#">Ajouter au panier</a>
                </div>
            </div>

            <!-- Produit 2 -->
            <div class="col-md-4">
                <div class="product-card text-center">
                    <img src="{{ asset('image/images2.jpg') }}" class="img-fluid mb-3" style="height: 150px;">
                    <h5>Lapook</h5>
                    <p class="text-muted">150000 F CFA</p>
                    <a class="btn btn-gold" href="paniers">Ajouter au panier</a>
                </div>
            </div>

            <!-- Produit 3 -->
            <div class="col-md-4">
                <div class="product-card text-center">
                    <img src="{{ asset('image/earbuds.png') }}" class="img-fluid mb-3" style="height: 150px;">
                    <h5>Lanntio</h5>
                    <p class="text-muted">À partir de 159,00 €</p>
                    <a class="btn btn-gold" href="#">Ajouter au panier</a>
                </div>
            </div>

        </div>

    </div>
</section>


<!-- SECTION NEWSLETTER -->
<section class="newsletter text-center">
    <div class="container">

        <h3 class="fw-bold mb-3">Abonnez-vous à notre newsletter</h3>
        <p class="mb-4">Saisissez votre adresse e-mail pour recevoir nos offres et nouveautés</p>

        <div class="d-flex justify-content-center">
            <input type="email" placeholder="Votre adresse e-mail" class="form-control w-50 me-2">
            <button class="btn btn-gold">S'inscrire</button>
        </div>

    </div>
</section>

@endsection