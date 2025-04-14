<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyagendaUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('myagenda_user', function (Blueprint $table) {
            $table->increments('myagenda_user_id');
            $table->string('myagenda_user_nama');
            $table->string('myagenda_user_email');
            $table->string('myagenda_user_password');
            $table->enum('myagenda_user_role', ['admin', 'pengguna'])->default('pengguna');
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
        Schema::dropIfExists('myagenda_user');
    }
}
