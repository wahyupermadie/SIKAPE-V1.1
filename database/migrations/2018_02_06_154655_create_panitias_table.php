<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreatePanitiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('panitias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_kegiatan')->unsigned();
            $table->integer('nim')->unsigned();
            $table->foreign('nim')->references('nim')->on('mahasiswas');
            $table->foreign('id_kegiatan')->references('id')->on('kegiatans');
            $table->integer('point');
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
        Schema::dropIfExists('panitias');
    }
}