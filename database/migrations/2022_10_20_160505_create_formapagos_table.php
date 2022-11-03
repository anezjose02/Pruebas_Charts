<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormapagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formapagos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("documento_id");
            $table->string("valor");
            $table->string("tipo");
            $table->string("forma");
            $table->enum("metodo",['Tarjeta','Banco','Otro'])->default('Otro');
            $table->string("fecha_emision")->nullable();
            $table->string("fecha_cobro")->nullable();
            $table->string("tarjeta")->nullable();
            $table->string("nro_tarjeta")->nullable();
            $table->string("fecha")->nullable();
            $table->string("banco")->nullable();
            $table->string("nro_cuenta")->nullable();
            $table->string("nro_documento")->nullable();
            $table->string("descripcion_documento")->nullable();

            $table->string("interes_mora")->nullable();
            $table->string("dias_mora")->nullable();
            $table->string("cuotas")->nullable();
            $table->string("credito_existente_o_nuevo")->nullable();

            $table->string("dias_premora")->nullable();
            $table->string("fecha_inicio")->nullable();
            $table->string("frecuencia")->nullable();
            $table->string("interes")->nullable();
            $table->string("n_cuotas")->nullable();
            $table->string("porcentaje_mora")->nullable();
            $table->string("total")->nullable();
            $table->string("tipo_interes")->nullable();


            $table->unsignedBigInteger('credito_id')->nullable();
            $table->foreign('credito_id')->references('id')->on('creditos')->nullable();

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
        Schema::dropIfExists('formapagos');
    }
}
