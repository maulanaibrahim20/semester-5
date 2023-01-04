<?php

namespace App\Http\Controllers\Kecamatan;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function view_pasien()
    {
        $data["user"] = User::where("role_id", 6)->get();

        return view("kecamatan.pasien.v_pasien", $data);
    }
}
