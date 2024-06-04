@extends('layoutcs.master')

@section('title')
    Home | PAPIKOS
@endsection

@section('content')
<!-- Hero Start -->
<div class="container-fluid bg-primary py-5 mb-5 hero-header">
    <div class="container py-5">
        <div class="row justify-content-start">
            <div class="col-lg-8 text-center text-lg-start">
                <h1 class="display-1 text-uppercase text-dark mb-lg-4">TEMAN KOST</h1>
                <h1 class="text-uppercase text-white mb-lg-4">Temukan Kost Nyaman Disini</h1>
                <p class="fs-4 text-white mb-lg-4">Bisa langsung mengajukan sewa kos di website PapiKost.Transaksi lebih aman, tanpa takut kamarnya penuh keduluan orang lain. </p>
            </div>
        </div>
    </div>
</div>
<!-- Hero End -->

<!-- Blog Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="border-start border-5 border-primary ps-5 mb-5" style="max-width: 600px;">
            <h6 class="text-primary text-uppercase">Pilih Kosmu di sini</h6>
            <h1 class="display-5 text-uppercase mb-0">Temukan Yang paling nyaman</h1>
        </div>
        <div class="row g-5">
            @foreach ($data->take(4) as $val)
            @php
            $gb =  App\Models\Gambar::where('id_kost', $val->id)->pluck('file')->first();
            @endphp
            <div class="col-lg-6">
                <div class="blog-item">
                    <div class="row g-0 bg-light overflow-hidden">
                        <div class="col-12 col-sm-5 h-100">
                            <img class="img-fluid h-100" src="{{URL::to($gb)}}" style="object-fit: cover;">
                        </div>
                        <div class="col-12 col-sm-7 h-100 d-flex flex-column justify-content-center">
                            <div class="p-4">
                                <div class="d-flex mb-3">
                                    <small class="me-3"><i class="bi bi-person-circle me-2"></i>{{ $val->jenis->jenis ?? '' }}</small>
                                    <small><i class="bi bi-check2-circle me-2"></i>{{$val->jumlah_kamar}} Kamar Tersedia</small>
                                </div>
                                <h5 class="text-uppercase mb-3">{{$val->nama_kost}}</h5>
                                <p>{!!  Str::limit($val->fasilitas_kost, 150)!!}</p>
                                <a class="text-primary text-uppercase" href="{{route('customer.kost-detail', $val->id)}}">Read More<i class="bi bi-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <a href="{{url('/cs/kost')}}" class="btn btn-outline-light2 border-2 py-md-3 px-md-5 me-5" style="color: #95ba68">Lihat Seluruhnya</a>
        </div>
    </div>
</div>


@endsection
