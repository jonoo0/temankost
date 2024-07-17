<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="{{ asset('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700') }}"
        rel="stylesheet">

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
    @stack('css')
    <style>
        .error {
            color: #fff;
            font-size: 12px;
            width: unset;
        }

        .errorTxt {
            /* min-height: 20px; */
            background-color: #f39c12 !important;
            margin-bottom: 10px;
        }

        .error2 {
            padding-left: 20px;
            padding-top: 6px;
            padding-bottom: 6px;
            color: #fff
        }
    </style>
</head>

<body class="sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed sidebar-collapse sidebar-closed">
    <div class="wrapper">
        <!-- Navbar -->
        @include('layout.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @if (Auth::user()->role == 'Admin')
        @include('layout._sidebar')
        @endif

        @if (Auth::user()->role == 'Pemilik')
        @include('layout.sidebar-pemilik')
        @endif


        <!-- Main Sidebar Container -->

        <!-- Content Wrapper. Contains page content -->
        @yield('content')
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        @include('layout.footer')
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"
        integrity="sha512-Tn2m0TIpgVyTzzvmxLNuqbSJH3JP8jm+Cy3hvHrW7ndTDcJ1w5mBiksqDBb8GpE2ksktFvDB/ykZ0mDpsZj20w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- OPTIONAL SCRIPTS -->
    <script src="{{ asset('dist/js/demo.js') }}"></script>

    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="{{ asset('plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
    <script src="{{ asset('plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>

    <!-- PAGE SCRIPTS -->
    <script src="{{ asset('dist/js/custom.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>

    <script>
        @if(Session::has('m'))
        var type = "{{ Session::get('t', 'info') }}";
        switch(type){
            case 'info':
                toastr.info("{{ Session::get('m') }}");
                break;

            case 'warning':
                toastr.warning("{{ Session::get('m') }}");
                break;

            case 'success':
                toastr.success("{{ Session::get('m') }}");
                break;

            case 'error':
                toastr.error("{{ Session::get('m') }}");
                break;
        }
      @endif
      $.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
  });

  @if(Auth::user()->role == 'Pemilik')
      $.post("{{route('notif')}}", function (e, textStatus, jqXHR) {
        if(!e.status) return;

        $('#notif-2').html(`
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="far fa-bell text-primary"></i>
              <span class="badge badge-primary navbar-badge "><b>${e.jumlah}</b></span>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">Menunggu Persetujuan</span>
                <div class="dropdown-divider"></div>

                ${
                e.data.task ? `
                <a href="/pesanan?konfirmasi=menunggu" class="dropdown-item">
                  <i class="fas fa-angle-right mr-2"></i> Pesanan Perlu di konfirmasi <span class="float-right text-sm">${e.data.task}</span>
                </a>
                `: ''
              }
              </div>
          </li>
        `);

      },"json" )
      @endif
      @if(Auth::user()->role == 'Admin')
      $.post("{{route('notif.admin')}}", function (e, textStatus, jqXHR) {
        if(!e.status) return;

        $('#notif-admin').html(`
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="far fa-bell text-primary"></i>
              <span class="badge badge-primary navbar-badge "><b>${e.jumlah}</b></span>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">Menunggu Persetujuan</span>
                <div class="dropdown-divider"></div>
                ${
                e.data.count ? `
                <a href="/pemilik?konfirmasi=menunggu" class="dropdown-item">
                  <i class="fas fa-angle-right mr-2"></i> Pemilik Perlu di konfirmasi <span class="float-right text-sm">${e.data.count}</span>
                </a>
                `: ''
              }
              </div>
          </li>
        `);

      },"json" )
      @endif
    </script>
    @stack('js')
</body>

</html>
