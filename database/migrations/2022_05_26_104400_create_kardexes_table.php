<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKardexesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kardexes', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("user_id");

            $table->enum("tipo",['ENTRADA','SALIDA'])->default('ENTRADA');

            $table->char("documento",64)->nullable();

            $table->char("tipo_documento")->nullable();

            $table->double("cantidad")->default(0);
            $table->double("stock_actual")->default(0);
            $table->double("stock_anterior")->default(0);
            $table->double("precio_compra_unitario")->default(0);
            $table->double("precio_compra_total")->default(0);
            $table->double("precio_venta_unitario")->default(0);
            $table->double("precio_venta_total")->default(0);

            $table->char("almacen",128)->nullable();
            $table->string("producto",300)->nullable();
            $table->char("codigo",128)->nullable();
            
            $table->char("unidad_calculo",128)->nullable();
            
            $table->char("unidad_movimiento",128)->nullable();
            
            $table->char("usuario",255)->nullable();

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
        Schema::dropIfExists('kardexes');
    }
}
