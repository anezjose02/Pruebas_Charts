<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLiquidacioncomprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liquidacioncompras', function (Blueprint $table) {
            $table->id();

            

            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("liquidacion_id")->default(0);
            $table->unsignedBigInteger("proveedor_id")->default(0);
            $table->unsignedBigInteger("cliente_id")->default(0);
            $table->unsignedBigInteger("centrocosto_id")->default(0);

            $table->unsignedBigInteger("almacen_id")->default(0);
            $table->unsignedBigInteger("empresa_id")->default(0);

            $table->text("observaciones")->nullable();
            
            $table->enum("ambiente",[1,2])->default(1);
            $table->char("razonSocial",255);
            $table->char("numeroDocumento",32);
            $table->char("nombreComercial",255)->nullable();
            $table->char("ruc",13); 
            $table->char("claveAcceso",49);
            $table->char("codDoc",2);
            $table->char("estab",3);
            $table->char("ptoEmi",3);
            $table->char("secuencial",9);
            $table->char("dirMatriz",255);
            $table->date("fecha_emision")->nullable();

            $table->char("sustento_tributario",32)->nullable();
            
            $table->char("dirEstablecimiento",255)->nullable();

            
            $table->double('subtotal_cero')->nullable();
            $table->double('subtotal_sin_impuestos')->nullable();
            $table->double('subtotal_iva')->nullable();
            $table->double('descuento')->nullable();
            $table->double('total')->nullable();


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
        Schema::dropIfExists('liquidacioncompras');
    }
}
