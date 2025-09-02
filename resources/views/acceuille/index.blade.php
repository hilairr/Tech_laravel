@extends('layouts.app')

@section ('title')
Ma Boutiques
@endsection

@section('content')
<style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-fadeInUp {
            animation: fadeInUp 1s ease-out forwards;
        }
        .bg-overlay {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('image/image4.png') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .title-shadow {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }
    </style>
      <div class="container-fluid mt-5">
       <div class="bg-overlay">
        <div class="container mx-auto px-4">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold text-info titlinfo-shadow mb-6 bg-light">Faites le meilleur de vos choix chez nous</h1>
            </div>
            <div class="flex flex-col items-center  rounded-lg shadow-lg p-6">
                <div class="w-full p-4">
                    <h5 class="text-3xl font-semibold text-center  text-info p-2 rounded animate-fadeInUp" style="animation-delay: 0.2s;">TECHMARKET</h5>
                    <p class="text-lg text-gray-800 mt-4 animate-fadeInUp text-white" style="animation-delay: 0.8s;">
                        TecMarket est une entreprise qualifiée dans le développement web et mobile <br>
                        ainsi que la vente de produits informatiques <br>
                        tels que des ordinateurs de toutes marques, <br>
                        des imprimantes, des projecteurs, des écrans, <br>
                        et bien plus encore...
                    </p>
                    <p class="text-sm text-gray-600 mt-2 animate-fadeInUp text-white" style="animation-delay: 0.6s;">
                        Nous vous offrons le meilleur des services
                    </p>
                </div>
            </div>
        </div>
    </div>


        <div class="row">
          <div class="col">
            <div class="card">
              <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="image/images2.jpg" class="d-block w-100" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="image/image3.jpg" class="d-block w-100" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="image/image4.png" class="d-block w-100" alt="...">
                  </div>
                </div>
              </div>
              <div class="card-body">
                <h5 class="card-title">Ordinateur HP</h5>
                <p class="card-text">Cet ordinateur est de capacité incroyable ,fin et restant pret à excuter vos travaux sans bug .</p>
                <a href="{{ route('boutiques.boutique') }}" class="btn btn-primary" >voir plus</a>
          
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="image/image3.jpg" class="d-block w-100" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="image/image4.png" class="d-block w-100" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="image/images2.jpg" class="d-block w-100" alt="...">
                  </div>
                </div>
              </div>
              <div class="card-body">
                <h5 class="card-title">HP</h5>
                <p class="card-text">Cet ordinateur est de capacité incroyable ,fin et restant pret à excuter vos travaux sans bug .</p>
                <a href="{{ route('boutiques.boutique') }}" class="btn btn-primary" >voir plus</a>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="image/images2.jpg" class="d-block w-100" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="image/image1.jpg" class="d-block w-100" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="image/image4.png" class="d-block w-100" alt="...">
                  </div>
                </div>
              </div>
              <div class="card-body">
                <h5 class="card-title">HP</h5>
                <p class="card-text">Cet ordinateur est de capacité incroyable ,fin et restant pret à excuter vos travaux sans bug .</p>
                <a href="{{ route('boutiques.boutique') }}" class="btn btn-primary" >voir plus</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endsection

      
