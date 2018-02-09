<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMahasiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->increments('nim');
            $table->string('nama',50);
            $table->string('alamat',50);
            $table->string('no_telp',20);
            $table->date('tanggal_lahir');
            $table->integer('id_jurusan')->unsigned();
            $table->foreign('id_jurusan')->references('id')->on('jurusans');
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
        Schema::dropIfExists('mahasiswas');
    }
}
