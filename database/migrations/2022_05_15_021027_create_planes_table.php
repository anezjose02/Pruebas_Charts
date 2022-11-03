<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planes', function (Blueprint $table) {
            $table->id();

            $table->char("nombre",64)->unique();
            $table->enum("licencia",['MENSUAL','ANUAL','PERMANENTE'])->default('MENSUAL');
            $table->text("modulos")->nullable();
            $table->double("precio")->default(0);
            $table->unsignedInteger("limite_facturas")->default(0);
            $table->unsignedInteger("max_empresas")->default(0);
            $table->unsignedInteger("max_sucursales")->default(0);
            $table->unsignedInteger("max_usuarios")->default(0);
            $table->unsignedInteger("max_puntos")->default(0);
            $table->unsignedInteger("max_cajas")->default(0);

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
        Schema::dropIfExists('planes');
    }
}
