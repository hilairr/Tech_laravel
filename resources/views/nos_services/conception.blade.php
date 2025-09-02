@extends('layouts.app')

@section ('title')
Ma Boutiques
@endsection

@section('content')
      <div class="container">
        <div class="row mt-5">
          <h1 class="mt-5 text-center bg-info">formation et conception</h1>
        <div class="col-md-6">
          <div class="">
            <img src="image/conception1.jpg" class=" w-100" alt="...">
            <div class="card-body">
              <h5 class="card-title">conception</h5>
              <p class="card-text">Nous sommes une entreprise specialisee dans la conception des sites web <br>et application mobile en fonction de vos besoins ou le besoin de votre entreprise.</p>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="">
            <div class="card-body">
              <h5 class="card-title">Formtion</h5>
              <p class="card-text">Nous aidons et accompagnons egalement des personnes <br>qui souhaitent se faire former dans le domaine du numerique <br>nous offrons comme formation : <br>bureautique <br>conception web et mobile <br>conception des visuels <br>et en maintenaces des ordinateurs.</p>
            </div>
            <img src="image/conception.jpg" class=" w-75" alt="conception">
          </div>
        </div>
      </div>
    </div>
    @endsection