<?php

namespace App\Http\Controllers\Admin\Akun;

use App\Http\Controllers\Controller;
use App\Models\Akun\KepalaPuskesmas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KepalaPuskesmasController extends Controller
{
    public function index()
    {
        $data["kepala_puskesmas"] = KepalaPuskesmas::orderBy("created_at", "DESC")->get();

        return view("admin.akun.kepala_puskesmas.v_index", $data);
    }

    public function store(Request $request)
    {
        $user = User::create([
            "nama" => $request->nama,
            "username" => Str::slug($request->nama),
            "email" => $request->email,
            "password" => bcrypt("kepala_puskesmas"),
            "alamat" => $request->alamat,
            "umur" => $request->umur,
            "role_id" => 1
        ]);

        KepalaPuskesmas::create([
            "id_kepala_puskesmas" => "KP-" . date("YmdHis"),
            "nik" => $request->nik,
            "user_id" => $user->id,
            "nomor_hp" => $request->nomor_hp
        ]);

        return back()->with(["message" => "<script>Swal.fire(
            'Berhasil!',
            'Data Berhasil di Tambahkan!',
            'success'
          )</script>"]);
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

        KepalaPuskesmas::where("user_id", $id)->update([
            "nomor_hp" => $request->nomor_hp
        ]);

        return back()->with(["message" => "<script>Swal.fire(
            'Berhasil!',
            'Data Berhasil di Simpan!',
            'success'
          )</script>"]);
    }

    public function destroy($id)
    {
        $user = KepalaPuskesmas::where("id_kepala_puskesmas", $id)->first();

        User::where("id", $user->user_id)->delete();

        $user->delete();

        return back()->with(["message" => "<script>Swal.fire(
            'Berhasil!',
            'Data Berhasil di Hapus!',
            'success'
          )</script>"]);
    }
}
