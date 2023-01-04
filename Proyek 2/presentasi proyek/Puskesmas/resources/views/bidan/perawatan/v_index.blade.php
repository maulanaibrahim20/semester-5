@extends("templating")

@section("title", "Data Keluhan Pasien")

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
                <i class="flaticon-right-arrow"></i> @yield("title")
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ url('/bidan/keluhan/pasien/create') }}" class="btn btn-primary btn-sm pull-right">
                        <i class="fa fa-plus"></i> Tambah
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover" >
                            <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th class="text-center">Kode Pasien</th>
                                    <th class="text-center">No KTP</th>
                                    <th>Nama</th>
                                    <th>Nomor HP</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 0
                                @endphp
                                @foreach ($pasien as $ps)
                                <tr>
                                    <td class="text-center">{{ ++$no }}.</td>
                                    <td class="text-center">{{ $ps->kode_pasien }}</td>
                                    <td class="text-center">{{ $ps->getPasien->no_ktp }}</td>
                                    <td>{{ $ps->getPasien->getPasien->nama }}</td>
                                    <td>{{ $ps->getPasien->nomor_hp }}</td>
                                    <td class="text-center">
                                        <a href="{{url('/bidan/keluhan/pasien/' . $ps->kode_pasien. '/edit')}}"
                                         class="btn btn-warning btn-sm">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
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

@endsection

@section("js")

<script src="{{ url('') }}/assets/js/plugin/datatables/datatables.min.js"></script>

{{-- <script>
    $(document).ready(function() {
        $('#basic-datatables').DataTable({});
    });
</script> --}}

@endsection
