@extends('layoutcs.master')

@section('title')
    Kost | PAPIKOS
@endsection

@section('content')
    <!-- Services Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="border-start border-5 border-primary ps-5 mb-5" style="max-width: 600px;">
                <h6 class="text-primary text-uppercase">Pesananmu</h6>
                <h1 class="display-5 text-uppercase mb-0">Informasi Kost yang kamu Pesan</h1>
            </div>

            {{-- @dd($data); --}}

            <div class="row g-5">
                {{-- @dd($data) --}}
                @foreach ($data as $val)
                    @php
                        $wa = str_replace_first('0', '62', $val->kost->pemilik->no_tlp);
                    @endphp
                    <div class="col-md-6">
                        <div class="service-item bg-light d-flex p-4">
                            <div>
                                <h5 class="text-uppercase mb-3">{{ $val->nama_kost }}</h5>

                                <p>Pesanan <b>{{ $val->kode_trx }} </b></p>

                                @if ($val->bukti_bayar != null && $val->status == 'menunggu' && $val->via_bayar == 'tf-manual')
                                    <p>Mulai kost pada tanggal {{ tgl($val->mulai) }} - tanggal {{ tgl($val->tgl_selesai) }}
                                        dengan nominal Pembayaran sebesar @currency($val->nominal) status <b>Terbayar </b> Silahkan
                                        tunggu konfirmasi dari pemilik. <span><a
                                                href="{{ '/pesanan/pembayaran?idd=' . $val->id }}">Lihat Detail</a></span>
                                    </p>
                                @endif
                                @if ($val->bukti_bayar == null && $val->status == 'unpaid' && $val->via_bayar == 'tf-manual')
                                    <p>Mulai kost pada tanggal {{ tgl($val->mulai) }} - tanggal {{ tgl($val->tgl_selesai) }}
                                        dengan nominal Pembayaran sebesar @currency($val->nominal) status <b>Belum Terbayar </b>
                                        Silahkan lakukan proses pembayaran <span><a
                                                href="{{ '/pesanan/pembayaran?idd=' . $val->id }}">disini</a></span> </p>
                                @endif
                                @if ($val->bukti_bayar != null && $val->status == 'paid' && $val->via_bayar == 'tf-manual')
                                    <p>Mulai kost pada tanggal {{ tgl($val->mulai) }} - tanggal
                                        {{ tgl($val->tgl_selesai) }} dengan nominal Pembayaran sebesar @currency($val->nominal)
                                        status <b>Terbayar </b> Sudah dikonfirmasi dari pemilik kost <br> <span><a
                                                href="{{ '/pesanan/pembayaran?idd=' . $val->id }}">Lihat Detail</a></span>
                                        | <span> <a
                                                href="{{ 'https://wa.me/' . $wa . '?text=Hallo Admin ' . $val->nama_kost }}">
                                                Hubungi Pemilik
                                            </a></span> </p>
                                @endif
                                @if ($val->bukti_bayar != null && $val->status == 'ditolak' && $val->via_bayar == 'tf-manual')
                                    <p>Mulai kost pada tanggal {{ tgl($val->mulai) }} - tanggal
                                        {{ tgl($val->tgl_selesai) }} dengan nominal Pembayaran sebesar @currency($val->nominal)
                                        status <b>Ditolak </b> </p>
                                @endif

                                @if ($val->bukti_bayar == null && $val->status == 'unpaid' && $val->via_bayar == 'midtrans')
                                    <p>Mulai kost pada tanggal {{ tgl($val->mulai) }} - tanggal
                                        {{ tgl($val->tgl_selesai) }} dengan nominal Pembayaran sebesar @currency($val->nominal)
                                        status <b> Pending </b> Anda belum melakukan pembayaran untuk transaksi ini <br>
                                        <span><a
                                                href="{{ '/pesanan/pembayaran?idd=' . $val->id . '&snap=' . $val->snap_token }}">Bayar
                                                Sekarang</a></span>
                                    </p>
                                @endif
                                @if ($val->bukti_bayar == null && $val->status == 'failed' && $val->via_bayar == 'midtrans')
                                    <p>Mulai kost pada tanggal {{ tgl($val->mulai) }} - tanggal
                                        {{ tgl($val->tgl_selesai) }} dengan nominal Pembayaran sebesar @currency($val->nominal)
                                        status <b> Failed</b> </p>
                                @endif
                                @if ($val->bukti_bayar == null && $val->status == 'paid' && $val->via_bayar == 'midtrans')
                                    <p>Mulai kost pada tanggal {{ tgl($val->mulai) }} - tanggal
                                        {{ tgl($val->tgl_selesai) }} dengan nominal Pembayaran sebesar @currency($val->nominal)
                                        status <b> Sukses</b> Terkonfirmasi otomatis <br><span><a
                                                href="{{ '/pesanan/pembayaran?idd=' . $val->id . '&snap=' . $val->snap_token }}">Lihat
                                                Detail</a></span> 
                                        | <span> <a
                                                href="{{ 'https://wa.me/' . $wa . '?text=Hallo Admin ' . $val->nama_kost }}">
                                                Hubungi Pemilik
                                            </a></span> </p>
                                @endif

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Services End -->
@endsection
