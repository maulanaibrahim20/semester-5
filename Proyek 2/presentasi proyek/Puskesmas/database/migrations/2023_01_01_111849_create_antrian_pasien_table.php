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
        Schema::create('antrian_pasien', function (Blueprint $table) {
            $table->string("id_antrian", 50)->primary();
            $table->string("kode_pasien", 50);
            $table->integer("nomer_antrian");
            $table->enum("status", ["0", "1"])->default(0);
            $table->datetime("tanggal_pendaftaran");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('antrian_pasien');
    }
};
