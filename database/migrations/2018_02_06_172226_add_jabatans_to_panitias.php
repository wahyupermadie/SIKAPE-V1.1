<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class AddJabatansToPanitias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('panitias', function ($table) {
            $table->integer('id_jabatan')->unsigned();
            $table->foreign('id_jabatan')->references('id')->on('jabatans');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('panitias', function($table) {
            $table->dropColumn('id_jabatan');
        });
    }
}