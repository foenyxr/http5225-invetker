<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ config('app.name') }}</title>
  <link rel="stylesheet" href="{{ asset('js/lib/bootstrap/dist/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
  @hasSection('styles')
    @yield('styles')
  @endif
</head>

<body>
  <header class="fixed-top d-flex">
    <div class="brand"></div>
    <div class="d-flex flex-grow-1 justify-content-between">
      <button type="button" id="sidebar-toggle" class="btn btn-transparent rounded-0">
        <img src="{{ asset('images/icons/menu.svg') }}" />
      </button>
      <div class="d-flex align-items-center gap-3">
        <a title="Add Transaction" class="btn btn-outline-secondary d-none d-md-inline-flex align-items-center"
          href="/dashboard/transactions#add">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
            <path fill="currentColor" d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6z" />
          </svg>
          <span>Add Transactions</span>
        </a>
        <div class="dropdown h-100">
          <button class="btn btn-transparent h-100 px-3 rounded-0 d-flex gap-3 text-decoration-none align-items-center"
            type="button" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
            <div id="account" class="text-end d-none d-md-flex flex-column lh-sm">
              <div id="name" class="font-extrabold">Alexander, Johnson</div>
              <div id="role">Investor</div>
            </div>
            <img alt="Alexander, Johnson" class="rounded-circle"
              src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" />
          </button>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" title="Logout" href="user/logout">Logout</a></li>
          </ul>
        </div>
      </div>
    </div>
  </header>
  <aside class="fixed-top">
    <ul class="nav flex-column nav-pills">
      <li class="nav-item">
        <a class="nav-link d-flex align-items-center justify-content-center {{ request()->is('dashboard') ? 'active' : '' }}" href="/dashboard">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 32 32">
            <path fill="currentColor"
              d="M16.612 2.214a1.01 1.01 0 0 0-1.242 0L1 13.419l1.243 1.572L4 13.621V26a2.004 2.004 0 0 0 2 2h20a2.004 2.004 0 0 0 2-2V13.63L29.757 15L31 13.428ZM18 26h-4v-8h4Zm2 0v-8a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v8H6V12.062l10-7.79l10 7.8V26Z" />
          </svg>
          <span>Home</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link d-flex align-items-center justify-content-center {{ request()->is('dashboard/transactions') ? 'active' : '' }}" href="/dashboard/transactions">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 20 20">
            <path fill="currentColor"
              d="M12.146 3.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L14.293 7H4.5a.5.5 0 0 1 0-1h9.793l-2.147-2.146a.5.5 0 0 1 0-.708m-4.292 7a.5.5 0 0 1 0 .708L5.707 13H15.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 0 1 .708 0" />
          </svg>
          <span>Transcations</span>
        </a>
      </li>
    </ul>
  </aside>
  <main>
    @hasSection('content')
      @yield('content')
    @endif
  </main>
  <script src="{{ asset('js/lib/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('js/lib/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script type="module" src="{{ asset('js/portal.js') }}"></script>
  @hasSection('scripts')
    @yield('scripts')
  @endif
</body>

</html>
