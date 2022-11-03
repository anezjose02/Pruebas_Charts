<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRetencionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retenciones', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("retenciones_id")->default(0);
            $table->unsignedBigInteger("venta_id")->default(0);
            $table->unsignedBigInteger("compra_id")->default(0);
            $table->unsignedBigInteger("caja_id")->default(0);
            $table->unsignedBigInteger("empresa_id")->default(0);
            $table->unsignedBigInteger("cliente_id")->default(0);
            $table->unsignedBigInteger("proveedor_id")->default(0);

            $table->enum("ambiente",[1,2])->default(1);
            $table->char("razonSocial",255);
            $table->char("numeroDocumento",32);
            $table->char("nombreComercial",255)->nullable();
            $table->char("numeroDocumentoSustento",255)->nullable();
            $table->char("ruc",13); 
            $table->char("claveAcceso",49);
            $table->char("codDoc",2);
            $table->char("estab",3);
            $table->char("ptoEmi",3);
            $table->char("secuencial",9);
            $table->char("dirMatriz",255);
            $table->date("fecha_emision")->nullable();

            $table->char("dirEstablecimiento",255)->nullable();
            $table->char("contribuyenteEspecial",32)->nullable();
            $table->char("obligadoContabilidad",2)->nullable();
            $table->date("periodo_fiscal")->nullable();
            $table->date("fecha_emision_doc_sustento")->nullable();

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
        Schema::dropIfExists('retenciones');
    }
}
