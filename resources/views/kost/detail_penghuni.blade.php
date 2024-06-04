@extends('layout.master')

@section('title')
    Detail Penghuni
@endsection
@push('css')
    <style>
        .error {
            color: red;
            font-weight: 400px;
        }
    </style>
    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@endpush
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Detai Penghuni {{$data->first()->nama_kost ?? ''}}</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr style="text-align: center">
                                            <th style="width: 20px">No</th>
                                            <th>Kode Transaksi</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>No Tlp</th>
                                            <th>Tgl Mulai - Tgl Selesai</th>
                                            <th>Sisa Waktu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $x = 1;
                                        @endphp
                                        @foreach ($data as $dt)
                                            <tr>
                                                <td>{{ $x++ }}</td>
                                                <td>{{ $dt->kode_trx}}</td>
                                                <td>{{ $dt->name }}</td>
                                                <td>{{ $dt->email }}</td>
                                                <td>{{ $dt->no_tlp }}</td>
                                                <td>{{ tgls($dt->tgl_mulai) }} - {{tgls($dt->tgl_selesai)}}</td>
                                                @php

                                                    $a = $dt->tgl_mulai;
                                                    $b = $dt->tgl_selesai;
                                                    $c = Carbon\Carbon::now();

                                                    $awl = new DateTime($c);
                                                    $now = new DateTime($b);
                                                    $diff = $now->diff($awl);
                                                @endphp
                                                <td>
                                                    @if ($c >= $a)
                                                    {{$diff->y}} Tahun, {{$diff->m}} Bulan, {{$diff->d}} Hari
                                                    @elseif($b < $c)
                                                    Waktu Habis
                                                    @else
                                                    Belum Mulai Kost
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
        <div class="modal fade" id="barcodeTampil" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
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
                            <img src="" style="width:400px;" class="center" id="show-barcode">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if ($data->count() > 0)
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="Delete"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 style="font-size: 20px" class="modal-title" id="exampleModalCenterTitle"><i
                                    class="fas fa-info-circle"></i><span></span> Konformasi Hapus!</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('kost.delete') }}" method="post">
                                @csrf
                                <input type="hidden" name="id" id="id">
                                <p> Apakah Anda yakin ingin menghapus data ?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" style="width: 50px" class="btn btn-secondary">Ya</button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
                        </div>
                        </form>
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
    <script>
        $(document).ready(function() {
            $("input[data-type='number']").keyup(function(event) {
                // skip for arrow keys
                if (event.which >= 37 && event.which <= 40) {
                    event.preventDefault();
                }
                var $this = $(this);
                var num = $this.val().replace(/,/gi, "");
                var num2 = num.split(/(?=(?:\d{3})+$)/).join(",");
                console.log(num2);
                // the following line has been simplified. Revision history contains original.
                //   $this.val(num2);
            });
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
        // $(document).on("click", "#barcode_tampil", function() {
        //     $('#barcodeTampil').modal('show');
        //     let kode_barang = $(this).data('kode_barang');
        //     let id = $(this).data('id');
        //     $("#show-barcode").attr("src", "/storage/" + kode_barang + ".png");
        //     $("#show-id").val(id);
        // });
        $(document).on('click', '#delete-data', function() {
            let id = $(this).attr('data-id');
            let nama_barang = $(this).attr('data-nama_barang');
            $('#id').val(id);
            $('#delete-nama').html(nama_barang);

        });
    </script>
@endpush
