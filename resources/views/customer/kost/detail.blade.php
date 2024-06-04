@extends('layoutcs.master')

@section('title')
    Kost | PAPIKOS
@endsection

@section('content')
    @php
        $gb = App\Models\Gambar::where('id_kost', $data->id);
    @endphp
    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row gx-5">
                <div class="col-lg-7">
                    <div class="border-start border-5 border-primary ps-5 mb-5">
                        <h6 class="text-primary text-uppercase">Detail</h6>
                        <h1 class="display-5 text-uppercase mb-0">{{ $data->nama_kost }}</h1>
                        <h6 class="text-primary text-uppercase">{{$data->jumlah_kamar}} Kamar Tersedia</span> </h6>
                    </div>
                    <div class="bg-light p-4">
                        <ul class="nav nav-pills justify-content-between mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item w-50" role="presentation">
                                <button class="nav-link text-uppercase w-100 active" id="pills-1-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-1" type="button" role="tab" aria-controls="pills-1"
                                    aria-selected="true">Fasilitas</button>
                            </li>
                            <li class="nav-item w-50" role="presentation">
                                <button class="nav-link text-uppercase w-100" id="pills-2-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-2" type="button" role="tab" aria-controls="pills-2"
                                    aria-selected="false">Keterangan Kost</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-1" role="tabpanel"
                                aria-labelledby="pills-1-tab">
                                <p class="mb-0">{!! $data->fasilitas_kost !!}</p>
                            </div>
                            <div class="tab-pane fade" id="pills-2" role="tabpanel" aria-labelledby="pills-2-tab">
                                <p class="mb-0">{!! $data->keterangan !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 mb-5 mb-lg-0" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100 rounded" src="{{ URL::to($gb->pluck('file')->first()) }}"
                            style="object-fit: cover;">
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- About End -->
    <!-- Team Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="border-start border-5 border-primary ps-5 mb-5" style="max-width: 600px;">
            </div>
            <div class="owl-carousel team-carousel position-relative" style="padding-right: 25px;">
                @foreach ($gb->get() as $val)
                    <div class="team-item">
                        <div class="position-relative overflow-hidden">
                            <img class="img-fluid w-100" style="width: 200px; height:200px;" src="{{ URL::to($val->file) }}" alt="">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Team End -->

    <div class="container-fluid pt-5">
        <div class="container">
            <div class="border-start border-5 border-primary ps-5 mb-5" style="max-width: 600px;">
                <h6 class="text-primary text-uppercase">Sebelum keduluan orang lain</h6>
                <h1 class="display-5 text-uppercase mb-0">Pesan Kosmu Disini</h1>
            </div>
            <div class="row g-5">
                <div class="col-lg-5">
                    <form role="form" action="{{ route('pesanan.store') }}" name="form" id="form" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <h3>@currency($data->tarif_perbulan)/ Bln </h3>
                            <p style="color:red"><span>{{ $data->jumlah_kamar < 1 ?  'Kamar Penuh sampai tanggal '.  tgl($dekat) : ''}}</span></p>

                            <div class="row">
                                <div class="col-6">
                                    <input type="hidden" name="id_kost" value="{{ $data->id }}">
                                    <label for="">Pilih Tanggal Masuk</label>
                                    <input type="text" class="form-control bg-light border-0 px-4" id="datee" name="tgl_mulai"
                                        style="height: 55px;" required>
                                </div>
                                <div class="col-6">
                                    <label for="exampleFormControlSelect1"></label>
                                    <select class="form-control bg-light border-0 px-4" name="jml_bulan"
                                        id="exampleFormControlSelect1" style="height: 55px;" required>
                                        <option value="1">1 Bulan</option>
                                        <option value="3">3 Bulan</option>
                                        <option value="6">6 Bulan</option>
                                        <option value="12">1 Tahun</option>
                                        <option value="24">2 Tahun</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="exampleFormControlSelect1"></label>
                                <select class="form-control bg-light border-0 px-4" name="via_bayar"
                                    id="via_bayar" style="height: 55px;" required>
                                    <option value="" selected>Pilih Methode Pembayaran </option>
                                    <option value="tf-manual">Tranfer Manual </option>
                                    <option value="midtrans">Pembayaran Otomatis</option>
                                </select>
                            </div>
                            <div class="col-12">
                                @if (Auth::check() == true )
                                <button class="btn btn-primary w-100 py-3" {{$data->jumlah_kamar < 1 ? 'disabled' : ''}}  type="submit">Ajukan Sewa</button>
                                @else
                                <button class="btn btn-primary w-100 py-3" type="button" onclick="window.location.href='/login'">Login dulu yuk</button>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-7">
                    <div class="bg-light mb-5 p-5">
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-geo-alt fs-1 text-primary me-3"></i>
                            <div class="text-start">
                                <h6 class="text-uppercase mb-1">Alamat</h6>
                                <span>{{ $pemilik->alamat }}</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-envelope-open fs-1 text-primary me-3"></i>
                            <div class="text-start">
                                <h6 class="text-uppercase mb-1">Email Us</h6>
                                <span>{{ $data->email }}</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-4">
                            <i class="bi bi-phone-vibrate fs-1 text-primary me-3"></i>
                            <div class="text-start">
                                <h6 class="text-uppercase mb-1">Call Us</h6>
                                <span>{{ $pemilik->no_tlp }}</span>
                            </div>
                        </div>
                        <div>

                            @php
                                $maps = 'https://maps.google.com/maps?q=' . $data->lokasi . '&z=15&output=embed';
                            @endphp
                            <iframe src="{{ $maps }}" width="100%" height="255" frameborder="0"
                                style="border:0"></iframe>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('js')
<script>
  $( function() {
    var date = new Date();

    $( "#datee" ).datepicker({
        format: "yyyy-mm-dd",
        startDate: date,
        endDate: "+3w",
    });
  } );
</script>

@endpush
