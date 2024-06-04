<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kost', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_pemilik');
            $table->bigInteger('jenis_kost_id');
            $table->string('nama_kost');
            $table->integer('jumlah_kamar');
            $table->text('fasilitas_kost');
            $table->text('keterangan');
            $table->string('luas');
            $table->string('lokasi');
            $table->string('lat');
            $table->string('long');
            $table->string('alamat')->nullable();
            $table->bigInteger('tarif_perbulan');
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
        Schema::dropIfExists('kost');
    }
}
