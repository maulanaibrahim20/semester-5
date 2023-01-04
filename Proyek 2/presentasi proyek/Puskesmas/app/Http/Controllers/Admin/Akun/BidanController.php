<?php

namespace App\Http\Controllers\Admin\Akun;

use App\Http\Controllers\Controller;
use App\Models\Akun\Bidan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class BidanController extends Controller
{
    protected $wilayah = "https://emsifa.github.io/api-wilayah-indonesia/api/";

    public function index()
    {
        $data = [
            "bidan" => Bidan::orderBy("created_at", "DESC")->get()
        ];

        $response = Http::get($this->wilayah."villages/3212170.json");

        $kelurahan = $response->json();

        return view("admin.akun.bidan.v_index", $data, compact("kelurahan"));
    }

    public function store(Request $request)
    {
        $user = new User();

        $user["nama"] =  $request["nama"];
        $user["username"] = Str::slug($request["nama"]);
        $user["email"] = $request["email"];
        $user["umur"] = $request["umur"];
        $user["alamat"] = $request["alamat"];
        $user["password"] = bcrypt("password");
        $user["kecamatan"] = "LOHBENER";
        $user["kelurahan"] = $request->kelurahan;
        $user["role_id"] = 5;

        $user->save();

        $bidan = new Bidan();

        $bidan["nomor_hp"] = $request["nomor_hp"];
        $bidan["user_id"] = $user->id;

        $bidan->save();

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
            "username" => $request->username,
            "email" => $request->email,
            "umur" => $request->umur,
            "alamat" => $request->alamat
        ]);

        Bidan::where("user_id", $id)->update([
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
        $user = Bidan::where("id", $id)->first();

        User::where("id", $user->user_id)->delete();

        $user->delete();

        return back()->with(["message" => "<script>Swal.fire(
            'Berhasil!',
            'Data Berhasil di Hapus!',
            'success'
          )</script>"]);
    }
}
