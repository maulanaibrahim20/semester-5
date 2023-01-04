<?php

namespace App\Http\Controllers\Bidan\Akun;

use App\Http\Controllers\Controller;
use App\Models\Akun\Bidan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProfilSayaController extends Controller
{
    public function index()
    {
        return view("bidan.akun.profil_saya.v_index");
    }

    public function update(Request $request, $id)
    {
        User::where("id", $id)->update([
            "nama" => $request->nama,
            "username" => Str::slug($request->nama),
            "email" => $request->email,
            "alamat" => $request->alamat,
            "umur" => $request->umur
        ]);

        Bidan::where("user_id", $id)->update([
            "nomor_hp" => $request->nomor_hp
        ]);

        return back();
    }
}
