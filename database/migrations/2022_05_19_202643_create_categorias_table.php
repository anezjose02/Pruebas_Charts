<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("empresa_id");

            $table->enum("tipo",['General','Compra','Venta','Retenciones','Inventario','Movimientos','Consignaciones','Gastos','Notas de crèdito','Pago de compras','Pago de ventas','Impuestos','Costos','Ingresos','Producciòn','Clientes','Proveedores'])->default("General");
            $table->char("nombre",128);
            $table->char("cuenta",128);
            $table->boolean("activo")->default(1);

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
        Schema::dropIfExists('categorias');
    }
}
