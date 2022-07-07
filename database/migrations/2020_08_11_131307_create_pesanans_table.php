<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pemesanan')->nullable();
            $table->string('status')->default(0);
            $table->integer('ongkir');
            $table->integer('total_harga');
            $table->timestamp('tanggal_transaksi');
            $table->string('alat_angkut')->nullable();
            $table->string('ket')->nullable();
            $table->integer('user_id');
            $table->text('kode_midtrans')->nullable();
            $table->text('uniqode')->nullable();
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
        Schema::dropIfExists('pesanans');
    }
}
