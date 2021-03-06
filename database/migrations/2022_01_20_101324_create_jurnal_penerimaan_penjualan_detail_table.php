<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJurnalPenerimaanPenjualanDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jurnal_penerimaan_penjualan_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jurnal_penerimaan_penjualan_id');
            $table->unsignedBigInteger('penjualan_id');
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
        Schema::dropIfExists('jurnal_penerimaan_penjualan_detail');
    }
}
