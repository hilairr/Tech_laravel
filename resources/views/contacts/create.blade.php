@extends('layouts.app')

@section('title')
    
    Contactez-nous
@endsection

@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h3>Contactez-nous</h3>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success text-center" role="alert">
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

                    <form action="{{ route('contacts.store') }}" method="POST">
                        @csrf
                        <!-- Champs cachés pour nom et email -->
                        <input type="hidden" name="name" value="{{ Auth::user()->name ?? '' }}">
                        <input type="hidden" name="email" value="{{ Auth::user()->email ?? '' }}">

                        <!-- Affichage des informations pour l'utilisateur -->
                        @if (Auth::check())
                            <div class="mb-3">
                                <p><strong>Nom :</strong> {{ Auth::user()->name }}</p>
                                <p><strong>Email :</strong> {{ Auth::user()->email }}</p>
                            </div>
                        @else
                            <div class="alert alert-warning text-center" role="alert">
                                Vous devez être connecté pour envoyer un message.
                            </div>
                        @endif

                        <div class="mb-3">
                            <label for="subject" class="form-label">Sujet</label>
                            <input type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" value="{{ old('subject') }}" required>
                            @error('subject')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="6" required>{{ old('message') }}</textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary" @if (!Auth::check()) disabled @endif>Envoyer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection