<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualanReturTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualan_retur', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->string('active_cash');
            $table->string('jenis_retur');
            $table->foreignId('customer_id')
                ->nullable()
                ->constrained('customer')
                ->nullOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('gudang_id')
                ->nullable()
                ->constrained('gudang')
                ->nullOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->date('tgl_nota');
            $table->date('tgl_tempo')->nullable();
            $table->string('status_bayar');
            $table->bigInteger('total_barang')->nullable();
            $table->bigInteger('ppn')->nullable();
            $table->bigInteger('biaya_lain')->nullable();
            $table->bigInteger('total_bayar');
            $table->text('keterangan')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('penjualan_retur');
    }
}
