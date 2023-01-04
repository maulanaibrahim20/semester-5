@extends("templating")

@section("title", "Data Pasien")

@section("css")

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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
            Pasien
        </h4>
        <ul class="breadcrumbs">
            <li class="nav-home">
                <a href="{{ url('/admin/dashboard') }}">
                    <i class="flaticon-home"></i> Dashboard
                </a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i> Daftar Akun
            </li>
        </ul>
    </div>

    <div class="row">

        @if (count($errors) > 0)
        <div class="col-md-12">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        @endif

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModalPasien">
                        <i class="fa fa-plus"></i> Pasien Sudah Terdata
                    </button>
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
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Nomor HP</th>
                                    <th class="text-center">Kelurahan</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0 ?>
                                @foreach ($pasien as $data)
                                <tr>
                                    <td class="text-center">{{ ++$no }}.</td>
                                    <td>{{ $data->getPasien->nama }}</td>
                                    <td>{{ $data->getPasien->email }}</td>
                                    <td>{{ $data->nomor_hp }}</td>
                                    <td class="text-center">{{ $data->getPasien->kelurahan }}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModalEdit-{{ $data->id }}">
                                            <i class="fa fa-edit"></i> Edit
                                        </button>
                                        <button id="deletePasien" data-kode="{{ $data->kode_pasien }}"
                                            class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i> Hapus
                                        </button>
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
<div class="modal fade" id="exampleModalPasien" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Tambah Data Pasien
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ url('/admin/akun/pasien/tambah-pasien') }}" id="form-tambah-pasien">
                @csrf <!-- Fungsi Pengamanan -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="kode_pasien"> Nama Pasien </label>
                                <select name="kode_pasien" class="form-control" id="kode_pasien" style="width: 100%">
                                    <option value="">- Pilih Pasien  -</option>
                                    @foreach ($pasien as $item)
                                    <option value="{{ $item->kode_pasien }}">
                                        <strong>NIK : </strong> {{ $item->no_ktp }} -
                                        <strong>Nama : </strong> {{ $item->getPasien->nama }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
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
            <form method="POST" action="{{ url('/admin/akun/pasien/') }}" id="form-tambah-pasien">
                @csrf <!-- Fungsi Pengamanan -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="no_ktp"> No. KTP </label>
                        <input type="text" class="form-control" name="no_ktp" id="no_ktp" placeholder="Masukkan No. KTP">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tanggal_lahir"> Tanggal Lahir </label>
                                <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pekerjaan"> Pekerjaan </label>
                                <input type="text" class="form-control" name="pekerjaan" id="pekerjaan">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama"> Nama </label>
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan Nama">
                    </div>
                    <div class="form-group">
                        <label for="email"> Email </label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Masukkan Email">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="umur"> Umur </label>
                                <input type="number" class="form-control" name="umur" id="umur" placeholder="0">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nomor_hp"> Nomor HP </label>
                                <input type="text" class="form-control" name="nomor_hp" id="nomor_hp" placeholder="0">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="kelurahan"> Kelurahan </label>
                        <select name="kelurahan" class="form-control" id="kelurahan">
                            <option value="">- Pilih -</option>
                            @foreach ($kecamatan as $item)
                            <option value="{{ $item["name"] }}">
                                {{ $item["name"] }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama_suami"> Nama Suami </label>
                        <input type="text" class="form-control" name="nama_suami" id="nama_suami" placeholder="Masukkan Nama Suami">
                    </div>
                    <div class="form-group">
                        <label for="alamat"> Alamat </label>
                        <textarea name="alamat" class="form-control" id="alamat" rows="5" placeholder="Masukkan Alamat"></textarea>
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
@foreach($pasien as $edit)
<div class="modal fade" id="exampleModalEdit-{{ $edit->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <form method="POST" action="{{ url('/admin/akun/pasien/'.$edit->user_id) }}" id="form-edit-pasien">
                @method("PUT")
                @csrf <!-- Fungsi Pengamanan -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="no_ktp"> No. KTP </label>
                        <input type="text" class="form-control" name="no_ktp" id="no_ktp" placeholder="Masukkan No. KTP" value="{{ $edit->no_ktp }}">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tanggal_lahir"> Tanggal Lahir </label>
                                <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" value="{{ $edit->tanggal_lahir }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pekerjaan"> Pekerjaan </label>
                                <input type="text" class="form-control" name="pekerjaan" id="pekerjaan" value="{{ $edit->pekerjaan }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama"> Nama </label>
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan Nama" value="{{ $edit->getPasien->nama }}">
                    </div>
                    <div class="form-group">
                        <label for="email"> Email </label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Masukkan Email" value="{{ $edit->getPasien->email }}">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="umur"> Umur </label>
                                <input type="number" class="form-control" name="umur" id="umur" placeholder="0" value="{{ $edit->getPasien->umur }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nomor_hp"> Nomor HP </label>
                                <input type="text" class="form-control" name="nomor_hp" id="nomor_hp" placeholder="0" value="{{ $edit->nomor_hp }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama_suami"> Nama Suami </label>
                        <input type="text" class="form-control" name="nama_suami" id="nama_suami" placeholder="Masukkan Nama Suami" value="{{ $edit->nama_suami }}">
                    </div>
                    <div class="form-group">
                        <label for="alamat"> Alamat </label>
                        <textarea name="alamat" class="form-control" id="alamat" rows="5" placeholder="Masukkan Alamat">{{ $edit->getPasien->alamat }}</textarea>
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

        $('body').on('click', '#deletePasien', function() {
            let kode_pasien = $(this).data('kode');

            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Untuk Menghapus Data Ini",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Iyaa, Saya Yakin'
            }).then((result) => {
                if (result.isConfirmed) {
                    form_string =
                        "<form method=\"POST\" action=\"{{ url('/admin/akun/pasien/') }}/" + kode_pasien +
                        "\" accept-charset=\"UTF-8\"><input name=\"_method\" type=\"hidden\" value=\"DELETE\"><input name=\"_token\" type=\"hidden\" value=\"{{ csrf_token() }}\"></form>"

                    form = $(form_string)
                    form.appendTo('body');
                    form.submit();
                } else {
                    Swal.fire('Konfirmasi Diterima!', 'Data Anda Masih Terdata', 'success');
                }
            })
        })
    });

    $("#form-tambah-pasien").validate({
        rules: {
            no_ktp:
            {
                required: true,
                number: true,
                minlength: 16,
                maxlength: 16
            },
            tanggal_lahir: "required",
            pekerjaan: "required",
            nama: "required",
            email:
            {
                required: true,
                email: true,
            },
            umur: "required",
            nomor_hp:
            {
                required: true,
                number: true,
                minlength: 12
            },
            kelurahan: "required",
            nama_suami: "required",
            alamat: "required"
        },
        messages: {
            no_ktp:
            {
                required: "<span class='teks-span'> Kolom No. KTP Tidak Boleh Kosong </span>",
                number: "<span class='teks-span'> Kolom No. KTP Harus Angka</span>",
                minlength: "<span class='teks-span'> Kolom No. KTP Minimal Harus 16 Angka</span>",
                maxlength: "<span class='teks-span'> Kolom No. KTP Maximal Harus 16 Angka</span>"
            },
            tanggal_lahir: "<span class='teks-span'> Kolom Tanggal Lahir Tidak Boleh Kosong </span>",
            pekerjaan: "<span class='teks-span'> Kolom Pekerjaan Tidak Boleh Kosong </span>",
            nama: "<span class='teks-span'> Kolom Nama Tidak Boleh Kosong </span>",
            email:
            {
                required: "<span class='teks-span'> Kolom Email Tidak Boleh Kosong </span>",
                email: "<span class='teks-span'> Format Email Salah </span>"
            },
            umur: "<span class='teks-span'> Kolom Umur Tidak Boleh Kosong </span>",
            nomor_hp:
            {
                required: "<span class='teks-span'>Kolom Nomor HP Tidak Boleh Kosong</span>",
                number: "<span class='teks-span'>Kolom Nomor HP Harus Angka</span>",
                minlength: "<span class='teks-span'> Kolom Nomor HP Minimal Harus 12 Angka</span>"
            },
            kelurahan: "<span class='teks-span'> Kolom Kelurahan Tidak Boleh Kosong </span>",
            nama_suami: "<span class='teks-span'> Kolom Nama Suami Tidak Boleh Kosong </span>",
            alamat: "<span class='teks-span'> Kolom Alamat Tidak Boleh Kosong </span>",
        },
        errorElement: "span"
    });

    $("#form-edit-pasien").validate({
        rules: {
            no_ktp:
            {
                required: true,
                number: true,
                minlength: 16,
                maxlength: 16
            },
            tanggal_lahir: "required",
            pekerjaan: "required",
            nama: "required",
            email:
            {
                required: true,
                email: true,
            },
            umur: "required",
            nomor_hp:
            {
                required: true,
                number: true,
                minlength: 12
            },
            kelurahan: "required",
            nama_suami: "required",
            alamat: "required"
        },
        messages: {
            no_ktp:
            {
                required: "<span class='teks-span'> Kolom No. KTP Tidak Boleh Kosong </span>",
                number: "<span class='teks-span'> Kolom No. KTP Harus Angka</span>",
                minlength: "<span class='teks-span'> Kolom No. KTP Minimal Harus 16 Angka</span>",
                maxlength: "<span class='teks-span'> Kolom No. KTP Maximal Harus 16 Angka</span>"
            },
            tanggal_lahir: "<span class='teks-span'> Kolom Tanggal Lahir Tidak Boleh Kosong </span>",
            pekerjaan: "<span class='teks-span'> Kolom Pekerjaan Tidak Boleh Kosong </span>",
            nama: "<span class='teks-span'> Kolom Nama Tidak Boleh Kosong </span>",
            email:
            {
                required: "<span class='teks-span'> Kolom Email Tidak Boleh Kosong </span>",
                email: "<span class='teks-span'> Format Email Salah </span>"
            },
            umur: "<span class='teks-span'> Kolom Umur Tidak Boleh Kosong </span>",
            nomor_hp:
            {
                required: "<span class='teks-span'>Kolom Nomor HP Tidak Boleh Kosong</span>",
                number: "<span class='teks-span'>Kolom Nomor HP Harus Angka</span>",
                minlength: "<span class='teks-span'> Kolom Nomor HP Minimal Harus 12 Angka</span>"
            },
            kelurahan: "<span class='teks-span'> Kolom Kelurahan Tidak Boleh Kosong </span>",
            nama_suami: "<span class='teks-span'> Kolom Nama Suami Tidak Boleh Kosong </span>",
            alamat: "<span class='teks-span'> Kolom Alamat Tidak Boleh Kosong </span>",
        },
        errorElement: "span"
    });

</script>

@endsection
