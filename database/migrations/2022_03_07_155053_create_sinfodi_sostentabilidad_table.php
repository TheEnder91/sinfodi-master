<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSinfodiSostentabilidadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sinfodi_sostentabilidad', function (Blueprint $table) {
            $table->id();
            $table->string('cgn');
            $table->string('nombre');
            $table->integer('clave_responsable');
            $table->string('nombre_responsable');
            $table->string('usuario_responsable');
            $table->integer('clave_participante');
            $table->string('nombre_participante');
            $table->string('usuario_participante');
            $table->string('lider_responsable');
            $table->string('participante');
            $table->float('porcentaje_participacion');
            $table->float('monto_ingresado');
            $table->float('ingreso_participacion');
            $table->string('remanente');
            $table->string('interinstitucional');
            $table->string('interareas');
            $table->float('puntos_totales');
            $table->float('puntos_lider');
            $table->float('nuevos_puntos_totales');
            $table->float('puntos_participacion');
            $table->float('total');
            $table->year('year');
            $table->string('tipo');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sinfodi_sostentabilidad');
    }
}
