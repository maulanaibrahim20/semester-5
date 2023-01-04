@extends("templating")

@section("title", "Data Kepala Desa")

@section("content")

<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">
            @yield("title")
        </h4>
        <ul class="breadcrumbs">
            <li class="nav-home">
                <a href="{{ url('/kepala_puskesmas/dashboard') }}">
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
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover" >
                            <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th>Nama</th>
                                    <th class="text-center">Nomor HP</th>
                                    <th>Alamat</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no = 0
                                @endphp
                                @foreach ($kelurahan as $item)
                                <tr>
                                    <td class="text-center">{{ ++$no }}.</td>
                                    <td>{{ $item->getUser->nama }}</td>
                                    <td class="text-center">{{ $item->nomor_hp }}</td>
                                    <td>{{ $item->getUser->alamat }}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModalDetail-{{ $item->id }}">
                                            <i class="fa fa-search"></i> Detail
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

@foreach ($kelurahan as $item)
<!-- Detail Data -->
<div class="modal fade" id="exampleModalDetail-{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Detail Data
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3 row">
                    <label for="nik" class="form-label col-sm-3 text-right"> NIK : </label>
                    <div class="col-md-7">
                        {{ $item->nik }}
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nama" class="form-label col-sm-3 text-right"> Email : </label>
                    <div class="col-md-7">
                        {{ $item->getUser->email }}
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nama" class="form-label col-sm-3 text-right"> Nama : </label>
                    <div class="col-md-7">
                        {{ $item->getUser->nama }}
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nomor_hp" class="form-label col-sm-3 text-right"> Nomor HP : </label>
                    <div class="col-md-7">
                        {{ $item->nomor_hp }}
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="umur" class="form-label col-sm-3 text-right"> Umur : </label>
                    <div class="col-md-7">
                        {{ $item->getUser->umur }}
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="kecamatan" class="form-label col-sm-3 text-right"> Kecamatan : </label>
                    <div class="col-md-7">
                        {{ $item->getUser->kecamatan }}
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="kelurahan" class="form-label col-sm-3 text-right"> Desa Kelurahan : </label>
                    <div class="col-md-7">
                        {{ $item->getUser->kelurahan }}
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="alamat" class="form-label col-sm-3 text-right"> Alamat : </label>
                    <div class="col-md-7">
                        {{ $item->getUser->alamat }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END -->
@endforeach

@endsection

@section("js")

<script src="{{ url('') }}/assets/js/plugin/datatables/datatables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#basic-datatables').DataTable({});
    });
</script>

@endsection
