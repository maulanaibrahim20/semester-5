<?php

namespace Database\Seeders\Master;

use App\Models\Master\Pertanyaan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PertanyaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pertanyaan::create([
            "teks_pertanyaan" => "Lorem Ipsum Dolor Sit Amet 1 ?",
            "bobot" => 100
        ]);

        Pertanyaan::create([
            "teks_pertanyaan" => "Lorem Ipsum Dolor Sit Amet 2 ?",
            "bobot" => 90
        ]);

        Pertanyaan::create([
            "teks_pertanyaan" => "Lorem Ipsum Dolor Sit Amet 3 ?",
            "bobot" => 80
        ]);

        Pertanyaan::create([
            "teks_pertanyaan" => "Lorem Ipsum Dolor Sit Amet 4 ?",
            "bobot" => 70
        ]);

        Pertanyaan::create([
            "teks_pertanyaan" => "Lorem Ipsum Dolor Sit Amet 5 ?",
            "bobot" => 60
        ]);
    }
}
