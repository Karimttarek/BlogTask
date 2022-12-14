  <!-- Navbar -->
  <nav class="navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      @if (Auth::check() && Auth::user()->is_admin == 1)
        <li class="nav-item">
            <a href="/admin" class="nav-link">Admin panel</a>
        </li>
      @endif
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/blog" class="nav-link">Blog</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        {{-- <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a> --}}
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Messages Dropdown Menu -->
      <li class="nav-item">
        @if (empty(Auth::user()))
          <a class="nav-link dropdown-item" href="{{route('loginView')}}">Login</a>
        @endif
        @if (!empty(Auth::user()))
        <a class="nav-link dropdown-item" href="{{ route('logout') }}"
        onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <p>logout</p>
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
          </form>
        </li>
        @endif
    </ul>
  </nav>
  <hr>
  <!-- /.navbar -->
