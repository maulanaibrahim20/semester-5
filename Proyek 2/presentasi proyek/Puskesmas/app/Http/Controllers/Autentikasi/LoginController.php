<?php

namespace App\Http\Controllers\Autentikasi;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view("autentikasi.login");
    }

    public function post_login(Request $request)
    {
        $user = User::where("username", $request->username)->first();

        if (Auth::attempt(["username" => $request->username, "password" => $request->password]))
        {
            $request->session()->regenerate();

            if ($user->role_id == 1) {
                return redirect("/kepala_puskesmas/dashboard");
            } else if ($user->role_id == 2) {
                return redirect("/kepala_desa/dashboard");
            } else if ($user->role_id == 3) {
                return redirect("/kepala_kecamatan/dashboard");
            } else if ($user->role_id == 4) {
                return redirect("/admin/dashboard");
            } else if ($user->role_id == 5) {
                return redirect("/bidan/dashboard");
            }
        } else {
            return back();
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect("/login");
    }
}
