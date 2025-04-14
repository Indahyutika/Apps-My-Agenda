<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyagendaAgendadetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('myagenda_agendadetail', function (Blueprint $table) {
            $table->increments('myagenda_agendadetail_id');
            $table->unsignedInteger('myagenda_agendadetail_agenda_id');
            $table->string('myagenda_agendadetail_kegiatan');
            $table->date('myagenda_agendadetail_tgl_awal');
            $table->date('myagenda_agendadetail_tgl_akhir');
            $table->string('myagenda_agendadetail_jumlah_hari');
            $table->string('myagenda_agendadetail_deskripsi');
            $table->string('myagenda_agendadetail_pic');
            $table->string('myagenda_agendadetail_email_pic');
            $table->string('myagenda_agendadetail_status')->nullable();
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
        Schema::dropIfExists('myagenda_agendadetail');
    }
}
