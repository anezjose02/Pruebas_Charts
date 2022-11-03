<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturascompensacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturascompensacions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("sistema_id")->nullable();
            $table->unsignedBigInteger("empresa_id")->nullable();
            $table->enum("frecuencia_emision",["Diario", "Semanal", "Quincenal", "Mensual"])->nullable();
            $table->enum("modalidad_emision",["Individual", "Acumulativo"])->nullable();
            
            $table->enum("proceso",['Manual','Automatico'])->nullable();
            $table->string("dia")->nullable();
            $table->string("hora")->nullable();
            $table->string("sistema_horario")->nullable();
            $table->string("fecha")->nullable();
            $table->string("fecha2")->nullable();
            
            $table->enum("retencion_automatica",['Si','No'])->nullable();
            $table->unsignedBigInteger("concepto_id")->nullable(); /* codigo de retención*/ 
            // Diario  - hora
            // Semanal - dia  hora
            // Quincenal - fecha inicio
            // Mensual -  dia del mes en numero 1 a 31 los meses q no tengan 31 se evaluan para q sea el ultimo
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
        Schema::dropIfExists('facturascompensacions');
    }
}
