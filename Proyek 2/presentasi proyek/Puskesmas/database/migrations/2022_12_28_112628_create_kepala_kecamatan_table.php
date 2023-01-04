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
        Schema::create('kepala_kecamatan', function (Blueprint $table) {
            $table->string("id_kepala_kecamatan", 50)->primary();
            $table->string("nik", 50);
            $table->integer("user_id");
            $table->string("nomor_hp", 30);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kepala_kecamatan');
    }
};
