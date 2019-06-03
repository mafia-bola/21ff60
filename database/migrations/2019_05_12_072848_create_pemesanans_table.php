<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePemesanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('pengunjung_id')->unsigned();
            $table->bigInteger('kecak_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->date('tanggal_pesan');
            $table->bigInteger('jumlah');
            $table->bigInteger('harga');
            $table->bigInteger('total');
            $table->string('bukti_transfer');
            $table->string('no_rekening');
            $table->string('nama_bank');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('pengunjung_id')->references('id')->on('pengunjung');
            $table->foreign('kecak_id')->references('id')->on('kecak');
            $table->foreign('user_id')->references('id')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pemesanan');
    }
}
