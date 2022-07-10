<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pemesanan');
            $table->string('uniqode');
            $table->string('kode_midtrans');
            $table->string('status')->default(0);
            $table->integer('ongkir');
            $table->integer('total_harga');
            $table->integer('jumlah_pesanan');
            $table->timestamp('tanggal_transaksi');
            $table->string('alat_angkut')->nullable();
            $table->string('ket')->nullable();
            $table->integer('product_id');
            $table->integer('user_id');
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
        Schema::dropIfExists('histories');
    }
}
