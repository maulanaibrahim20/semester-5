<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="{{ url('') }}/assets/img/profile.jpg" alt="{{ url('') }}." class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            {{ Auth::user()->nama }}
                            <span class="user-level">
                                {{ Auth::user()->getAkses->nama }}
                            </span>
                            <span class="caret"></span>
                        </span>
                    </a>
                    <div class="clearfix"></div>

                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="#profile">
                                    <span class="link-collapse">Profil Saya</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav nav-primary">
                <li class="nav-item {{ Request::segment(2) == "dashboard" ? "active" : "" }} ">
                    @if (Auth::user()->role_id == 1)
                    <a href="{{ url('/kepala_puskesmas/dashboard') }}">
                    @elseif(Auth::user()->role_id == 2)
                    <a href="{{ url('/kepala_desa/dashboard') }}">
                    @elseif(Auth::user()->role_id == 3)
                    <a href="{{ url('/kepala_kecamatan/dashboard') }}">
                    @elseif(Auth::user()->role_id == 4)
                    <a href="{{ url('/admin/dashboard') }}">
                    @elseif(Auth::user()->role_id == 5)
                    <a href="{{ url('/bidan/dashboard') }}">
                    @elseif(Auth::user()->role_id == 6)
                    <a href="{{ url('/pasien/dashboard') }}">
                    @endif
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Menu</h4>
                </li>

                @can("puskesmas")
                <li class="nav-item {{ Request::is("kepala_puskesmas/master/data_pasien") ? 'active' : '' }} ">
                    <a href="{{ url('/kepala_puskesmas/master/data_pasien') }}">
                        <i class="fas fa-users"></i>
                        <p>Data Pasien</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::is("kepala_puskesmas/master/data_bidan") ? 'active' : '' }} ">
                    <a href="{{ url('/kepala_puskesmas/master/data_bidan') }}">
                        <i class="fas fa-users"></i>
                        <p>Data Bidan</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::is("kepala_puskesmas/master/data_kepala_kecamatan") ? 'active' : '' }} ">
                    <a href="{{ url('/kepala_puskesmas/master/data_kepala_kecamatan') }}">
                        <i class="fas fa-user"></i>
                        <p>Data Kepala Kecamatan</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::is("kepala_puskesmas/master/data_kepala_desa") ? 'active' : '' }} ">
                    <a href="{{ url('/kepala_puskesmas/master/data_kepala_desa') }}">
                        <i class="fas fa-user"></i>
                        <p>Data Kepala Desa</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::is("kepala_puskesmas/akun/profil_saya") ? 'active' : '' }} ">
                    <a href="{{ url('/kepala_puskesmas/akun/profil_saya') }}">
                        <i class="fas fa-edit"></i>
                        <p>Profil Saya</p>
                    </a>
                </li>
                @endcan

                @can("admin")
                <li class="nav-item {{ Request::segment(2) == "master" ? "active submenu" : "" }} ">
                    <a data-toggle="collapse" href="#master">
                        <i class="fas fa-bars"></i>
                        <p>Master</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ Request::segment(3) == "pertanyaan" ? "show" : "" }} " id="master">
                        <ul class="nav nav-collapse">
                            <li class="{{ Request::segment(3) == "pertanyaan" ? "active" : "" }}">
                                <a href="{{ url('/admin/master/pertanyaan') }}">
                                    <span class="sub-item">Pertanyaan</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endcan
                @can("admin")
                <li class="nav-item {{ Request::segment(2) == "akun" ? "active submenu" : "" }} ">
                    <a data-toggle="collapse" href="#daftar_akun">
                        <i class="fas fa-pen-square"></i>
                        <p>Daftar Akun</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ Request::segment(2) == "akun" ? "show" : "" }} " id="daftar_akun">
                        <ul class="nav nav-collapse">
                            <li class="{{ Request::segment(3) == "kepala_puskesmas" ? "active" : "" }}">
                                <a href="{{ url('/admin/akun/kepala_puskesmas') }}">
                                    <span class="sub-item">
                                        Form Pendaftaran Kepala Puskesmas
                                    </span>
                                </a>
                            </li>
                            <li class="{{ Request::segment(3) == "bidan" ? "active" : "" }}">
                                <a href="{{ url('/admin/akun/bidan') }}">
                                    <span class="sub-item">
                                        Form Pendafaran Bidan
                                    </span>
                                </a>
                            </li>
                            <li class="{{ Request::segment(3) == "pasien" ? "active" : "" }}">
                                <a href="{{ url('/admin/akun/pasien') }}">
                                    <span class="sub-item">
                                        Form Pendafaran Pasien
                                    </span>
                                </a>
                            </li>
                            <li class="{{ Request::segment(3) == "kepala_kecamatan" ? "active" : "" }}">
                                <a href="{{ url('/admin/akun/kepala_kecamatan') }}">
                                    <span class="sub-item">
                                        Form Pendaftaran Kepala Kecamatan
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ Request::is("admin/pengaturan/profil_saya") ? 'active' : '' }} ">
                    <a href="{{ url('/admin/pengaturan/profil_saya') }}">
                        <i class="fas fa-edit"></i>
                        <p>Profil Saya</p>
                    </a>
                </li>
                @endcan

                @can("kecamatan")
                <li class="nav-item">
                    <a href="{{ url('/kepala_kecamatan/pasien') }}">
                        <i class="fas fa-users"></i>
                        <p>Pasien</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::segment(3) == "kelurahan" ? "active" : "" }} ">
                    <a href="{{ url('/kepala_kecamatan/akun/kelurahan') }}">
                        <i class="fas fa-user"></i>
                        <p>Akun Kelurahan</p>
                    </a>
                </li>
                @endcan

                @can("bidan")
                <li class="nav-item {{ Request::segment(3) == "pasien" ? "active" : "" }} ">
                    <a href="{{ url('/bidan/keluhan/pasien') }}">
                        <i class="fas fa-book"></i>
                        <p>Keluhan Pasien</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::is("bidan/akun/profil_saya") ? 'active' : '' }} ">
                    <a href="{{ url('/bidan/akun/profil_saya') }}">
                        <i class="fas fa-edit"></i>
                        <p>Profil Saya</p>
                    </a>
                </li>
                @endcan
            </ul>
        </div>
    </div>
</div>
