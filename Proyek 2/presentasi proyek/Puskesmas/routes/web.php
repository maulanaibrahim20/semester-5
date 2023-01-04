<?php

use App\Http\Controllers\Admin\Akun\BidanController;
use App\Http\Controllers\Admin\Akun\KepalaKecamatanController;
use App\Http\Controllers\Admin\Akun\KepalaPuskesmasController;
use App\Http\Controllers\Admin\Akun\PasienController;
use App\Http\Controllers\Admin\Akun\ProfilSayaController as AkunProfilSayaController;
use App\Http\Controllers\Admin\Master\PertanyaanController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\Autentikasi\LoginController;
use App\Http\Controllers\Bidan\Akun\ProfilSayaController as BidanAkunProfilSayaController;
use App\Http\Controllers\Bidan\Perawatan\KeluhanController;
use App\Http\Controllers\Kecamatan\AkunKelurahanController;
use App\Http\Controllers\Kecamatan\PasienController as KecamatanPasienController;
use App\Http\Controllers\KepalaPuskesmas\Akun\ProfilSayaController;
use App\Http\Controllers\KepalaPuskesmas\Master\DataController;
use App\Http\Controllers\LandingPageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [LandingPageController::class, "index"]);

Route::group(["middleware" => ["guest"]], function() {
    Route::get("/login", [LoginController::class, "login"]);
    Route::post("/login", [LoginController::class, "post_login"]);
});


Route::group(["middleware" => ["autentikasi"]], function() {

    Route::group(["middleware" => ["can:puskesmas"]], function() {
        Route::prefix("kepala_puskesmas")->group(function() {
            Route::get("/dashboard", [AppController::class, "dashboard_puskesmas"]);
            Route::prefix("master")->group(function() {
                Route::get("/data_pasien", [DataController::class, "data_pasien"]);
                Route::get("/data_bidan", [DataController::class, "data_bidan"]);
                Route::get("/data_kepala_kecamatan", [DataController::class, "data_kepala_kecamatan"]);
                Route::get("/data_kepala_desa", [DataController::class, "data_kepala_desa"]);
            });
            Route::prefix("akun")->group(function() {
                Route::put("/profil_saya/ganti_password", [ProfilSayaController::class, "ganti_password"]);
                Route::resource("profil_saya", ProfilSayaController::class);
            });
        });
    });

    Route::group(["middleware" => ["can:admin"]], function() {
        // Admin
        Route::prefix("admin")->group(function() {
            Route::get("/dashboard", [AppController::class, "dashboard_admin"]);

            Route::prefix("master")->group(function() {
                Route::resource("pertanyaan", PertanyaanController::class);
            });

            Route::prefix("akun")->group(function() {
                Route::resource("kepala_kecamatan", KepalaKecamatanController::class);
                Route::resource("bidan", BidanController::class);
                Route::post("/pasien/tambah-pasien", [PasienController::class, "tambah_pasien"]);
                Route::resource("pasien", PasienController::class);
                Route::resource("kepala_puskesmas", KepalaPuskesmasController::class);
            });
            Route::prefix("pengaturan")->group(function() {
                Route::put("/profil_saya/ganti_password", [AkunProfilSayaController::class, "ganti_password"]);
                Route::resource("/profil_saya", AkunProfilSayaController::class);
            });
        });
    });

    Route::get("kepala_puskesmas/dashboard", [AppController::class, "dashboard_puskesmas"]);
    Route::get("kepala_desa/dashboard", [AppController::class, "dashboard_desa"]);

    Route::group(["middleware" => ["can:kecamatan"]], function() {
        Route::prefix("kepala_kecamatan")->group(function() {
            Route::get("/dashboard", [AppController::class, "dashboard_kecamatan"]);
            Route::get("/pasien", [KecamatanPasienController::class, "view_pasien"]);
            Route::prefix("akun")->group(function() {
                Route::resource("kelurahan", AkunKelurahanController::class);
            });
        });
    });

    Route::group(["middleware" => ["can:bidan"]], function() {
        Route::prefix("bidan")->group(function() {
            Route::prefix("perawatan")->group(function() {
                Route::get("/pasien", [KeluhanController::class, "data_pasien"]);
            });
            Route::prefix("keluhan")->group(function() {
                Route::resource("/pasien", KeluhanController::class);
            });

            Route::prefix("akun")->group(function() {
                Route::resource("profil_saya", BidanAkunProfilSayaController::class);
            });
            Route::get("dashboard", [AppController::class, "dashboard_bidan"]);
        });
    });

    Route::get("/logout", [LoginController::class, "logout"]);
});

Route::get("/templating", function() {
    return view("/templating");
});


