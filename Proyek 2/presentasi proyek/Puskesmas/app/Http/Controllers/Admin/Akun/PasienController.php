<?php

namespace App\Http\Controllers\Admin\Akun;

use App\Http\Controllers\Controller;
use App\Models\Akun\Pasien;
use App\Models\Pasien\Antrian;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class PasienController extends Controller
{
    protected $wilayah = "https://emsifa.github.io/api-wilayah-indonesia/api/";

    public function index()
    {
        $data = [
            "pasien" => Pasien::orderBy("tanggal_daftar", "DESC")->get()
        ];

        $response = Http::get($this->wilayah."villages/3212170.json");

        $kecamatan = $response->json();

        return view("admin.akun.pasien.v_index", $data, compact("kecamatan"));
    }

    public function store(Request $request)
    {
        $antrian = 0;

        $count = Antrian::whereDate("tanggal_pendaftaran", date("Ymd"))->count();

        if ($count == 0) {
            $antrian = 1;
        } else {
            $data_antrian = DB::table("antrian_pasien")->max("nomer_antrian");

            $antrian = $data_antrian + 1;
        }

        $user = new User();

        $user["nama"] =  $request["nama"];
        $user["username"] = Str::slug($request->nama);
        $user["email"] = $request["email"];
        $user["umur"] = $request["umur"];
        $user["alamat"] = $request["alamat"];
        $user["password"] = bcrypt("password");
        $user["role_id"] = 6;
        $user["kecamatan"] = "LOHBENER";
        $user["kelurahan"] = $request["kelurahan"];

        $user->save();

        $pasien = new Pasien();

        $pasien["kode_pasien"] = date("YmdHis");
        $pasien["no_ktp"] = $request["no_ktp"];
        $pasien["tanggal_lahir"] = $request["tanggal_lahir"];
        $pasien["pekerjaan"] = $request["pekerjaan"];
        $pasien["tanggal_daftar"] = date("YmdHis");
        $pasien["nama_suami"] = $request["nama_suami"];
        $pasien["nomor_hp"] = $request["nomor_hp"];
        $pasien["user_id"] = $user->id;

        $pasien->save();

        Antrian::create([
            "id_antrian" => "AP-" . date("YmdHis"),
            "kode_pasien" => $pasien->kode_pasien,
            "nomer_antrian" => $antrian,
            "tanggal_pendaftaran" => date("YmdHis")
        ]);

        return back()->with(["message" => "<script>Swal.fire(
            'Berhasil!',
            'Data Berhasil di Tambahkan!',
            'success'
          )</script>"]);
    }

    public function update(Request $request, $user_id)
    {
        User::where("id", $user_id)->update([
            "nama" => $request->nama,
            "username" => $request->username,
            "email" => $request->email,
            "umur" => $request->umur,
            "alamat" => $request->alamat
        ]);

        Pasien::where("user_id", $user_id)->update([
            "no_ktp" => $request->no_ktp,
            "tanggal_lahir" => $request->tanggal_lahir,
            "pekerjaan" => $request->pekerjaan,
            "nama_suami" => $request->nama_suami,
            "nomor_hp" => $request->nomor_hp
        ]);

        return back()->with(["message" => "<script>Swal.fire(
            'Berhasil!',
            'Data Berhasil di Simpan!',
            'success'
          )</script>"]);
    }

    public function destroy($kode_pasien)
    {
        $user = Pasien::where("kode_pasien", $kode_pasien)->first();

        $user->delete();

        User::where("id", $user->user_id)->delete();

        return back()->with(["message" => "<script>Swal.fire(
            'Berhasil!',
            'Data Berhasil di Hapus!',
            'success'
          )</script>"]);
    }

    public function tambah_pasien(Request $request)
    {
        $pasien = Pasien::where("kode_pasien", $request->kode_pasien)->first();

        $count = Antrian::whereDate("tanggal_pendaftaran", date("Ymd"))->count();

        if ($count == 0) {
            $nomer_antrian = 1;
        } else {
            $max_nomer_antrian = DB::table("antrian_pasien")->max("nomer_antrian");

            $nomer_antrian = $max_nomer_antrian + 1;
        }

        Antrian::create([
            "id_antrian" => "AP-" . date("YmdHis"),
            "kode_pasien" => $request->kode_pasien,
            "nomer_antrian" => $nomer_antrian,
            "tanggal_pendaftaran" => date("YmdHis")
        ]);

        return back()->with(["message" => "<script>Swal.fire(
            'Berhasil!',
            'Data Antrian Berhasil di Buat!',
            'success'
          )</script>"]);
    }
}
