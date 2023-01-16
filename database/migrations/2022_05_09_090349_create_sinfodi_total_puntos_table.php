<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSinfodiTotalPuntosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sinfodi_total_puntos', function (Blueprint $table) {
            $table->id();
            $table->decimal('importe', 13, 2);
            $table->integer('porcentaje_importe');
            $table->decimal('importe_act_individual', 13, 2);
            $table->integer('porcentaje_act_individual');
            $table->decimal('importe_facturacion', 13, 2);
            $table->integer('porcentaje_facturacion');
            $table->decimal('importe_fondos_admin', 13, 2);
            $table->integer('porcentaje_fondos_admin');
            $table->decimal('importe_responsabilidad', 13, 2);
            $table->integer('porcentaje_responsabilidad');
            $table->integer('total_puntos_responsabilidad');
            $table->decimal('valor_punto_responsabilidad', 13, 2);
            $table->decimal('total_puntos_actividades', 13, 2);
            $table->decimal('cantidad', 13, 2);
            $table->decimal('valor_punto_actividades', 13, 2);
            $table->year('year');
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
        Schema::dropIfExists('sinfodi_total_puntos');
    }
}
