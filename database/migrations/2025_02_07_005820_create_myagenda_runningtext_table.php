<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyagendaRunningtextTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('myagenda_runningtext', function (Blueprint $table) {
            $table->increments('myagenda_runningtext_id');
            $table->unsignedInteger('myagenda_runningtext_sekolah_id');
            $table->string('myagenda_runningtext_judul', 150);
            $table->string('myagenda_runningtext_konten');
            $table->date('myagenda_runningtext_tgl_mulai');
            $table->date('myagenda_runningtext_tgl_akhir');
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
        Schema::dropIfExists('myagenda_runningtext');
    }
}
