<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembelianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelian', function (Blueprint $table) {
            $table->id();
            $table->string('no_po')->unique();
            $table->string('no_do', 50)->nullable();
            $table->integer('vendor_id');
            $table->integer('warehouse_id');
            $table->double('total');
            $table->datetime('tgl_minta');
            $table->string('status', 10);
            $table->integer('approver')->nullable();
            $table->datetime('tgl_kirim')->nullable();
            $table->datetime('tgl_approve')->nullable();
            $table->timestamps();
        });

        Schema::create('detail_pembelian', function (Blueprint $table) {
            $table->id();
            $table->string('no_po');
            $table->foreign('no_po')->references('no_po')->on('pembelian')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('warehouse_id');
            $table->double('qty');
            $table->double('harga_satuan');
            $table->double('sub_total');
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
        Schema::dropIfExists('pembelian');
    }
}
