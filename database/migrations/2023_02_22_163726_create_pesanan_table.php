<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_penghuni');
            $table->bigInteger('id_kost');
            $table->string('kode_trx');
            $table->dateTime('tgl_mulai');
            $table->dateTime('tgl_selesai');
            $table->bigInteger('jml_bulan');
            $table->bigInteger('nominal');
            $table->string('status');
            $table->string('via_bayar');
            $table->string('snap_token')->nullable();
            $table->string('bukti_bayar')->nullable();
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
        Schema::dropIfExists('pesanan');
    }
}
