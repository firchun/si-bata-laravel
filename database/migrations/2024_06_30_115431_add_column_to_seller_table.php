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
        Schema::table('seller', function (Blueprint $table) {
            $table->boolean('ambil_ditempat')->default(0)->comment('0 = non aktif,1=aktif')->after('pengantaran');
            $table->boolean('pre_order')->default(0)->comment('0 = non aktif,1=aktif')->after('ambil_ditempat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('seller', function (Blueprint $table) {
            //
        });
    }
};
