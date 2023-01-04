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
        Schema::create('detail_keluhan', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("id_keluhan");
            $table->bigInteger("id_pertanyaan");
            $table->enum("status", ["1", "0"]);
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
        Schema::dropIfExists('detail_keluhan');
    }
};
