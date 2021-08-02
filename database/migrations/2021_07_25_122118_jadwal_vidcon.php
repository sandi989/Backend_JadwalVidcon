<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class JadwalVidcon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwalVidcon', function (Blueprint $table) {
            $table->id();
            $table->string('kondisi');
            $table->string('hari');
            $table->date('tanggal');
            $table->string('jenis_bantuan');
            $table->string('lokasi');
            $table->time('waktu');
            $table->string('acara');
            $table->string('penyelenggara');
            $table->string('petugas');
            $table->string('no_surat');
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
        Schema::dropIfExists('jadwalVidcon');
    }
}
