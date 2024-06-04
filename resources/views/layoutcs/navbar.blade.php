<nav class="navbar navbar-expand-lg bg-white navbar-light shadow-sm py-3 py-lg-0 px-3 px-lg-0">
    <a href="/" class="navbar-brand ms-lg-5">
        <h1 class="m-0 text-uppercase text-dark"><i class="bi bi-shop fs-1 text-primary me-3"></i>TEMAN KOST</h1>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto py-0">
            <a href="{{url('/')}}" class="nav-item nav-link  {{ uriaktif() }}">Home</a>
            <a href="{{url('cs/kost')}}" class="nav-item nav-link  {{ uriaktif('cs') }}">Cari KOst</a>
            @if (Auth::check() == true)
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle  {{ uriaktif('akun') }} "  data-bs-toggle="dropdown">Info Akun & Kost</a>
                <div class="dropdown-menu m-0">
                    <a href="{{url('/akun/pesanan')}}" class="dropdown-item">Kost Anda</a>
                    <a href="{{url('/profile')}}" class="dropdown-item">Ubah Password</a>
                </div>
            </div>
            <a href="{{url('/logout')}}" class="nav-item nav-link nav-contact bg-success text-white px-5 ms-lg-5">Logout<i class="bi bi-arrow-right"></i></a>
            @else
            <a href="{{url('/login')}}" class="nav-item nav-link nav-contact bg-primary text-white px-5 ms-lg-5">Masuk / Daftar <i class="bi bi-arrow-right"></i></a>
            @endif
        </div>
    </div>
</nav>
