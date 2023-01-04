@extends("templating")

@section("title", "Data Pertanyaan")

@section("css")

    <style>
        span .teks-span {
            color: red;
            font-size: 12px;
        }
    </style>

@endsection

@section("content")

<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">
            Pertanyaan
        </h4>
        <ul class="breadcrumbs">
            <li class="nav-home">
                <a href="{{ url('/admin/dashboard') }}">
                    <i class="flaticon-home"></i> Dashboard
                </a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i> Daftar Pertanyaan
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <button type="button" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#exampleModal">
                        <i class="fa fa-plus"></i> Tambah
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover" >
                            <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th>Pertanyaan</th>
                                    <th class="text-center">Bobot</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 0
                                @endphp
                                @foreach ($pertanyaan as $item)
                                    <tr>
                                        <td class="text-center">{{ ++$no }}.</td>
                                        <td>{{ $item->teks_pertanyaan }}</td>
                                        <td class="text-center">{{ $item->bobot }}</td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModalEdit-{{ $item->id }}">
                                                <i class="fa fa-edit"></i> Edit
                                            </button>
                                            <form action="{{ url('/admin/master/pertanyaan/' . $item->id) }}" method="POST" style="display: inline">
                                                @method("DELETE")
                                                @csrf
                                                <button onclick="return confirm('Yakin Mau di Hapus?')" type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fa fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tambah Data -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Tambah Data
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ url('/admin/master/pertanyaan/') }}" id="form-tambah-pertanyaan">
                @csrf <!-- Fungsi Pengamanan -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="teks_pertanyaan"> Pertanyaan </label>
                        <input type="text" class="form-control" name="teks_pertanyaan" id="teks_pertanyaan" placeholder="Masukkan Teks Pertanyaan">
                    </div>
                    <div class="form-group">
                        <label for="bobot"> Bobot </label>
                        <input type="number" class="form-control" name="bobot" id="bobot" placeholder="0" min="1" max="100">
                    </div>
                </div>
                <div class="modal-footer">
                    @include("komponen.button.btn_tambah")
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END -->

<!-- Edit Data -->
@foreach ($pertanyaan as $item)
<div class="modal fade" id="exampleModalEdit-{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Edit Data
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ url('/admin/master/pertanyaan/'.$item->id) }}" id="form-update-pertanyaan">
                @method("PUT")
                @csrf <!-- Fungsi Pengamanan -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="teks_pertanyaan"> Pertanyaan </label>
                        <input type="text" class="form-control" name="teks_pertanyaan" id="teks_pertanyaan" placeholder="Masukkan Teks Pertanyaan" value="{{ $item->teks_pertanyaan }}">
                    </div>
                    <div class="form-group">
                        <label for="bobot"> Bobot </label>
                        <input type="number" class="form-control" name="bobot" id="bobot" placeholder="0" min="1" max="100" value="{{ $item->bobot }}">
                    </div>
                </div>
                <div class="modal-footer">
                    @include("komponen.button.btn_edit")
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
<!-- END -->

@endsection

@section("js")

<script src="{{ url('') }}/assets/js/plugin/datatables/datatables.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

<script>
    $(document).ready(function() {
        $('#basic-datatables').DataTable({});
    });

    $("#form-tambah-pertanyaan").validate({
        rules: {
            teks_pertanyaan: "required",
            bobot:
            {
                required: true,
                min: 10,
                max: 100
            }
        },
        messages: {
            teks_pertanyaan: "<span class='teks-span'> Kolom Pertanyaan Tidak Boleh Kosong </span>",
            bobot:
            {
                required: "<span class='teks-span'> Kolom Bobot Tidak Boleh Kosong </span>",
                min: "<span class='teks-span'> Kolom Bobot Minimal Harus Bernilai 10 </span>",
                max: "<span class='teks-span'> Kolom Bobot Maximal Harus Bernilai 100 </span>"
            }
        },
        errorElement: "span"
    });

    $("#form-update-pertanyaan").validate({
        rules: {
            teks_pertanyaan: "required",
            bobot:
            {
                required: true,
                min: 10,
                max: 100
            }
        },
        messages: {
            teks_pertanyaan: "<span class='teks-span'> Kolom Pertanyaan Tidak Boleh Kosong </span>",
            bobot:
            {
                required: "<span class='teks-span'> Kolom Bobot Tidak Boleh Kosong </span>",
                min: "<span class='teks-span'> Kolom Bobot Minimal Harus Bernilai 10 </span>",
                max: "<span class='teks-span'> Kolom Bobot Maximal Harus Bernilai 100 </span>"
            }
        },
        errorElement: "span"
    });

</script>

@endsection
