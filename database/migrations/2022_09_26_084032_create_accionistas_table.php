<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccionistasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accionistas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("admin_id")->nullable();
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("caja_id")->nullable();
            $table->unsignedBigInteger("caja_compensacion_id")->nullable();

            
            $table->unsignedBigInteger("empresa_id")->nullable();

            $table->char("razonsocial",128)->nullable();
            $table->char("nombrecomercial",128)->nullable();

            

            $table->char("identificacion",32)->nullable();
            $table->char("identificacion_tipo",32)->nullable();
            $table->char("numero_ruc",13)->nullable();
            $table->char("cedula",10)->nullable();

            $table->char("ciudad",255)->nullable();
            $table->char("direccion",255)->nullable();
            $table->char("comentario",255)->nullable();
            
            $table->char("celular",32)->nullable();
            $table->char("telefono",32)->nullable();
            $table->char("email",32)->nullable();

            $table->boolean("activo");

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
        Schema::dropIfExists('accionistas');
    }
}
