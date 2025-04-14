<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyagendaAgendaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('myagenda_agenda', function (Blueprint $table) {
            $table->increments('myagenda_agenda_id');
            $table->unsignedInteger('myagenda_agenda_sekolah_id');
            $table->string('myagenda_agenda_judul');
            $table->date('myagenda_agenda_tanggal');
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
        Schema::dropIfExists('myagenda_agenda');
    }
}
