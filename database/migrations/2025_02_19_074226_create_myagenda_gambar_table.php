<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyagendaGambarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('myagenda_gambar', function (Blueprint $table) {
            $table->increments('myagenda_gambar_id');
            $table->unsignedInteger('myagenda_gambar_sekolah_id');
            $table->string('myagenda_gambar_media');
            $table->date('myagenda_gambar_tanggal');
            $table->string('myagenda_gambar_deskripsi');
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
        Schema::dropIfExists('myagenda_gambar');
    }
}
