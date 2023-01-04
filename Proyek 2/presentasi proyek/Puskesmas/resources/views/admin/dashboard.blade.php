@extends("templating")

@section("title", "Dashboard")

@section("content")

<div class="page-inner bg-info-gradient">
    <div class="mt-2 mb-4">
        <h2 class="text-white pb-2">Selamat Datang, {{ Auth::user()->nama }} </h2>
        <h5 class="text-white op-7 mb-4">
            di Aplikasi {{ env("APP_NAME") }}. Anda Login Sebagai
            @if (Auth::user()->role_id == 4)
                Administrator
            @endif. Silahkan Pilih Menu Untuk Memulai Program.
        </h5>
    </div>
</div>

<div class="page-inner">
    <div class="row">
        <div class="col-md-4">
            <div class="card card-dark bg-primary-gradient">
                <div class="card-body pb-0">
                    <h2 class="mb-2">{{ $count_kepala_puskesmas }}</h2>
                    <p>Kepala Puskesmas</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-dark bg-secondary-gradient">
                <div class="card-body pb-0">
                    <h2 class="mb-2">{{ $count_kepala_kecamatan }}</h2>
                    <p>Kepala Kecamatan</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-dark bg-success2">
                <div class="card-body pb-0">
                    <h2 class="mb-2">{{ $count_kepala_desa }}</h2>
                    <p>Kepala Desa</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

