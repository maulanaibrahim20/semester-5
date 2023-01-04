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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string("nama", 100);
            $table->string("username", 50)->unique();
            $table->string("email", 50)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 70);
            $table->text("alamat")->nullable();
            $table->integer("umur");
            $table->integer("role_id");
            $table->string("kecamatan")->nullable();
            $table->string("kelurahan")->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
