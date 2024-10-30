<link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/offcanvas-navbar/">
<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
  body {
    font-size: 14px;
  }

  .bd-placeholder-img {
    font-size: 1.125rem;
    text-anchor: middle;
    user-select: none;
  }

  .b-example-divider {
    width: 100%;
    height: 3rem;
    background-color: rgba(0, 0, 0, .1);
    border-width: 1px 0;
    box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1);
  }

  .b-example-vr {
    flex-shrink: 0;
    width: 1.5rem;
    height: 100vh;
  }

  .bi {
    vertical-align: -.125em;
    fill: currentColor;
  }

  .nav-scroller {
    position: relative;
    z-index: 2;
    height: 2.75rem;
    overflow-y: hidden;
  }

  .nav-scroller .nav {
    display: flex;
    flex-wrap: nowrap;
    overflow-x: auto;
    text-align: center;
    white-space: nowrap;
  }

  .btn-bd-primary {
    --bd-violet-bg: #712cf9;
    --bd-violet-rgb: 112.520718, 44.062154, 249.437846;
    --bs-btn-font-weight: 600;
    --bs-btn-color: var(--bs-white);
    --bs-btn-bg: var(--bd-violet-bg);
    --bs-btn-border-color: var(--bd-violet-bg);
    --bs-btn-hover-color: var(--bs-white);
    --bs-btn-hover-bg: #6528e0;
    --bs-btn-hover-border-color: #6528e0;
    --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
    --bs-btn-active-color: var(--bs-btn-hover-color);
    --bs-btn-active-bg: #5a23c8;
    --bs-btn-active-border-color: #5a23c8;
  }

  .bd-mode-toggle {
    z-index: 1500;
  }

  .bd-mode-toggle .dropdown-menu .active .bi {
    display: block !important;
  }

  @media (min-width: 768px) {
    body {
      font-size: 16px;
    }
    .bd-placeholder-img-lg {
      font-size: 16px;
    }
    .nav-scroller .nav {
      padding-bottom: 0.75rem;
    }
  }

  @media (min-width: 1200px) {
    body {
      font-size: 18px;
    }
    .bd-placeholder-img-lg {
      font-size: 18px;
    }
  }

  /* Stili per la navbar */
  .navbar-nav .nav-item {
    margin: 0;
    padding: 0;
  }

  .navbar-nav .nav-link {
    padding: 0.5rem 1rem; /* Aggiusta questo valore se necessario */
  }

  @media (min-width: 992px) {
    .navbar .nav-item {
      padding-top: 0;
      padding-bottom: 0;
      margin-top: auto;
      margin-bottom: auto;
    }
  }
</style>

<nav class="navbar navbar-expand-lg bg-body-tertiary shadow">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('homepage') }}">AulaLab Post</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('homepage') }}">Home</a>
        </li>
        @auth
        @if (Auth::user()->is_admin)
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard Admin</a>
        </li>
        @endif
        <li class="nav-item">
          <a class="nav-link" href="{{ route('articles.create') }}">Inserisci un articolo</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ route('articles.index') }}">Tutti gli articoli</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ route('careers') }}">Lavora con noi</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Ciao, {{ Auth::user()->name }}
          </a>
          <ul class="dropdown-menu">
            @if (Auth::user()->is_revisor)
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard Admin</a>
            </li>
            @endif
            @if (Auth::user()->is_writer)
              <li><a class="dropdown-item" href="{{route('writer.dashboard')}}">Dashboard Writer</a></li>
            @endif
              <li>
              <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('form-logout').submit();">Logout</a>
              <form id="form-logout" action="{{ route('logout') }}" method="post" class="d-none">@csrf</form>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="#">Contatti</a></li>
          </ul>
        </li>
        @else
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Ciao utente!
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('login') }}">Accedi</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="{{ route('register') }}">Registrati</a></li>
          </ul>
        </li>
        @endauth
      </ul>
      <form action="{{ route('article.search') }}" method="GET" class="d-flex" role="search">
        <input class="form-control me-2" type="search" name="query" placeholder="Cerca tra gli articoli.." aria-label="Cerca">
        <button class="btn btn-outline-success" type="submit">Cerca</button>
      </form>
    </div>
  </div>
</nav>

<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
<script src="offcanvas-navbar.js"></script>
