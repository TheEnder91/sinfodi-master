<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSinfodiEvaluacionAdministracionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sinfodi_evaluacion_administracion', function (Blueprint $table) {
            $table->id();
            $table->integer('clave');
            $table->string('nombre');
            $table->integer('id_objetivo');
            $table->integer('id_criterio');
            $table->string('direccion');
            $table->integer('puntos')->nullable();
            $table->integer('total_puntos')->nullable();
            $table->year('year');
            $table->string('username');
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
        Schema::dropIfExists('sinfodi_evaluacion_administracion');
    }
}
