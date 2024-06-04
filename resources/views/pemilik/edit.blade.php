@extends('layout.master')

@section('title')
    Edit Pemilik
@endsection
@push('css')
    <style>
        .ck-editor__editable {
            min-height: 200px;
        }

        .select2-selection {
            height: 37px !important;

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
                                <h3 class="card-title">Edit Pemilik</h3>
                            </div>
                            <form role="form" action="{{ route('pemilik.update', $data->id) }}" name="form" id="form"
                                method="post" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="card-body">
                                    <div class="errr">
                                        <div class="errorTxt"></div>
                                    </div>
                                    <div class="form-group">
                                        <label style="color: #6c757d">Nama</label>
                                        <input type="text" class="form-control" id="nama" name="nama" value="{{$data->user->name}}">
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group  col-md-6">
                                            <label style="color: #6c757d">No Tlp</label>
                                            <input type="text" class="form-control" id="no_tlp"
                                                name="no_tlp" value="{{$data->no_tlp}}">
                                        </div>
                                        <div class="form-group  col-md-6">
                                            <label style="color: #6c757d">No Rekening</label>
                                            <input type="number" class="form-control" id="no_rek"
                                                name="no_rek" value="{{$data->no_rek}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label style="color: #6c757d">Email</label>
                                        <input type="email" class="form-control" id="email"
                                            name="email" value="{{$data->user->email}}">
                                    </div>
                                    <div class="form-group">
                                        <label style="color: #6c757d">Alamat</label>
                                        <input type="text" class="form-control" id="alamat" name="alamat" value="{{$data->alamat}}">
                                    </div>
                                    <div class="form-group">
                                        <label style="color: #6c757d">Status</label>
                                        <select class="select2-selection select2-selection--single" id="status"
                                            style="width: 100%" name="status">
                                            <option value="menunggu" {{ $data->status == 'menunggu' ? 'selected' : '' }}>menunggu</option>
                                            <option value="aktif" {{ $data->status == 'aktif' ? 'selected' : '' }}>aktif</option>
                                            <option value="tidak aktif" {{ $data->status == 'tidak aktif' ? 'selected' : '' }}>tidak aktif</option>
                                        </select>
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
                $('#status').select2({

                });
            });
            jQuery(function($) {
                var validator = $('#form').validate({
                    rules: {
                        nama: {
                            required: true
                        },
                        no_rek: {
                            required: true
                        },
                        no_tlp: {
                            required: true
                        },
                        alamat: {
                            required: true
                        },
                    },
                    messages: {
                        nama: {
                            required: "Nama Wajib Diisi*",
                        },
                        no_rek: {
                            required: "No Rekening Wajib Diisi*",
                        },
                        no_tlp: {
                            required: "No Tlp Wajib Diisi*",
                        },
                        alamat: {
                            required: "Alamat Wajib Diisi*",
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
