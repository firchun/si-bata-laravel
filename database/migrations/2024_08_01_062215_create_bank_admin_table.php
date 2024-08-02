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
        Schema::create('bank_admin', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_bank');
            $table->string('nama');
            $table->string('no_rek');
            $table->boolean('is_active')->default(1);
            $table->timestamps();

            $table->foreign('id_bank')->references('id')->on('bank');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bank_admin');
    }
};
