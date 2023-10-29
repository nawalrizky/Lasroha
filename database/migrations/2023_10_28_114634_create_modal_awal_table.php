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
        Schema::create('modal_awal', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->integer('kas');
            $table->integer('inventaris');
            $table->integer('persediaan_barang_dagangan');
            $table->integer('perlengkapan_toko');
            $table->integer('kendaraan');
            $table->integer('total');
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
        Schema::dropIfExists('modal_awal');
    }
};
