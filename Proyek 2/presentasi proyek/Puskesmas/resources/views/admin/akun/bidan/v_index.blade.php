@extends("templating")

@section("title", "Pendaftaran Akun Bidan")

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
            Bidan
        </h4>
        <ul class="breadcrumbs">
            <li class="nav-home">
                <a href="{{ url('/admin/dashboard') }}">
                    <i class="flaticon-home"></i> Dashboard
                </a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i> Pendaftaran Akun Bidan
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
                                    <th>Email</th>
                                    <th>Nomor HP</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0 ?>
                                @foreach ($bidan as $data)
                                <tr>
                                    <td class="text-center">{{ ++$no }}.</td>
                                    <td>{{ $data->getBidan->nama }}</td>
                                    <td>{{ $data->getBidan->email }}</td>
                                    <td>{{ $data->nomor_hp }}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModalEdit-{{ $data->id }}">
                                            <i class="fa fa-edit"></i> Edit
                                        </button>
                                        <button id="deleteBidan" data-id="{{ $data->id }}"
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
            <form method="POST" action="{{ url('/admin/akun/bidan/') }}" id="form-tambah-bidan">
                @csrf <!-- Fungsi Pengamanan -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama"> Nama </label>
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan Nama" required>
                    </div>
                    <div class="form-group">
                        <label for="email"> Email </label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Masukkan Email" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="umur"> Umur </label>
                                <input type="number" class="form-control" name="umur" id="umur" placeholder="0" required min="20">
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
                            @foreach ($kelurahan as $item)
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
@foreach($bidan as $edit)
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
            <form method="POST" action="{{ url('/admin/akun/bidan/'.$edit->user_id) }}" id="form-edit-bidan">
                @method("PUT")
                @csrf <!-- Fungsi Pengamanan -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama"> Nama </label>
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan Nama" required value="{{ $edit->getBidan->nama }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="username"> Username </label>
                                <input type="text" class="form-control" name="username" id="username" placeholder="Masukkan Username" required value="{{ $edit->getBidan->username }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email"> Email </label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Masukkan Email" required value="{{ $edit->getBidan->email }}">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="umur"> Umur </label>
                                <input type="number" class="form-control" name="umur" id="umur" placeholder="0" required min="20" value="{{ $edit->getBidan->umur }}">
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
                        <label for="alamat"> Alamat </label>
                        <textarea name="alamat" class="form-control" id="alamat" rows="5" placeholder="Masukkan Alamat" required>{{ $edit->getBidan->alamat }}</textarea>
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

        $('body').on('click', '#deleteBidan', function() {
            let id_bidan = $(this).data('id');

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
                        "<form method=\"POST\" action=\"{{ url('/admin/akun/bidan/') }}/" + id_bidan +
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

    $("#form-tambah-bidan").validate({
        rules: {
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

    $("#form-edit-bidan").validate({
        rules: {
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
