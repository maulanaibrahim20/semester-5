<?php

namespace App\Http\Controllers\Kecamatan;

use App\Http\Controllers\Controller;
use App\Models\Akun\Kelurahan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AkunKelurahanController extends Controller
{
    protected $wilayah = "https://emsifa.github.io/api-wilayah-indonesia/api/";

    public function index()
    {
        $data["kelurahan"] = User::where("kecamatan", Auth::user()->kecamatan)->where("role_id", 2)->get();

        $response = Http::get($this->wilayah."villages/3212170.json");

        $api_kelurahan = $response->json();

        return view("kecamatan.akun.kelurahan.v_index", $data, compact("api_kelurahan"));
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
            "role_id" => 2,
            "kecamatan" => "LOHBENER",
            "kelurahan" => $kelurahan
        ]);

        Kelurahan::create([
            "id_kelurahan" => "KEL-" . date("YmdHis"),
            "nik" => $request->nik,
            "user_id" => $user->id,
            "nomor_hp" => $request->nomor_hp
        ]);

        return back();
    }

    public function update(Request $request, $id)
    {
        $response = Http::get($this->wilayah."villages/3212170.json");

        $kecamatan = $response->json();

        foreach ($kecamatan as $k) {
            if ($k["id"] == $request->kelurahan) {
                $kelurahan = $k["name"];
            }
        }

        User::where("id", $id)->update([
            "nama" => $request->nama,
            "username" => Str::slug($request->nama),
            "email" => $request->email,
            "alamat" => $request->alamat,
            "umur" => $request->umur,
            "kelurahan" => $kelurahan
        ]);

        Kelurahan::where("user_id", $id)->update([
            "nomor_hp" => $request->nomor_hp
        ]);

        return back();
    }

    public function destroy($id)
    {
        Kelurahan::where("user_id", $id)->delete();

        User::where("id", $id)->delete();

        return back();
    }
}
