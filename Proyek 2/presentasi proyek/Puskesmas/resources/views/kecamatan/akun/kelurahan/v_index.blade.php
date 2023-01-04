@extends("templating")

@section("title", "Data Pegawai Kelurahan " . Auth::user()->kelurahan)

@section("content")

<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">
            Data Pegawai Kelurahan {{ Auth::user()->kelurahan }}
        </h4>
        <ul class="breadcrumbs">
            <li class="nav-home">
                <a href="{{ url('/kepala_kecamatan/dashboard') }}">
                    <i class="flaticon-home"></i> Dashboard
                </a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i> Data Pegawai Kelurahan
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
                                    <th class="text-center">NIK</th>
                                    <th>Nama</th>
                                    <th>Nomor HP</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 0
                                @endphp
                                @foreach ($kelurahan as $ps)
                                <tr>
                                    <td class="text-center">{{ ++$no }}.</td>
                                    <td class="text-center">{{ $ps->getKelurahan->nik }}</td>
                                    <td>{{ $ps->nama }}</td>
                                    <td>{{ $ps->getKelurahan->nomor_hp }}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModalEdit-{{ $ps->id }}">
                                            <i class="fa fa-edit"></i> Edit
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModalHapus-{{ $ps->id }}">
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
            <form method="POST" action="{{ url('/kepala_kecamatan/akun/kelurahan/') }}">
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
                            @foreach ($api_kelurahan as $item)
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
@foreach ($kelurahan as $item)
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
            <form method="POST" action="{{ url('/kepala_kecamatan/akun/kelurahan/'. $item->id) }}">
                @method("PUT")
                @csrf <!-- Fungsi Pengamanan -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nik"> NIK </label>
                        <input type="number" class="form-control" name="nik" id="nik" placeholder="Masukkan NIK" required min="1" value="{{ $item->getKelurahan->nik }}" readonly>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama"> Nama </label>
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="0" required value="{{ $item->nama }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email"> Email </label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="0" required value="{{ $item->email }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="umur"> Umur </label>
                                <input type="number" class="form-control" name="umur" id="umur" placeholder="0" required min="1" value="{{ $item->umur }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nomor_hp"> Nomor HP </label>
                                <input type="text" class="form-control" name="nomor_hp" id="nomor_hp" placeholder="0" required min="1" value="{{ $item->getKelurahan->nomor_hp }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="kelurahan"> Kelurahan </label>
                        <select name="kelurahan" class="form-control" id="kelurahan">
                            <option value="">- Pilih -</option>
                            @foreach ($api_kelurahan as $kel)
                                @if ($item->kelurahan == $kel["name"])
                                <option value="{{ $kel["id"] }}" selected>
                                    {{ $kel["name"] }}
                                </option>
                                @else
                                <option value="{{ $kel["id"] }}">
                                    {{ $kel["name"] }}
                                </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="alamat"> Alamat </label>
                        <textarea name="alamat" class="form-control" id="alamat" rows="5" placeholder="Masukkan Alamat" required>{{ $item->alamat }}</textarea>
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

<!-- Hapus Data -->
@foreach ($kelurahan as $item)
<div class="modal fade" id="exampleModalHapus-{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Hapus Data
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ url('/kepala_kecamatan/akun/kelurahan/'. $item->id) }}">
                @method("DELETE")
                @csrf <!-- Fungsi Pengamanan -->
                <div class="modal-body">
                    <p>
                        Apakah Anda Yakin Ingin Menghapus Data
                        <strong>
                            {{ $item->nama }} ?
                        </strong>
                    </p>
                </div>
                <div class="modal-footer">
                    @include("komponen.button.btn_hapus")
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

<script>
    $(document).ready(function() {
        $('#basic-datatables').DataTable({});
    });
</script>

@endsection
