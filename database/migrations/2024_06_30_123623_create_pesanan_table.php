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
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user');
            $table->foreignId('id_seller');
            $table->enum('jenis', ['pre-order', 'order']);
            $table->integer('jumlah');
            $table->integer('harga');
            $table->integer('total_harga');
            $table->boolean('pengantaran')->default(0)->comment('0= ambil ditempat, 1= diantar');
            $table->boolean('is_verified')->default(0);
            $table->text('keterangan')->nullable();
            $table->string('nomor_penerima')->nullable();
            $table->text('alamat_pengantaran')->nullable();
            $table->boolean('send_wa')->default(0);
            $table->boolean('lunas')->default(0);
            $table->boolean('diantar')->default(0);
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users');
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
        Schema::dropIfExists('pesanan');
    }
};
