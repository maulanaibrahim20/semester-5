<?php

namespace Database\Seeders\Akun;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "nama" => "Administrator",
            "username" => "admin",
            "email" => "admin@gmail.com",
            "password" => bcrypt("password"),
            "alamat" => "Bandung",
            "umur" => 21,
            "role_id" => 4
        ]);

        User::create([
            "nama" => "Kepala Desa",
            "username" => "kepala-desa",
            "email" => "kepala_desa@gmail.com",
            "password" => bcrypt("password"),
            "alamat" => "Bandung",
            "umur" => 21,
            "role_id" => 2
        ]);

        User::create([
            "nama" => "Bidan",
            "username" => "bidan",
            "email" => "bidan@gmail.com",
            "password" => bcrypt("password"),
            "alamat" => "Bandung",
            "umur" => 21,
            "role_id" => 5
        ]);
    }
}
