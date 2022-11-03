<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCajasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cajas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("user_id");
            $table->foreignId("empresa_id")->constrained('empresas')->onDelete('cascade');
            $table->foreignId('sucursales_id')->constrained('sucursales')->onDelete('cascade');
            $table->foreignId("punto_id")->constrained('puntos')->onDelete('cascade');

            $table->char("nombre",64);
            $table->enum("ambiente",[1,2])->default(1);

            $table->boolean("facturafisica")->default(0);
            $table->boolean("envioautomatico")->default(0);
            $table->boolean("efectivo")->default(0);
            $table->enum("estado",['CERRADA','ABIERTA'])->default('CERRADA');
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
        Schema::dropIfExists('cajas');
    }
}
