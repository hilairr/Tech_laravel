<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7"
          crossorigin="anonymous">

    <!-- Tailwind -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Figtree', sans-serif;
        }

        /* Logo et halo */
        .logo-container {
            position: relative;
            display: inline-block;
        }

        .logo {
            width: 90px;
            height: auto;
            object-fit: contain;
            border-radius: 50%;
            z-index: 10;
            position: relative;
        }

        .logo-halo {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: rgba(59, 130, 246, 0.4);
            filter: blur(15px);
            z-index: 5;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: translate(-50%, -50%) scale(0.9); opacity: 0.6; }
            50% { transform: translate(-50%, -50%) scale(1.1); opacity: 1; }
            100% { transform: translate(-50%, -50%) scale(0.9); opacity: 0.6; }
        }

        /* Auth card */
        .auth-card {
            max-width: 420px;
            width: 100%;
            border-radius: 1rem;
        }

        /* Gradient background animation */
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .bg-gradient-animated {
            background: linear-gradient(270deg, #3b82f6, #2563eb, #1e40af);
            background-size: 600% 600%;
            animation: gradient 12s ease infinite;
        }
    </style>
</head>

<body class="bg-gray-100 dark:bg-gray-900">

    <!-- Gradient background -->
    <div class="position-absolute top-0 start-0 w-100 min-vh-100 bg-gradient-animated"></div>
    <!-- Overlay sombre -->
    <div class="position-absolute top-0 start-0 w-100 min-vh-100 bg-black bg-opacity-40"></div>

    <!-- Contenu centré -->
    <div class="min-vh-100 d-flex flex-column justify-content-center align-items-center position-relative z-10">

        <!-- Logo avec halo -->
        <div class="mb-4 logo-container">
            <div class="logo-halo"></div>
            <img src="{{ asset('image/logo.jpg') }}" alt="Logo" class="logo shadow-sm bg-white p-2">
        </div>

        <!-- Auth Card -->
        <div class="auth-card bg-white dark:bg-gray-800 shadow-lg overflow-hidden px-4 py-5 sm:px-6">

            <!-- Formulaire dynamique -->
            <form method="POST" action="{{ request()->routeIs('login') ? route('login') : route('register') }}">
                @csrf

                @if(request()->routeIs('register'))
                    <!-- Name (Register only) -->
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Nom</label>
                        <input type="text" name="name" id="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name') }}" required autofocus>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                @endif

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Email</label>
                    <input type="email" name="email" id="email"
                           class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold">Mot de passe</label>
                    <input type="password" name="password" id="password"
                           class="form-control @error('password') is-invalid @enderror"
                           required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                @if(request()->routeIs('register'))
                    <!-- Confirm Password (Register only) -->
                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label fw-semibold">Confirmer le mot de passe</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                               class="form-control @error('password_confirmation') is-invalid @enderror"
                               required>
                        @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                @endif 

                <!-- Actions -->
                <div class="d-flex justify-content-between align-items-center">
                    @if(request()->routeIs('register'))
                        <a href="{{ route('login') }}" class="text-decoration-none small text-primary">
                            Déjà inscrit ?
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="text-decoration-none small text-primary">
                            Pas encore inscrit ?
                        </a>
                    @endif
                    <button type="submit" class="btn btn-primary px-4">
                        {{ request()->routeIs('register') ? 'S’inscrire' : 'Se connecter' }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
            crossorigin="anonymous"></script>

</body>
</html>
