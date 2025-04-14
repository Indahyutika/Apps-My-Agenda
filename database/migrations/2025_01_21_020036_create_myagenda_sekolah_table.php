<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyagendaSekolahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('myagenda_sekolah', function (Blueprint $table) {
            $table->increments('myagenda_sekolah_id');
            $table->unsignedInteger('myagenda_sekolah_user_id')->nullable();
            $table->string('myagenda_sekolah_logo');
            $table->string('myagenda_sekolah_nama');
            $table->string('myagenda_sekolah_email');
            $table->string('myagenda_sekolah_akreditasi');
            $table->string('myagenda_sekolah_tlp');
            $table->char('myagenda_sekolah_provinsi', 2);
            $table->char('myagenda_sekolah_kab_kota', 4);
            $table->char('myagenda_sekolah_kec', 7);
            $table->char('myagenda_sekolah_kel', 10);
            $table->char('myagenda_sekolah_kodepos', 5);
            $table->text('myagenda_sekolah_alamat');
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
        Schema::dropIfExists('myagenda_sekolah');
    }
}
