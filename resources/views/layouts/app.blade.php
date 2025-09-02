<html lang="fr">

<head>

    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="image/favicon.ico">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="{{ asset('css/bootstrap.min.css') }}">
    <link href="{{ asset('css/bootstrap.min.css') }}">

    <title>TecMark</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-primary fixed-top">
        <div class="container-fluid">
            <a href="{{ route('acceuille.index') }}">
                <img src="image/logo.jpg" style="height: 50px;" alt="logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active text-white fs-4" aria-current="page" href="{{route('acceuille.index')}}">Accueil</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white fs-4" href="{{route('boutiques.boutique')}}">Boutique</a>
                    </li>
                    <li class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggl text-white fs-4" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Nos Services
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item text-dark fs-4" href="{{ route('nos_services.maintenance') }}">Maintenance</a></li>
                            <li><a class="dropdown-item text-dark fs-4" href="{{ route('nos_services.conception') }}">Conception</a></li>
                            <li><a class="dropdown-item text-dark fs-4" href="{{ route('nos_services.autres') }}">autres</a></li>
                        </ul>
                    </li>
                </ul>
                <a href="{{route('paniers.cart')}}"><i class="fa-solid fa-cart-shopping text-white mx-3"><span></span></i></a>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success bg-white text-dark" type="submit">Search</button>
                </form>
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-user mx-2"></i>
                        <span class="text-muted">
                            {{ auth()->check() ? auth()->user()->name : 'connexion' }}
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        @if (auth()->check())

                        <li>
                            <form action="{{ route('logout') }}" method="POST" class="p-0 m-0">
                                @csrf
                                <button type="submit" class="dropdown-item">Déconnexion</button>
                            </form>
                        </li>
                        @else
                        <li>
                            <a class="dropdown-item" href="{{ route('login') }}">Connexion</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('register') }}">Inscription</a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    @yield ('content')
    <footer class="container-fluid ">
        <div class="row bg-dark mt-5 text-white ">
            <div class="col-md-4 text-center mt-3 mb-5">
                <h3>contactez nous </h3>
                <a href="tel:00226 62836424">telephone: 62836424</a> <br>
                <a href="mail to: hilairebonkoungou206@gmail.com">mail: hilairebonkoungou206@gmail.com</a>
            </div>
            <div class="col-md-4 mt-3 mb-5">
                <h3>Notre Situation Geographique </h3>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d60349259.53341654!2d-120.74786049999999!3d-22.600543799999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94c8e41662584685%3A0x86e0a98185200dc5!2sGoldentech!5e0!3m2!1sfr!2sbf!4v1744368725858!5m2!1sfr!2sbf" width="300" height="me-auto" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="col-md-4 mt-3 mb-5">
                <h3> Qui nous sommes</h3>
                <p>une entreprise innovante dans la technologie située à ouagadougou <br>nous sommes specialisés dans le developpement web <br>developpement mobile <br>ainsi que la vente des produits informatique tel que <br>les ordinateurs portables <br>les ordinateurs burautiques et autres</p>
            </div>
        </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>

</html>