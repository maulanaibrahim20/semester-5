<?php

namespace App\Http\Controllers\Admin\Akun;

use App\Http\Controllers\Controller;
use App\Models\Akun\KepalaKecamatan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class KepalaKecamatanController extends Controller
{
    protected $wilayah = "https://emsifa.github.io/api-wilayah-indonesia/api/";

    public function index()
    {
        $data["kepala_kecamatan"] = User::where("role_id", 3)->orderBy("created_at", "DESC")->get();

        $response = Http::get($this->wilayah."villages/3212170.json");

        $kecamatan = $response->json();

        return view("admin.akun.kepala_kecamatan.v_index", $data, compact("kecamatan"));
    }

    public function store(Request $request)
    {
        $response = Http::get($this->wilayah."villages/3212170.json");

        $kecamatan = $response->json();

        foreach ($kecamatan as $k) {
            if ($k["id"] == $request->kelurahan) {
                $kelurahan = $k["name"];
            }
        }

        $user = User::create([
            "nama" => $request->nama,
            "username" => Str::slug($request->nama),
            "email" => $request->email,
            "password" => bcrypt("kecamatan"),
            "alamat" => $request->alamat,
            "umur" => $request->umur,
            "role_id" => 3,
            "kecamatan" => "LOHBENER",
            "kelurahan" => $kelurahan
        ]);

        KepalaKecamatan::create([
            "id_kepala_kecamatan" => "KK-" . date("YmdHis"),
            "nik" => $request->nik,
            "user_id" => $user->id,
            "nomor_hp" => $request->nomor_hp
        ]);

        return back();
    }
}
