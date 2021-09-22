<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSinfodiEvidenciasGeneralTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sinfodi_evidencias_general', function (Blueprint $table) {
            $table->id();
            $table->integer('clave');
            $table->string('clave_evidencia');
            $table->integer('puntos');
            $table->integer('total_puntos');
            $table->year('year');
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
        Schema::dropIfExists('sinfodi_evidencias_general');
    }
}
