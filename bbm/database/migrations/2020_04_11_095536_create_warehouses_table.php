<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarehousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouses', function (Blueprint $table) {
            $table->id();
            $table->string('kode_warehouse')->unique()->index();
            $table->string('nama_warehouse');
            $table->string('kode_cabang');
            $table->foreign('kode_cabang')->references('kode_cabang')->on('branchs')->onUpdate('cascade')->onDelete('cascade');
            $table->double('longitude_warehouse');
            $table->double('latitude_warehouse');
            $table->string('alamat_warehouse');
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
        Schema::dropIfExists('warehouses');
    }
}
