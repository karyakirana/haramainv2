<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeKasirPembelianDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kasir_pembelian_detail', function (Blueprint $table) {
            $table->renameColumn('kasir_penjualan_id', 'kasir_pembelian_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kasir_pembelian_detail', function (Blueprint $table) {
            $table->renameColumn('kasir_pembelian_id', 'kasir_penjualan_id');
        });
    }
}
