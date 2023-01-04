<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasien', function (Blueprint $table) {
            $table->string("kode_pasien", 50)->primary();
            $table->bigInteger("no_ktp");
            $table->date("tanggal_lahir");
            $table->string("pekerjaan");
            $table->timestamp("tanggal_daftar");
            $table->integer("user_id");
            $table->bigInteger("nomor_hp");
            $table->string("nama_suami");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pasien');
    }
};
