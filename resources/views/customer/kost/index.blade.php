@extends('layoutcs.master')

@section('title')
    Kost | PAPIKOS
@endsection

@section('content')
    <div class="container py-5">
        <div class="row g-5">
            <!-- Blog list Start -->
            <div class="col-lg-8">
                @foreach ($data as $val)
                    @php
                        $gb = App\Models\Gambar::where('id_kost', $val->id)
                            ->pluck('file')
                            ->first();
                    @endphp
                    <div class="blog-item mb-5">
                        <div class="row g-0 bg-light overflow-hidden">
                            <div class="col-12 col-sm-5 h-100">
                                <img class="img-fluid h-100" src="{{ URL::to($gb) }}" style="object-fit: cover;">
                            </div>
                            <div class="col-12 col-sm-7 h-100 d-flex flex-column justify-content-center">
                                <div class="p-4">
                                    <div class="d-flex mb-3">
                                        <small class="me-3"><i
                                                class="bi bi-person-circle me-2"></i>{{ $val->jenis->jenis ?? '' }}</small>
                                        <small><i class="bi bi-check2-circle me-2"></i>{{ $val->jumlah_kamar }} Kamar
                                            Tersedia</small>
                                    </div>
                                    <h5 class="text-uppercase mb-3">{{ $val->nama_kost }}</h5>
                                    <p>{!! Str::limit($val->fasilitas_kost, 150) !!}</p>
                                    <br>
                                    <a class="text-primary text-uppercase" href="{{route('customer.kost-detail', $val->id)}}">Read More<i
                                            class="bi bi-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                {{$data->links()}}

            </div>
            <!-- Blog list End -->

            <!-- Sidebar Start -->
            <div class="col-lg-4">
                <!-- Search Form Start -->
                <div class="mb-5">
                    <div class="input-group">
                        <input type="text" class="form-control p-3" placeholder="Keyword">
                        <button class="btn btn-primary px-4"><i class="bi bi-search"></i></button>
                    </div>
                </div>
                <!-- Search Form End -->

                <!-- Category Start -->
                <div class="mb-5">
                    <h3 class="text-uppercase border-start border-5 border-primary ps-3 mb-4">Jenis Kost</h3>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="h5 bg-light py-2 px-3 mb-2" href="{{url('cs/kost')}}"><i class="bi bi-arrow-right me-2"></i>Tampilkan Semua</a>
                        @foreach ($jenis as $val)
                        <a class="h5 bg-light py-2 px-3 mb-2" href="{{url('cs/kost/?jenis='.$val->id)}}"><i class="bi bi-arrow-right me-2"></i>{{$val->jenis}}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- Sidebar End -->
        </div>

    </div>
@endsection
