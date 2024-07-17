<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Register</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<style>
    .login_img {
        width: 250px;
        margin-top: 40px
    }
    .hide {
  display: none;
}
</style>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <div class="col-12" style="text-align: center">
                    <h4>Register</h4>
                </div>
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <form method="POST" action="{{ route('register.store') }}" method="POST" class="needs-validation"
                    novalidate="">
                    @csrf
                    @if (Session::has('error'))
                        <div class="alert alert-warning alert-dismissible fade show pesan_alert" role="alert">
                            {{ Session::get('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-warning alert-dismissible fade show pesan_alert" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Nama" name="name">
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email">
                    </div>

                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Alamat" name="alamat">
                    </div>
                    <div class="input-group mb-3">
                        <input type="number" class="form-control" placeholder="No Tlp" name="no_tlp">
                    </div>

                    <div class="input-group mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="role" id="role" value="Pemilik" onclick="show2()">
                            <label class="form-check-label" style="margin-right: 20px " for="exampleRadios1">
                             Pemilik Kost
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="role" id="" value="Penghuni" onclick="show1()">
                            <label class="form-check-label" for="" >
                              Penghuni
                            </label>
                          </div>
                    </div>

                    <div class="input-group mb-3 hide" id="div1">
                        <input type="text" class="form-control" placeholder="rekening" name="rekening">
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password">

                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Re Password" name="re-password">
                    </div>

                    <div class="row" style="margin-bottom:40px ">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </div>
                    </div>
                    <div class="col-12" style="text-align: center">
                        <p>Sudah Punya akun ? <a href="/login">Login</a></p>
                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
<script>
    function show1(){
  document.getElementById('div1').style.display ='none';
}
function show2(){
  document.getElementById('div1').style.display = 'block';
}
</script>
</body>

</html>
