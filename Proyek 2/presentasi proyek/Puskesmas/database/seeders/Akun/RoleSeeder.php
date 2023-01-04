<?php

namespace Database\Seeders\Akun;

use App\Models\Akun\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            "nama" => "Kepala Puskesmas"
        ]);

        Role::create([
            "nama" => "Kepala Desa"
        ]);

        Role::create([
            "nama" => "Kepala Kecamatan"
        ]);

        Role::create([
            "nama" => "Admin"
        ]);

        Role::create([
            "nama" => "Bidan"
        ]);

        Role::create([
            "nama" => "Pasien"
        ]);
    }
}
