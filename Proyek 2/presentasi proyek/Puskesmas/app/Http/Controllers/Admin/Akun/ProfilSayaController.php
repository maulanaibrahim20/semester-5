<?php

namespace App\Http\Controllers\Admin\Akun;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProfilSayaController extends Controller
{
    public function index()
    {
        return view("admin.akun.profil_saya.v_index");
    }

    public function update(Request $request, $id)
    {
        User::where("id", $id)->update([
            "nama" => $request->nama,
            "username" => Str::slug($request->nama),
            "email" => $request->email,
            "umur" => $request->umur,
            "alamat" => $request->alamat
        ]);

        return back();
    }

    public function ganti_password(Request $request)
    {
        if ($request->password_baru != $request->konfirmasi_password) {
            return back();
        }

        User::where("id", Auth::user()->id)->update([
            "password" => bcrypt($request->password)
        ]);

        return back();
    }
}
