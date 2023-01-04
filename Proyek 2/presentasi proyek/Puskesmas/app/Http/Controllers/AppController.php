<?php

namespace App\Http\Controllers;

use App\Models\Akun\Kelurahan;
use App\Models\Akun\KepalaKecamatan;
use App\Models\Akun\KepalaPuskesmas;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function dashboard_admin()
    {
        $data["count_kepala_puskesmas"] = KepalaPuskesmas::count();
        $data["count_kepala_kecamatan"] = KepalaKecamatan::count();
        $data["count_kepala_desa"] = Kelurahan::count();

        return view("admin.dashboard", $data);
    }

    public function dashboard_puskesmas()
    {
        return view("puskesmas.dashboard");
    }

    public function dashboard_desa()
    {
        return view("desa.dashboard");
    }

    public function dashboard_kecamatan()
    {
        return view("kecamatan.dashboard");
    }

    public function dashboard_bidan()
    {
        return view("bidan.dashboard");
    }
}
