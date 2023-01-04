@php
    use App\Models\Perawatan\DetailKeluhan;
@endphp

@extends("templating")

@section("title", "Edit Keluhan Pasien")

@section("css")

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endsection

@section("content")

<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">
            @yield("title")
        </h4>
        <ul class="breadcrumbs">
            <li class="nav-home">
                <a href="{{ url('/bidan/dashboard') }}">
                    <i class="flaticon-home"></i> Dashboard
                </a>
            </li>
            <li class="separator">
                <a href="{{ url('/bidan/keluhan/pasien') }}">
                    <i class="flaticon-right-arrow"></i>
                    Data Keluhan Pasien
                </a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i> @yield("title")
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Tambah Data
                </div>
                <form action="{{ url('/bidan/keluhan/pasien/' . $edit_keluhan->kode_pasien) }}" method="POST">
                    @method("PUT")
                    @csrf
                    @php
                        $no = 0;
                    @endphp
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="kode_pasien"> Nama Pasien </label>
                                    <select name="kode_pasien" class="form-control select-option-data">
                                        <option value="">- Pilih Pasien  -</option>
                                        @foreach ($pasien as $item)
                                            @if ($edit_keluhan->kode_pasien == $item->kode_pasien)
                                            <option value="{{ $item->kode_pasien }}" selected>
                                                <strong>NIK : </strong> {{ $item->no_ktp }} -
                                                <strong>Nama : </strong> {{ $item->getPasien->nama }}
                                            </option>
                                            @else
                                            <option value="{{ $item->kode_pasien }}">
                                                <strong>NIK : </strong> {{ $item->no_ktp }} -
                                                <strong>Nama : </strong> {{ $item->getPasien->nama }}
                                            </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="kehamilan_ke"> Kehamilan Ke</label>
                                    <input type="number" class="form-control" name="kehamilan_ke" placeholder="0" min="1" value="{{ $edit_keluhan->kehamilan_ke }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="keluhan_pasien"> Keluhan Pasien </label>
                            <textarea name="keluhan_pasien" class="form-control" id="keluhan_pasien" rows="5" placeholder="Masukkan Keluhan Pasien">{{ $edit_keluhan->keluhan_pasien }}</textarea>
                        </div>
                        <hr>
                        <div class="form-group">
                            @foreach ($pertanyaan as $item)
                            <input type="hidden" name="id_pertanyaan[]" value="{{ $no++ }}">
                            <div class="row mb-3">
                                <div class="col-md-8">
                                    {{ $item->teks_pertanyaan }}
                                </div>
                                <div class="col-md-4">
                                    <select name="status[]" class="form-control" id="status">
                                        <option value="">- Pilih -</option>
                                        @php
                                            $detail_keluhan = DetailKeluhan::where("id_keluhan", $edit_keluhan->id)->where("id_pertanyaan", $item->id)->first();
                                        @endphp
                                        <option value="1" {{ $detail_keluhan->status == 1 ? 'selected' : '' }} >Ya</option>
                                        <option value="0" {{ $detail_keluhan->status == 0 ? 'selected' : '' }} >Tidak</option>
                                    </select>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <label for="solusi_bidan"> Solusi Bidan </label>
                            <textarea name="solusi_bidan" class="form-control" id="solusi_bidan" rows="5" placeholder="Masukkan Solusi">{{ $edit_keluhan->solusi_bidan }}</textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        @include("komponen.button.btn_edit")
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section("js")

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.select-option-data').select2();
    });
</script>

@endsection
