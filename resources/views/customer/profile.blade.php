@extends('layoutcs.master')

@section('title')
    Kost | PAPIKOS
@endsection

@section('content')
    <div class="container-fluid pt-5">
        <div class="container">
            <div class="border-start border-5 border-primary ps-5 mb-5" style="max-width: 600px;">
                <h1 class="display-5 text-uppercase mb-0">Ubah Password</h1>
            </div>
            <div class="row g-5">
                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show pesan_alert"
                    role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <div class="col-lg-5">
                    <form role="form" action="{{ route('ubahpwstore') }}" name="form" id="form" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row g-6">
                            <div class="col-12">
                                <label for="">Password Lama</label>
                                <input type="password" class="form-control bg-light border-0 px-4" id=""
                                    name="password_lama" style="height: 55px;" value="{{ old('password_lama') }}" required>
                            </div>
                            <div class="col-12">
                                <label for="">Password Baru</label>
                                <input type="password" class="form-control bg-light border-0 px-4" id=""
                                    name="password_baru" style="height: 55px;" value="{{ old('password_baru') }}" required>
                            </div>
                            <div class="col-12">
                                <label for="">Konfirmasi Password</label>
                                <input type="password" class="form-control bg-light border-0 px-4" id=""
                                    name="konfirmasi_password" style="height: 55px;" value="{{ old('konfirmasi_password') }}" required>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
