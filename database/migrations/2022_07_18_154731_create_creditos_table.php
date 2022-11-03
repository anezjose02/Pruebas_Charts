<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('creditos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("cliente_id")->default(0);
            $table->unsignedBigInteger("proveedor_id")->default(0);

            $table->text("cuotas")->nullable();
            $table->text("pagos")->nullable();

            $table->unsignedBigInteger("n_cuotas")->default(1);

            $table->double("saldo")->default(0);
            $table->double("total")->default(0);

            $table->date("fecha_inicio")->nullable();
            $table->enum("frecuencia",['SEMANAL','BISEMANAL','MENSUAL','BIMESTRAL','TRIMESTRAL','SEMESTRAL','ANUAL',''])->nullable();
            $table->double("porcentaje_mora")->default(0);
            $table->double("total_mora")->default(0);
            $table->unsignedBigInteger("dias_premora")->default(0);

            
            $table->double("interes")->default(0);
            $table->double("interes_total")->default(0);
            $table->double("recaudado")->default(0);

            $table->enum("tipo_interes",['SIMPLE','AMORTIZACION'])->default('SIMPLE');

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
        Schema::dropIfExists('creditos');
    }
}
