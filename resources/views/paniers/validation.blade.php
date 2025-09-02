@extends('layouts.app')

@section('title')
    Mon Panier
@endsection

@section('content')
    <div class="container mt-5 mb-5">
        <div class="col-md-12">
            <p class="bg-info text-center mt-5 p-5">mode de payement</p>
        </div>

        @if (session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        @if ($cartItems->isEmpty())
            <p class="text-center text-muted">Votre panier est vide.</p>
            <a href="{{ route('boutiques.boutique') }}" class="btn btn-primary col-md-3 mx-auto d-block text-info">Retour à la boutique</a>
        @else
            <form action="{{ route('paniers.updateCart') }}" method="POST">
                @csrf
                <table class="table table-bordered table-striped">
                    
                    <tfoot>
                        <tr>
                            <td colspan="4" class="text-end fw-bold">Total de la commande :</td>
                            <td>tapez *144*4*6*{{ number_format($total, 2) }}# F CFA</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>

               
            </form>

            <!-- Formulaire pour valider la commande -->
            <form action="{{ route('paniers.validation') }}" method="POST" class="mt-4">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-md-3">
                        <label for="phone_number" class="form-label">Numéro de téléphone</label>
                        <div class="input-group">
                            <span class="input-group-text">+226</span>
                            <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="Numéro de téléphone" required pattern="[0-9]{8}" title="Veuillez entrer un numéro de téléphone valide à 8 chiffres">
                        </div>
                        @error('phone_number')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="otp" class="form-label">Code OTP</label>
                        <input type="text" name="otp" id="otp" class="form-control" placeholder="Entrez le code OTP" required>
                        @error('otp')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                  <button type="submit" class="btn btn-success col-md-3 mx-auto mt-3 d-block">Valider La Commande</button>

                 <div class="d-grid gap-2">
                    <a href="{{ route('boutiques.boutique') }}" class="btn btn-secondary col-md-3 mx-auto">Continuer les achats</a>
                </div>
x            </form>
        @endif
    </div>
@endsection