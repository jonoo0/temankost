<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/')}}" class="brand-link">
      <img src="{{asset('dist/img/logo1.jpg')}}" alt="Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Rumaysho Store</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-header">Kelola Barang</li>
          <li class="nav-item">
            <a href="{{route('barang.index')}}" class="nav-link">
                <i class="fas fa-box-open"></i>
              <p>
                &nbsp;&nbsp; Barang
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('barangmasuk.index')}}" class="nav-link">
              <i class="fas fa-download"></i>
              <p>
                &nbsp;&nbsp; Barang Masuk
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('penjualan.index')}}" class="nav-link">
                <i class="fas fa-shopping-cart"></i>
              <p>
                &nbsp;&nbsp; Transaksi
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('kategori.index')}}" class="nav-link">
                <i class="fas fa-list"></i>
              <p>
                &nbsp;&nbsp; Kategori Barang
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('rak.index')}}" class="nav-link">
                <i class="fas fa-table"></i>
              <p>
                &nbsp;&nbsp; Rak Barang
              </p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
