<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailCustomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_customs', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('kategori')->nullable();
            $table->foreign('kategori')->references('id')->on('categories');
            $table->unsignedBigInteger('material')->nullable();
            $table->foreign('material')->references('id')->on('material');
            $table->integer('tebal');
            $table->integer('lebar');
            $table->integer('panjang');
            $table->integer('jumlah_pesanan_cus')->nullable();
            $table->integer('harga_cus')->nullable();
            $table->integer('custom_id');
           
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
        Schema::dropIfExists('detail_customs');
    }
}
