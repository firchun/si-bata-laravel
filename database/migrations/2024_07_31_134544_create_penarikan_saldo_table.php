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
        Schema::create('penarikan_saldo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_seller');
            $table->string('jumlah');
            $table->boolean('is_verified');
            $table->boolean('is_send');
            $table->timestamps();

            $table->foreign('id_seller')->references('id')->on('seller');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penarikan_saldo');
    }
};