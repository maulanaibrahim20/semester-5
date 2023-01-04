@extends("templating")

@section("title", "Pendaftaran Kepala Kecamatan")

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
            Kepala Kecamatan
        </h4>
        <ul class="breadcrumbs">
            <li class="nav-home">
                <a href="{{ url('/admin/dashboard') }}">
                    <i class="flaticon-home"></i> Dashboard
                </a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i> Pendaftaran Akun Kepala Kecamatan
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
                                    <th>Nama</th>
                                    <th>NIK</th>
                                    <th>Email</th>
                                    <th>Nomor HP</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0 ?>
                                @foreach ($kepala_kecamatan as $data)
                                <tr>
                                    <td class="text-center">{{ ++$no }}.</td>
                                    <td>{{ $data->nama }}</td>
                                    <td>{{ $data->getKepalaKecamatan->nik }}</td>
                                    <td>{{ $data->email }}</td>
                                    <td>{{ $data->getKepalaKecamatan->nomor_hp }}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModalEdit-{{ $data->id }}">
                                            <i class="fa fa-edit"></i> Edit
                                        </button>
                                        <form action="{{ url('/admin/akun/pasien/' . $data->kode_pasien) }}" method="POST" style="display: inline">
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
            <form method="POST" action="{{ url('/admin/akun/kepala_kecamatan/') }}" id="form-tambah-kepala-kecamatan">
                @csrf <!-- Fungsi Pengamanan -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nik"> NIK </label>
                        <input type="number" class="form-control" name="nik" id="nik" placeholder="Masukkan NIK" required min="1">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama"> Nama </label>
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="0" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email"> Email </label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="0" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="umur"> Umur </label>
                                <input type="number" class="form-control" name="umur" id="umur" placeholder="0" required min="1">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nomor_hp"> Nomor HP </label>
                                <input type="text" class="form-control" name="nomor_hp" id="nomor_hp" placeholder="0" required min="1">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="kelurahan"> Kelurahan </label>
                        <select name="kelurahan" class="form-control" id="kelurahan">
                            <option value="">- Pilih -</option>
                            @foreach ($kecamatan as $item)
                                <option value="{{ $item["id"] }}">
                                    {{ $item["name"] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="alamat"> Alamat </label>
                        <textarea name="alamat" class="form-control" id="alamat" rows="5" placeholder="Masukkan Alamat" required></textarea>
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
@foreach($kepala_kecamatan as $edit)
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
            <form method="POST" action="{{ url('/admin/akun/pasien/'.$edit->user_id) }}">
                @method("PUT")
                @csrf <!-- Fungsi Pengamanan -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nik"> NIK </label>
                                <input type="number" class="form-control" name="nik" id="nik" placeholder="Masukkan NIK" required min="1" value="{{ $edit->nik }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="no_ktp"> No. KTP </label>
                                <input type="number" class="form-control" name="no_ktp" id="no_ktp" placeholder="Masukkan No. KTP" required min="1" value="{{ $edit->no_ktp }}">
                            </div>
                        </div>
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
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama"> Nama </label>
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan Nama" required value="{{ $edit->nama }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="username"> Username </label>
                                <input type="text" class="form-control" name="username" id="username" placeholder="Masukkan Username" required value="{{ $edit->username }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email"> Email </label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Masukkan Email" required value="{{ $edit->email }}">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="umur"> Umur </label>
                                <input type="number" class="form-control" name="umur" id="umur" placeholder="0" required min="1" value="{{ $edit->umur }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nomor_hp"> Nomor HP </label>
                                <input type="text" class="form-control" name="nomor_hp" id="nomor_hp" placeholder="0" required min="1" value="{{ $edit->nomor_hp }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama_suami"> Nama Suami </label>
                        <input type="text" class="form-control" name="nama_suami" id="nama_suami" placeholder="Masukkan Nama Suami" value="{{ $edit->nama_suami }}">
                    </div>
                    <div class="form-group">
                        <label for="alamat"> Alamat </label>
                        <textarea name="alamat" class="form-control" id="alamat" rows="5" placeholder="Masukkan Alamat" required>{{ $edit->alamat }}</textarea>
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

    $("#form-tambah-kepala-kecamatan").validate({
        rules: {
            nik:
            {
                required: true,
                number: true,
                minlength: 16,
                maxlength: 16
            },
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
            alamat: "required"
        },
        messages: {
            nik:
            {
                required: "<span class='teks-span'> Kolom NIK Tidak Boleh Kosong </span>",
                number: "<span class='teks-span'> Kolom NIK Harus Angka</span>",
                minlength: "<span class='teks-span'> Kolom NIK Minimal Harus 16 Angka</span>",
                maxlength: "<span class='teks-span'> Kolom NIK Maximal Harus 16 Angka</span>"
            },
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
            alamat: "<span class='teks-span'> Kolom Alamat Tidak Boleh Kosong </span>",
        },
        errorElement: "span"
    });
</script>

@endsection
