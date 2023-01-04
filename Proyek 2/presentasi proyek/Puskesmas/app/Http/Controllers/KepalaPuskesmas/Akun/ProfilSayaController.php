<?php

namespace App\Http\Controllers\KepalaPuskesmas\Akun;

use App\Http\Controllers\Controller;
use App\Models\Akun\KepalaPuskesmas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProfilSayaController extends Controller
{
    public function index()
    {
        return view("puskesmas.akun.v_profil_saya");
    }

    public function update(Request $request, $id)
    {
        User::where("id", $id)->update([
            "nama" => $request->nama,
            "username" => Str::slug($request->username),
            "email" => $request->email,
            "umur" => $request->umur,
            "alamat" => $request->alamat
        ]);

        KepalaPuskesmas::where("user_id", $id)->update([
            "nomor_hp" => $request->nomor_hp
        ]);

        return back();
    }

    public function ganti_password(Request $request)
    {
        if ($request->password_baru != $request->konfirmasi_password) {
            return back();
        }

        User::where("id", Auth::user()->id)->update([
            "password" => bcrypt($request->password_baru)
        ]);

        return back();
    }
}
