<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ config('app.name') }}</title>
  <link rel="stylesheet" href="{{ asset('js/lib/bootstrap/dist/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>

<body>
  @include('/shared/modal/user')
  <header>
    <nav class="navbar navbar-expand-sm navbar-toggleable-sm navbar-light bg-warning">
      <div class="container">
        <a asp-area="" asp-controller="Home" asp-action="Index">
          <div class="brand"></div>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target=".navbar-collapse"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse d-sm-inline-flex justify-content-end">
          <ul class="navbar-nav gap-3 mx-3">
            <li class="nav-item">
              <a class="nav-link text-dark" href="/">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-dark" href="/">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-dark" href="/">Ranking</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-dark" href="/">Contact</a>
            </li>
          </ul>
          <button id="signinup" class="btn btn-outline-dark rounded-0 px-4">SIGN IN/UP</button>
        </div>
      </div>
    </nav>
  </header>
  <div class="container">
    <main role="main" class="py-5">
      <section id="intro">
        <h1 class="text-center fw-bold">
          The Best Way to <br />
          Track Your Stock Portfolio
        </h1>
        <div id="cover"></div>
      </section>
      <section id="start" class="position-relative">
        <div id="cover"></div>
        <div class="highlight position-absolute text-center">
          Add your first transactions now and<br />
          Start using the easiest way to<br />
          Track your portfolio<br />
          <button id="start-now" type="button" class="btn btn-warning btn-lg text-light fs-4 rounded-0 px-5">Start
            Now</button>
        </div>
      </section>
    </main>
  </div>
  <footer class="footer bg-warning">
    <div class="container">
      <div class="d-flex flex-row">
        <div class="col">
          <div class="brand"></div>
          <div class="slogan text-secondary">
            INVETKER offers easy stock tracking, clear charts, daily rankings, and a beginner-friendly interface.
          </div>
        </div>
        <div class="col text-light fs-6">
          <div class="title fw-bold">Get Started</div>
          <ul class="list-unstyled">
            <li class="mt-2"><a href="#">Home</a></li>
            <li class="mt-2"><a href="#">About</a></li>
            <li class="mt-2"><a href="#">Ranking</a></li>
          </ul>
        </div>
        <div class="col text-light fs-6">
          <div class="title fw-bold">Resources</div>
          <ul class="list-unstyled">
            <li class="mt-2"><a href="#">Contact</a></li>
            <li class="mt-2"><a href="#">Privacy Policy</a></li>
          </ul>
        </div>
      </div>
      <div class="text-light my-4">
        <hr>
      </div>
      <div class="text-light text-center">
        &copy; 2024 INVETKER, All right reserved.
      </div>
    </div>
  </footer>
  <script src="{{ asset('js/lib/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('js/lib/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script type="module" src="{{ asset('js/home.js') }}"></script>
</body>

</html>
