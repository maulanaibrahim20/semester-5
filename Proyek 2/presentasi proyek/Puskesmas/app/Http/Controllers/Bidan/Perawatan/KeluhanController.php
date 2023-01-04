<?php

namespace App\Http\Controllers\Bidan\Perawatan;

use App\Http\Controllers\Controller;
use App\Models\Akun\Pasien;
use App\Models\Master\Pertanyaan;
use App\Models\Perawatan\DetailKeluhan;
use App\Models\Perawatan\Keluhan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeluhanController extends Controller
{
    public function index()
    {
        $data["pasien"] = Keluhan::where("bidan_id", Auth::user()->id)->orderBy("created_at", "ASC")->get();

        return view("bidan.perawatan.v_index", $data);
    }

    public function create()
    {
        $data["pertanyaan"] = Pertanyaan::get();
        $data["pasien"] = Pasien::get();

        return view("bidan.perawatan.v_create", $data);
    }

    public function store(Request $request)
    {
        $keluhan = Keluhan::create([
            "no_regis" => "RGS-" . date("YmdHis"),
            "kode_pasien" => $request->kode_pasien,
            "kehamilan_ke" => $request->kehamilan_ke,
            "keluhan_pasien" => $request->keluhan_pasien,
            "bidan_id" => Auth::user()->id,
            "solusi_bidan" => $request->solusi_bidan
        ]);

        foreach ($request->id_pertanyaan as $pertanyaan) {
            DetailKeluhan::create([
                "id_keluhan" => $keluhan->id,
                "id_pertanyaan" => $request->pertanyaan_id[$pertanyaan],
                "status" => $request->status[$pertanyaan]
            ]);
        }

        return redirect("/bidan/keluhan/pasien");
    }

    public function edit($id)
    {
        $data["pasien"] = Pasien::get();
        $data["pertanyaan"] = Pertanyaan::get();
        $data["edit_keluhan"] = Keluhan::where("kode_pasien", $id)->first();

        return view("bidan.perawatan.v_edit", $data);
    }

    public function update(Request $request, $kode_pasien)
    {
        Keluhan::where("kode_pasien", $kode_pasien)->update([
            "kehamilan_ke" => $request->kehamilan_ke,
            "keluhan_pasien" => $request->keluhan_pasien,
            "solusi_bidan" => $request->solusi_bidan
        ]);


    }
}
