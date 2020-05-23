<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang')->unique();
            $table->string('nama_barang');
            $table->string('kode_kategori');
            $table->foreign('kode_kategori')->references('kode_kategori')->on('categories')->onUpdate('cascade')->onDelete('cascade');
            $table->string('kode_satuan');
            $table->foreign('kode_satuan')->references('kode_satuan')->on('satuan')->onUpdate('cascade')->onDelete('cascade');
            $table->double('harga_beli')->nullable();
            $table->double('harga_jual')->nullable();
            $table->double('ppn')->nullable();
            $table->double('komisi')->nullable();
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
        Schema::dropIfExists('barang');
    }
}
