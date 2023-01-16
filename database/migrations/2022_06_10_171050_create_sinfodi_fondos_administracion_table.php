<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSinfodiFondosAdministracionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sinfodi_fondos_administracion', function (Blueprint $table) {
            $table->id();
            $table->string('direccion');
            $table->integer('id_direccion');
            $table->decimal('facturacion', 13, 2);
            $table->decimal('contribucion', 4, 2);
            $table->integer('personas_direccion');
            $table->decimal('fondos_admin', 13, 2);
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
        Schema::dropIfExists('sinfodi_fondos_administracion');
    }
}
