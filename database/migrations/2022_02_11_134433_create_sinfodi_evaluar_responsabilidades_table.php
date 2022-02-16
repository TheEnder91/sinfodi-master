<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSinfodiEvaluarResponsabilidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sinfodi_evaluar_responsabilidades', function (Blueprint $table) {
            $table->id();
            $table->integer('clave');
            $table->string('nombre');
            $table->string('direccion');
            $table->string('responsabilidad');
            $table->integer('puntos');
            $table->year('year');
            $table->string('username');
            $table->integer('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sinfodi_evaluar_responsabilidades');
    }
}
