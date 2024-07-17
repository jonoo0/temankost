@extends('layoutcs.master')

@section('title')
    Kost | PAPIKOS
@endsection

@section('content')
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row gx-5">
                <div class="col-lg-7">
                    <div class="border-start border-5 border-primary ps-5 mb-5">
                        <h6 class="text-primary text-uppercase">Detail Pesanan</h6>
                    </div>
                    <div class="bg-light p-4">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr style="text-align: center">
                                    <th style="width: 20px">No</th>
                                    <th>Kode Transaksi</th>
                                    <th>Nama Kost</th>
                                    <th>No Hp Penghuni</th>
                                    <th>Email Penghuni</th>
                                    <th>Tgl Mulai - Tgl Selesai</th>

                                    <th>Nominal</th>
                                    <th>Via Bayar</th>
                                    <th>Status</th>
                                    <th><i class="fas fa-cogs"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $x = 1;
                                @endphp
                                {{-- @foreach ($data as $dt)
                                    <tr>
                                        <td>{{ $x++ }}</td>
                                        <td>{{ $dt->kode_trx}}</td>
                                        <td>{{ $dt->nama_kost }}</td>
                                        <td>{{ $dt->no_tlp }}</td>
                                        <td>{{ $dt->email }}</td>
                                        <td>{{ tgls($dt->tgl_mulai) }} - {{tgls(strtotime($dt->tgl_mulai.' + 3 months'))}} ({{$dt->jml_bulan}} bln)</td>

                                        <td>@currency($dt->nominal)</td>

                                        @if (!empty($dt->bukti_bayar) && $dt->via_bayar== 'tf-manual')
                                        <td style="text-align: center">
                                            <a href="#" id="nota_tampil" data-target="#notaTampil"
                                                data-id="{{ $dt->id }}" data-file="{{ $dt->bukti_bayar }}"
                                                class=" nav-link" data-toggle="modal">
                                                <u>{{ $dt->via_bayar }}</u>
                                            </a>
                                        </td>
                                    @else
                                        <td>{{ $dt->via_bayar }}</td>
                                    @endif

                                        @if($dt->via_bayar == 'tf-manual')
                                        @if ($dt->bukti_bayar != null && $dt->status == 'unpaid')
                                        <td>Menunggu</td>
                                        @endif
                                        @if ($dt->bukti_bayar == null && $dt->status == 'unpaid')
                                        <td>Unpaid</td>
                                        @endif
                                        @if ($dt->bukti_bayar != null && $dt->status == 'paid')
                                        <td>Paid</td>
                                        @endif
                                        @if ($dt->bukti_bayar != null && $dt->status == 'ditolak')
                                        <td>{{$dt->status}}</td>
                                        @endif
                                        @else
                                        <td>{{$dt->status}}</td>
                                        @endif
                                        @if($dt->via_bayar == 'tf-manual')
                                        @if ($dt->bukti_bayar != null && $dt->status == 'unpaid')
                                        <td style="text-align: center"> <a href="#"
                                                class="nav-link has-dropdown" data-toggle="dropdown"><i
                                                    class="fa fa-ellipsis-h " style="color: #777778"></i></a>
                                            <ul class="dropdown-menu">
                                                <li> <a href="#" id="konfirmasi-data" data-id={{ $dt->id }}
                                                        data-name={{ $dt->name }} class="nav-link"
                                                        data-toggle="modal" data-target="#konfirmasiModal">Konfirmasi Pembayaran</a>
                                                </li>
                                                </a></li>
                                            </ul>
                                        </td>
                                        @else
                                        <td></td>
                                        @endif
                                        @else
                                        <td></td>

                                        @endif
                                    </tr>
                                @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
data-client-key="{{config('midtrans.client_key')}}"></script>

<script type="text/javascript">

    // For example trigger on button clicked, or any time you need
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
      // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
      window.snap.pay('{{$snapToken}}', {
        onSuccess: function(result){
          /* You may add your own implementation here */
          alert("payment success!"); console.log(result);
        },
        onPending: function(result){
          /* You may add your own implementation here */
          alert("wating your payment!"); console.log(result);
        },
        onError: function(result){
          /* You may add your own implementation here */
          alert("payment failed!"); console.log(result);
        },
        onClose: function(){
          /* You may add your own implementation here */
          alert('you closed the popup without finishing the payment');
        }
      })
    });
  </script>

@endpush
