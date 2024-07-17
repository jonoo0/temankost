@extends('layout.master')

@section('title')
    Kost
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
                                <h3 class="card-title">Data Kost</h3>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-sm float-right"
                                        onclick="window.location='{{ url('kost/create') }}'" type="button">
                                        <i class="fas fa-plus"></i> Tambah
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr style="text-align: center">
                                            <th style="width: 20px">No</th>
                                            <th>Nama Kost</th>
                                            <th>Kamar Tersedia</th>
                                            <th>Jenis Kost</th>
                                            <th>Luas</th>
                                            <th>Tarif Bulanan</th>
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
                                                <td>{{ $dt->nama_kost}}</td>
                                                {{-- <td style="cursor: pointer;" data-id="{{ $dt->id }}"
                                                    data-kode_barang="{{ $dt->kode_barang }}" id="barcode_tampil">
                                                    {{ $dt->kode_barang }}</td> --}}
                                                <td>{{ $dt->jumlah_kamar > 0 ? $dt->jumlah_kamar : 'penuh' }}</td>
                                                <td>{{ $dt->jenis->jenis }}</td>
                                                <td>{{ $dt->luas }}</td>
                                                <td>@currency($dt->tarif_perbulan)</td>
                                                <td style="text-align: center"> <a href="#"
                                                        class="nav-link has-dropdown" data-toggle="dropdown"><i
                                                            class="fa fa-ellipsis-h " style="color: #777778"></i></a>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="nav-link" id="edit-data"
                                                                href="{{ route('kost.edit', $dt->id) }}">Edit</a></li>

                                                        <li> <a href="#" id="delete-data" data-id={{ $dt->id }}
                                                                data-nama_kost={{ $dt->nama_kost }} class="nav-link"
                                                                data-toggle="modal" data-target="#deleteModal">Delete</a>
                                                        </li>
                                                        </a></li>
                                                        <li><a class="nav-link"
                                                                href="{{ route('kost.detail', $dt->id) }}">Detail</a>
                                                        </li>
                                                        <li><a class="nav-link"
                                                                href="{{ route('kost.detail-penghuni', $dt->id) }}">Informasi Penghuni Kost</a>
                                                        </li>
                                                    </ul>
                                                </td>
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
