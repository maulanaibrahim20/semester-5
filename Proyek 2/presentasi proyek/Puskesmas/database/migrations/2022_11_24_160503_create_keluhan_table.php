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
        Schema::create('keluhan', function (Blueprint $table) {
            $table->id();
            $table->string("no_regis", 50)->unique();
            $table->string("kode_pasien", 50);
            $table->tinyInteger("kehamilan_ke");
            $table->text("keluhan_pasien");
            $table->tinyInteger("bidan_id");
            $table->text("solusi_bidan");
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
        Schema::dropIfExists('keluhan');
    }
};
