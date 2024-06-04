@extends('layout.master')

@section('title')
    Pesanan & Pembayaran
@endsection
@push('css')
    <style>
        .error {
            color: red;
            font-weight: 400px;
        }

        .select2-selection {
            height: 37px !important;

        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #007bff;
            border-color: #006fe6;
            color: #000;
            padding: 0 10px;
            margin-top: 0.31rem;
        }
    </style>
    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Data Pesanan & Pembayaran</h3>
                                {{-- <div class="form-group">
                                    <button class="btn btn-primary btn-sm float-right"
                                        onclick="window.location='{{ url('penghuni/create') }}'" type="button">
                                        <i class="fas fa-plus"></i> Tambah
                                    </button>
                                </div> --}}
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
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
                                        @foreach ($data as $dt)
                                            <tr>
                                                <td>{{ $x++ }}</td>
                                                <td>{{ $dt->kode_trx }}</td>
                                                <td>{{ $dt->nama_kost }}</td>


                                                @php
                                                    $wa = str_replace_first('0', '62', $dt->no_tlp);

                                                @endphp

                                        <td> {{ $dt->no_tlp }} </td>
                                                <td>{{ $dt->email }}</td>
                                                <td>{{ tgls($dt->tgl_mulai) }} - {{ tgls($dt->tgl_selesai) }}
                                                    ({{ $dt->jml_bulan }} bln)
                                                </td>

                                                <td>@currency($dt->nominal)</td>

                                                @if (!empty($dt->bukti_bayar) && $dt->via_bayar == 'tf-manual')
                                                    <td style="text-align: center">
                                                        <a href="#" id="nota_tampil" data-target="#notaTampil"
                                                            data-id="{{ $dt->id }}"
                                                            data-file="{{ $dt->bukti_bayar }}" class=" nav-link"
                                                            data-toggle="modal">
                                                            <u>{{ $dt->via_bayar }}</u>
                                                        </a>
                                                    </td>
                                                @else
                                                    <td>{{ $dt->via_bayar }}</td>
                                                @endif



                                                @if ($dt->via_bayar == 'tf-manual')
                                                    @if ($dt->bukti_bayar != null && $dt->status == 'menunggu')
                                                        <td>Menunggu</td>
                                                    @endif
                                                    @if ($dt->bukti_bayar == null && $dt->status == 'unpaid')
                                                        <td>Unpaid</td>
                                                    @endif
                                                    @if ($dt->bukti_bayar != null && $dt->status == 'paid')
                                                        <td>Paid</td>
                                                    @endif
                                                    @if ($dt->bukti_bayar != null && $dt->status == 'ditolak')
                                                        <td>{{ $dt->status }}</td>
                                                    @endif
                                                @else
                                                    <td>{{ $dt->status }}</td>
                                                @endif


                                                @if ($dt->via_bayar == 'tf-manual')
                                                    @if ($dt->bukti_bayar != null && $dt->status == 'menunggu')
                                                        <td style="text-align: center"> <a href="#"
                                                                class="nav-link has-dropdown" data-toggle="dropdown"><i
                                                                    class="fa fa-ellipsis-h "
                                                                    style="color: #777778"></i></a>
                                                            <ul class="dropdown-menu">
                                                                <li> <a href="#" id="konfirmasi-data"
                                                                        data-id={{ $dt->id }}
                                                                        data-id_kost={{ $dt->id_kost }}
                                                                        data-name={{ $dt->name }} class="nav-link"
                                                                        data-toggle="modal"
                                                                        data-target="#konfirmasiModal">Konfirmasi
                                                                        Pembayaran</a>
                                                                </li>
                                                                </a></li>
                                                            </ul>
                                                        </td>
                                                    @else
                                                        <td>
                                                            @if ($dt->status == 'paid')
                                                                <a
                                                                    href="{{ 'https://wa.me/' . $wa . '?text=Hallo ' . $dt->nama_penghuni . ' pesanan anda dengan kode transaksi ' . $dt->kode_trx . ' statusnya ' . $dt->status . ' Terimakasih sudah memesan. Jangan lupa checkin tepat waktu sesuai tanggal yang kamu tentukan ya. ' }}">
                                                                    Hubungi
                                                                </a>
                                                            @elseif($dt->status == 'ditolak')
                                                                <a
                                                                    href="{{ 'https://wa.me/' . $wa . '?text=Hallo ' . $dt->nama_penghuni . ' Mohon maaf pesanan anda dengan kode transaksi ' . $dt->kode_trx . ' statusnya ' . $dt->status . '' }}">
                                                                    Hubungi
                                                                </a>

                                                            @else
                                                            @endif
                                                        </td>
                                                    @endif
                                                @else
                                                    <td>
                                                        @if ($dt->status == 'paid' && $dt->via_bayar == 'midtrans')
                                                        <a
                                                            href="{{ 'https://wa.me/' . $wa . '?text=Hallo ' . $dt->nama_penghuni . ' pesanan anda dengan kode transaksi ' . $dt->kode_trx . ' statusnya ' . $dt->status . ' Terimakasih sudah memesan. Jangan lupa checkin tepat waktu sesuai tanggal yang kamu tentukan ya. ' }}">
                                                            Hubungi
                                                        </a>
                                                        @elseif($dt->status == 'pending' && $dt->via_bayar == 'midtrans')
                                                        <a
                                                            href="{{ 'https://wa.me/' . $wa . '?text=Hallo ' . $dt->nama_penghuni . ' Silahkan segera melakukan pembayaran pada kode transaksi ' . $dt->kode_trx . ' sebelum pesananmu kadaluarsa. Saat ini status pesanan anda ' . $dt->status . '' }}">
                                                            Hubungi
                                                        </a>
                                                        @endif
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        @if ($data->count() > 0)
            <div class="modal fade" id="konfirmasiModal" tabindex="-1" role="dialog" aria-labelledby="Delete"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 style="font-size: 20px" class="modal-title" id="exampleModalCenterTitle"><i
                                    class="fas fa-info-circle"></i><span></span> Konformasi Pembayaran!</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('pembayaran.konfirmasi') }}" method="post">
                                @csrf
                                <input type="hidden" name="id" id="id">
                                <input type="hidden" name="id_kost" id="id_kost">
                                <label style="color: #6c757d">Konfirmasi</label>
                                <select class="select2-selection select2-selection--single" id="status"
                                    style="width: 100%" name="status">
                                    <option selected>--Pilih--</option>
                                    <option value='paid'>Setujui</option>
                                    <option value='ditolak'>Tolak</option>

                                </select>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" style="width: 50px" class="btn btn-secondary">Ya</button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="notaTampil" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="col-md-12">
                                <img src="" style="width:400px;"
                                    onerror="this.src='https://assets.pikiran-rakyat.com/crop/0x0:0x0/x/photo/2021/09/20/2831361782.jpg'"
                                    alt="Stack Overflow logo and icons and such" class="center" id="show-nota">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).on("click", "#nota_tampil", function() {
            let file = $(this).data('file');
            let id = $(this).data('id');
            $("#show-nota").attr("src", "/nota/" + file);
            $("#show-id").val(id);
        });

        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
        $(document).ready(function() {
            $('#status').select2({

            });
        });
        $(document).on('click', '#konfirmasi-data', function() {
            let id = $(this).attr('data-id');
            let id_kost = $(this).attr('data-id_kost');
            let name = $(this).attr('data-name');
            $('#id').val(id);
            $('#id_kost').val(id_kost);
            $('#delete-name').html(name);

        });
    </script>
@endpush
