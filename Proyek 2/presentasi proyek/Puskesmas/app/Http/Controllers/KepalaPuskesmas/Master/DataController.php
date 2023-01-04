<?php

namespace App\Http\Controllers\KepalaPuskesmas\Master;

use App\Http\Controllers\Controller;
use App\Models\Akun\Bidan;
use App\Models\Akun\Kelurahan;
use App\Models\Akun\KepalaKecamatan;
use App\Models\Akun\Pasien;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function data_pasien()
    {
        $data["pasien"] = Pasien::orderBy("kode_pasien", "ASC")->get();

        return view("puskesmas.master.v_data_pasien", $data);
    }

    public function data_bidan()
    {
        $data["bidan"] = Bidan::orderBy("created_at", "ASC")->get();

        return view("puskesmas.master.v_data_bidan", $data);
    }

    public function data_kepala_kecamatan()
    {
        $data["kepala_kecamatan"] = KepalaKecamatan::orderBy("created_at", "ASC")->get();

        return view("puskesmas.master.v_data_kepala_kecamatan", $data);
    }

    public function data_kepala_desa()
    {
        $data["kelurahan"] = Kelurahan::orderBy("created_at", "ASC")->get();

        return view("puskesmas.master.v_data_kepala_desa", $data);
    }
}
