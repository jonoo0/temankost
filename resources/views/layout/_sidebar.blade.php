<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link">
        <img src="https://static.vecteezy.com/system/resources/thumbnails/010/858/067/small/modern-letter-t-k-elegant-abstract-logo-free-vector.jpg" alt="Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Teman Kost</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-header">Kelola Kost</li>
          <li class="nav-item">
            <a href="{{route('kost.index')}}" class="nav-link">
                <i class="fas fa-box-open"></i>
              <p>
                &nbsp;&nbsp; Kost
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('jenis.index')}}" class="nav-link">
              <i class="fas fa-download"></i>
              <p>
                &nbsp;&nbsp; Jenis
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('pesanan.index')}}" class="nav-link">
              <i class="fas fa-download"></i>
              <p>
                &nbsp;&nbsp; Pesanan
              </p>
            </a>
          </li>

          <li class="nav-header">Kelola User</li>
          <li class="nav-item">
            <a href="{{route('pemilik.index')}}" class="nav-link">
                <i class="fas fa-box-open"></i>
              <p>
                &nbsp;&nbsp; Pemilik
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('penghuni.index')}}" class="nav-link">
              <i class="fas fa-download"></i>
              <p>
                &nbsp;&nbsp; Penyewa
              </p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
