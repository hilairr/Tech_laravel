@extends('layouts.app')

@section ('title')
Ma Boutiques
@endsection

@section('content')
<div class="col">
        <div class="row mt-5">
          <div class="col-12 mt-5 text-center bg-info">
            <h3>Services Maintenances</h3>
          </div>
        </div>
        <div class="  mt-3 ">
          <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="image/maintenance.jpg" class="d-block w-50 mx-auto" alt="...">
              </div>
              <div class="carousel-item">
                <img src="image/maintenace2.jpg" class="d-block w-50 mx-auto" alt="...">
              </div>
              <div class="carousel-item">
                <img src="image/maintenance3.jpg" class="d-block w-50 mx-auto" alt="...">
              </div>
            </div>
          </div>
          <div class="card-body">
            <h5 class="card-title texte-justify text-center">Confiez nous vos ordinateurs</h5>
            <p class="card-text texte-justify text-center">Nous diagnontication avec professionalisme vos machines en panne <br>et nous apportons une solution adequate  .</p>
            <p class="text-center"><a href="{{route('contacts.create')}}" class="btn btn-primary " >contactez-nous</a></p>
          </div>
        </div>
      </div>
      @endsection