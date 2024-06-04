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
                        <h6 class="text-primary text-uppercase">Lanjutkan Proses Pembayaran</h6>
                    </div>
                    <div class="bg-light p-4">
                        <table>
                            <tbody>
                                <tr>
                                    <td>Kode Transaksi</td>
                                    <td>: {{ $data->kode_trx }}</td>
                                </tr>
                                <tr>
                                    <td>Nama Kost</td>
                                    <td>: {{ $data->kost->nama_kost }}</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>:  {{ $data->kost->pemilik->alamat }} </td>
                                </tr>
                                <tr>
                                    <td>Tgl Masuk</td>
                                    <td>: {{ tgl($data->tgl_mulai) }}</td>
                                </tr>
                                <tr>
                                    <td>Tgl Berakhir</td>
                                    <td>: {{ tgl($data->tgl_selesai) }} ( {{ $data->jml_bulan }}
                                        Bulan )</td>
                                </tr>
                                <tr>
                                    <td>Nominal Pembayaran</td>
                                    <td>: <b>@currency($data->nominal)</b></td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                        @if ($data->via_bayar == 'midtrans')
                            @if ($data->status == 'pending'|| $data->status == 'unpaid')
                                <button class="btn btn-primary w-100 py-3" id="pay-button">Bayar Sekarang</button>
                            @elseif($data->status == 'expire')
                                <p><b> Maaf pesanan anda telah kadaluarsa</b></p>
                            @elseif('paid')
                                <p><b>Transaksi Berhasil</b> </p>
                            @endif
                        @endif

                        @if ($data->via_bayar == 'tf-manual')
                            @if ($data->status == 'menunggu')
                                <p><b>Pembayaran transfer manual telah anda lakukan dan
                                        tunggu proses persetujuan oleh pemilik kost</b></p>
                            @endif
                            @if ($data->status == 'paid')
                                <p><b>Pembayaran transfer manual telah anda lakukan dan
                                        telah dikonfirmasi oleh pemilik kost</b></p>
                            @endif
                            @if ($data->status == 'unpaid')
                                <p><b>Lakukan Tranfer ke Rekening : {{ $data->kost->pemilik->no_rek }}  dengan nominal {{ $data->nominal }}
                                        dan
                                        tunggu proses persetujuan oleh pemilik kost</b></p>
                                <form action="{{ route('pembayaran.update', $data->id) }}" name="form" id="form"
                                    method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUt')
                                    <div class="form-group">
                                        <label style="color: #6c757d" for="nama">Bukti Tranfer</label>
                                        <input type="file" class="form-control" id="file" name="file" required>
                                    </div>

                                    <button style="margin-top: 20px;" class="btn btn-primary w-100 py-3"
                                        type="submit">Upload</button>
                                </form>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>

    <script type="text/javascript">
        // For example trigger on button clicked, or any time you need
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function() {
            // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    /* You may add your own implementation here */
                    alert("payment success!");
                    console.log(result);
                },
                onPending: function(result) {
                    /* You may add your own implementation here */
                    alert("wating your payment!");
                    console.log(result);
                },
                onError: function(result) {
                    /* You may add your own implementation here */
                    alert("payment failed!");
                    console.log(result);
                },
                onClose: function() {
                    /* You may add your own implementation here */
                    alert('you closed the popup without finishing the payment');
                }
            })
        });
    </script>
@endpush
