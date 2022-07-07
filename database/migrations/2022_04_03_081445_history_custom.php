<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HistoryCustom extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_custom', function (Blueprint $table) {
            $table->id();
            $table->string('status_cus')->default(0);
            $table->integer('ongkir_cus');
            $table->integer('total_harga_cus');
            $table->integer('tebal');
            $table->integer('lebar');
            $table->integer('panjang');
            $table->integer('jumlah_pesanan_cus');
            $table->timestamp('tanggal_transaksi_cus');
            $table->string('alat_angkut_cus')->nullable();
            $table->string('ket_cus')->nullable();
            $table->unsignedBigInteger('id_kategori')->nullable();
            $table->foreign('id_kategori')->references('id')->on('categories');
            $table->unsignedBigInteger('id_material')->nullable();
            $table->foreign('id_material')->references('id')->on('categories');
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
        //
    }
}
