<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("empresa_id")->default(0);
            
            $table->unsignedBigInteger("categoria_contable_id")->default(0);
            $table->unsignedBigInteger("categoria_venta_id")->default(0);
            $table->unsignedBigInteger("vendedor_id")->default(0);

            $table->char("identificacion",32)->nullable();

            $table->char("numero_ruc",13)->nullable();
            $table->char("cedula",10)->nullable();

            $table->char("identificacion_tipo",32)->nullable();
            $table->char("razonsocial",128)->nullable();

            $table->char("ciudad",255)->nullable();
            $table->char("direccion",255)->nullable();

            $table->char("telefono",32)->nullable();
            $table->char("celular",32)->nullable();
            $table->char("email",32)->nullable();
            $table->char("NOMBRE_COMERCIAL",128)->nullable();

            $table->char("referencia",64)->nullable();
            $table->char("placa",64)->nullable();


            $table->double("credito")->default(0);
            $table->text("precios")->nullable();
            $table->char("precio_defecto",255)->nullable();

            $table->boolean("parte_relacionada")->default(0);
            $table->boolean("mayorista")->default(0);

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
        Schema::dropIfExists('clientes');
    }
}
