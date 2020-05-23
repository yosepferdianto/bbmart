<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGudangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gudang', function (Blueprint $table) {
            $table->id();
            $table->string('kode_gudang')->unique();
            $table->string('nama_gudang');
            $table->string('kode_warehouse');
            $table->foreign('kode_warehouse')->references('kode_warehouse')->on('warehouses')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('jenis_gudang');
            $table->double('min_stok');
            $table->double('kapasitas_gudang');
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
        Schema::dropIfExists('gudang');
    }
}
