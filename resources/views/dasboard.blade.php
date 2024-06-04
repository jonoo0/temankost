@extends('layout.master')

@section('title')
    Dashboard
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dashboard</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1">
                                <i class="fas fa-box-open"></i>
                        </span>

                        <div class="info-box-content">
                            <span class="info-box-text">Kost</span>
                            <span class="info-box-number">
                                {{$kost}}

                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1">
                                <i class="fas fa-box-open"></i>
                        </span>

                        <div class="info-box-content">
                            <span class="info-box-text">Jenis Kost</span>
                            <span class="info-box-number">
                                {{$jenis_kost}}
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1" style="background: aqua">
                          <i class="fas fa-shopping-cart"></i>
                        </span>

                        <div class="info-box-content">
                            <span class="info-box-text">Akun Penghuni</span>
                            <span class="info-box-number">
                                {{$penghuni}}
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"> <i class="fas fa-list"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Pemilik Terverifikasi</span>
                            <span class="info-box-number">
                                {{$pemilik}}
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <!-- /.col -->
            </div>


            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <div class="col-md-12">
                    <!-- MAP & BOX PANE -->

                    <!-- /.card -->

                    <!-- TABLE: LATEST ORDERS -->
                    <div class="card">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Transaksi Terbaru By Midtrans</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>

                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0">
                                    <thead>
                                        <tr>
                                            <th>Kode Transaksi</th>
                                            <th>Nama Penghuni</th>
                                            <th>No Tlp</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($trx->take(5) as $dt)
                                            <tr>
                                                <td><a
                                                        href="{{ url('pesanan?dtl='. $dt->id) }}">{{ $dt->kode_trx }}</a>
                                                </td>
                                                <td>{{$dt->nama_penghuni}}</td>
                                                <td>{{$dt->no_tlp}}</td>
                                                <td>{{$dt->status}}</td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            {{-- <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Place New Order</a> --}}
                            <a href="{{ url('pesanan') }}"
                                class="btn btn-sm btn-secondary float-right">Selengkapnya >></a>
                        </div>
                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->

                <div class="col-md-3">
                    <!-- Info Boxes Style 2 -->

                    <!-- PRODUCT LIST -->
                    {{-- <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Produk Terbaru</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>

                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <ul class="products-list product-list-in-card pl-2 pr-2">
                                @foreach ($brg->take(4) as $b)
                                    <li class="item">

                                        <div class="product-img">
                                            @if (App\Models\Gambar::where('id_barang', $b->id)->exists())
                                                @foreach ($b->gambar->take(1) as $fl)
                                                    <img src="{{ URL::to($fl->file) }}" alt="Product Image"
                                                        class="img-size-50">
                                                @endforeach
                                            @else
                                                <img src="{{ asset('dist/img/default.PNG') }}" alt="Product Image"
                                                    class="img-size-50">
                                            @endif
                                        </div>
                                        <div class="product-info">
                                            <a href="{{ route('barang.detail', $b->id) }}"
                                                class="product-title">{{ $b->nama_barang }}
                                                <span
                                                    class="badge badge-warning float-right">@currency($b->harga)</span></a>
                                            <span class="product-description">
                                                Kode Barang : {{ $b->kode_barang }}, Stok : {{ $b->stok }}
                                            </span>
                                        </div>
                                    </li>
                                @endforeach
                                <!-- /.item -->

                                <!-- /.item -->
                            </ul>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer text-center">
                            <a href="{{ route('barang.index') }}" class="uppercase">View All Products</a>
                        </div>
                        <!-- /.card-footer -->
                    </div> --}}
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
