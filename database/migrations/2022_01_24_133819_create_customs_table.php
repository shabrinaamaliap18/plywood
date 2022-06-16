<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customs', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('kode_pemesanan_cus')->nullable();
            $table->string('status_cus')->default(0);
            $table->string('total_harga_cus')->nullable();
            $table->timestamp('tanggal_transaksi_cus');
            $table->string('alat_angkut_cus')->nullable();
            $table->string('ket_cus')->nullable();
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
        Schema::dropIfExists('customs');
    }
}
