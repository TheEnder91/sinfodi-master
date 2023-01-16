<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSinfodiEvaluadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sinfodi_evaluados', function (Blueprint $table) {
            $table->id();
            $table->integer('clave');
            $table->string('nombre');
            $table->string('usuario');
            $table->string('categoria');
            $table->string('unidad_admin');
            $table->string('puesto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sinfodi_evaluados');
    }
}
