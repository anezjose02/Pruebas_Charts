<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotadebitosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notadebitos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("notadebito_id")->default(0);
            $table->unsignedBigInteger("cliente_id")->default(0);
            $table->unsignedBigInteger("proveedor_id")->default(0);
            $table->unsignedBigInteger("caja_id")->default(0);
            $table->unsignedBigInteger("almacen_id")->default(0);
            $table->unsignedBigInteger("venta_id")->default(0);
            $table->unsignedBigInteger("compra_id")->default(0);
            $table->unsignedBigInteger("sucursales_id")->default(0);
            $table->unsignedBigInteger("centrocosto_id")->default(0);

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
            $table->double('subtotal_cero')->nullable();
            $table->double('subtotal_sin_impuestos')->nullable();
            $table->double('subtotal_iva')->nullable();
            $table->double('descuento')->nullable();
            $table->double('propina')->nullable();
            $table->double('total')->nullable();
            $table->char("rise",128)->nullable();
            $table->char("codDocModificado",16)->nullable();
            $table->char("numDocModificado",17)->nullable();
            $table->char("fechaEmisionDocSustento",10)->nullable();
            $table->double("valorModificacion")->default(0);
            $table->date("fecha_emision_doc_sustento")->nullable();

            $table->char("motivo",255)->nullable();

            
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
        Schema::dropIfExists('notadebitos');
    }
}
