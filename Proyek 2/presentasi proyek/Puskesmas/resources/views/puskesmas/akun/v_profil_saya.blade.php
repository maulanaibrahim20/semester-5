@extends("templating")

@section("title", "Profil Saya")

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
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <i class="fas fa-edit"></i> Edit Profil
                    </div>
                </div>
                <form action="{{ url('/kepala_puskesmas/akun/profil_saya/' . Auth::user()->id) }}" method="POST">
                    @method("PUT")
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama"> Nama </label>
                                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan Nama" value="{{ Auth::user()->nama }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email"> Email </label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Masukkan Email" value="{{ Auth::user()->email }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="umur"> Umur </label>
                                    <input type="number" class="form-control" name="umur" id="umur" placeholder="Masukkan Umur" value="{{ Auth::user()->umur }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nomor_hp"> Nomor HP </label>
                                    <input type="number" class="form-control" name="nomor_hp" id="nomor_hp" placeholder="0" value="{{ Auth::user()->getKepalaPuskesmas->nomor_hp }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="alamat"> Alamat </label>
                            <textarea name="alamat" class="form-control" id="alamat" rows="5" placeholder="Masukkan Alamat">{{ Auth::user()->alamat }}</textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        @include("komponen.button.btn_edit")
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <i class="fas fa-edit"></i> Ganti Password
                    </div>
                </div>
                <form action="{{ url('/kepala_puskesmas/akun/profil_saya/ganti_password') }}" method="POST">
                    @method("PUT")
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="password_baru"> Password Baru </label>
                            <input type="password" class="form-control" name="password_baru" id="password_baru" placeholder="Masukkan Password Baru">
                        </div>
                        <div class="form-group">
                            <label for="konfirmasi_password"> Konfirmasi Password </label>
                            <input type="password" class="form-control" name="konfirmasi_password" id="konfirmasi_password" placeholder="Masukkan Password Baru">
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
