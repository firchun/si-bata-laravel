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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pesanan');
            $table->foreignId('id_user');
            $table->foreignId('id_bank_admin');
            $table->string('bukti');
            $table->string('jumlah');
            $table->boolean('is_verified')->default(0);
            $table->timestamps();

            $table->foreign('id_pesanan')->references('id')->on('pesanan');
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_bank_admin')->references('id')->on('bank_admin');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembayaran');
    }
};
