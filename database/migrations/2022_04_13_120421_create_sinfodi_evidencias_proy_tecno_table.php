<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSinfodiEvidenciasProyTecnoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sinfodi_evidencias_proy_tecno', function (Blueprint $table) {
            $table->id();
            $table->integer('clave');
            $table->string('evidencias');
            $table->integer('puntos');
            $table->integer('total_puntos');
            $table->integer('id_criterio');
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
        Schema::dropIfExists('sinfodi_evidencias_proy_tecno');
    }
}
