<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyagendaProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('myagenda_profile', function (Blueprint $table) {
            $table->increments('myagenda_profile_id');
            $table->unsignedInteger('myagenda_profile_user_id')->nullable();
            $table->string('myagenda_profile_foto');
            $table->string('myagenda_profile_nama');
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
        Schema::dropIfExists('myagenda_profile');
    }
}
