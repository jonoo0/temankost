@extends('layout.master')

@section('title')
    Tambah Kost
@endsection
@push('css')
    <style>
        /* .error {
                        color: red;
                        font-weight: 400px;
                    } */

        .ck-editor__editable {
            min-height: 200px;
        }



        .error {
            color: #fff;
            font-size: 12px;
            width: unset;
        }

        .errorTxt {
            /* min-height: 20px; */
            background-color: #f39c12 !important;
            margin-bottom: 10px;
        }

        .error2 {
            padding-left: 20px;
            padding-top: 6px;
            padding-bottom: 6px;
            color: #fff
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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('image-uploader-master/dist/image-uploader.min.css') }}">
    <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
@endpush
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-8">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Tambah Kost</h3>
                            </div>
                            <form role="form" action="{{ route('kost.store') }}" name="form" id="form"
                                method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="errr">
                                        <div class="errorTxt"></div>
                                    </div>
                                    @if (Auth::user()->role == 'Admin')
                                    <div class="form-group">
                                        <label style="color: #6c757d">Pemilik Kost</label>
                                        <select class="select2-selection select2-selection--single" id="pemilik_id"
                                            style="width: 100%" name="pemilik_id">
                                            <option value="">Pilih Pemilik</option>
                                            @foreach ($user as $b)
                                                <option value={{ $b->id_pemilik }}>{{ $b->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @endif
                                    @if (Auth::user()->role == 'Pemilik')
                                    @php
                                        $pemilik = App\Models\Pemilik::where('user_id', Auth::user()->id)->first();
                                    @endphp
                                    <div class="form-group" style="display:none">
                                        <label style="color: #6c757d">Pemilik Kost</label>
                                        <input type="text" class="form-control" id="pemilik_id" value="{{$pemilik->id}}" name="pemilik_id" readonly>
                                    </div>
                                    @endif
                                    <div class="form-group">
                                        <label style="color: #6c757d">Nama Kost</label>
                                        <input type="text" class="form-control" id="nama_kost" name="nama_kost">
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label style="color: #6c757d">Jenis</label>
                                            <select class="select2-selection select2-selection--single" id="jenis_kost_id"
                                                style="width: 100%" name="jenis_kost_id">
                                                <option value="">Pilih Jenis</option>
                                                @foreach ($jenis as $b)
                                                    <option value={{ $b->id }}>{{ $b->jenis }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group  col-md-6">
                                            <label style="color: #6c757d">Jumlah Kamar</label>
                                            <input type="text" class="form-control" id="jumlah_kamar"
                                                name="jumlah_kamar">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label style="color: #6c757d">Luas</label>
                                            <input type="text" class="form-control" id="luas" name="luas">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label style="color: #6c757d">Tarif Perbulan</label>
                                            <input type="text" class="form-control" id="tarif_perbulan"
                                                name="tarif_perbulan">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label style="color: #6c757d">Fasilitas Kost</label>
                                        <textarea class="form-control" id="fasilitas_kost" placeholder="Masukkan fasilitas" name="fasilitas_kost"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label style="color: #6c757d">Keterangan</label>
                                        <textarea class="form-control" id="keterangan" placeholder="Masukkan keterangan kost" name="keterangan"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label style="color: #6c757d">Koordinat</label>
                                        <input type="text" class="form-control" id="lokasi" name="lokasi">
                                    </div>

                                    <div class="form-group">
                                        <label style="color: #6c757d">Gambar</label>
                                        <div class="input-images">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
    @endsection
    @push('js')
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
        <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="{{ asset('image-uploader-master/dist/image-uploader.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script>
            $(document).ready(function() {
                $('.select2-selection').select2({

                });
            });
            ClassicEditor
                .create(document.querySelector('#keterangan'))
                .then(editor => {
                    editor.ui.view.editable.element.style.height = '200px';
                })
                .catch(error => {
                    console.error(error);
                });
            ClassicEditor
                .create(document.querySelector('#fasilitas_kost'))
                .then(editor => {
                    editor.ui.view.editable.element.style.height = '200px';
                })
                .catch(error => {
                    console.error(error);
                });
            $('.input-images').imageUploader({
                extensions: [".jpg", ".jpeg", ".png", ".gif", ".svg"],
                imagesInputName: "file"
            });
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
                });
            });
            jQuery(function($) {
                var validator = $('#form').validate({
                    rules: {
                        nama_kost: {
                            required: true
                        },
                        jenis_kost_id: {
                            required: true
                        },
                        Koordinat: {
                            required: true
                        },
                        tarif_perbulan: {
                            required: true
                        },
                        jumlah_kamar: {
                            required: true
                        },
                    },
                    messages: {
                        nama_kost: {
                            required: "Nama Barang Wajib Diisi*",
                        },
                        jenis_kost_id: {
                            required: "Rak Barang Wajib Diisi*",
                        },
                        Koordinat: {
                            required: "Kategori Barang Wajib Diisi*",
                        },
                        tarif_perbulan: {
                            required: "Harga Barang Wajib Diisi*",
                        },
                        jumlah_kamar: {
                            required: "Stok Barang Wajib Diisi*",
                        },

                    },
                    errorElement: 'div',
                    errorLabelContainer: '.errorTxt',
                    errorClass: 'error2',

                    highlight: function(element, errorClass) {
                        $(element).parents("div.errorTxt").addClass(errorClass)
                    },
                });
            });
        </script>
    @endpush
