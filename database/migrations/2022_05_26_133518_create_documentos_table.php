<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("compra_id")->default(0);
            $table->unsignedBigInteger("gasto_id")->default(0);
            $table->unsignedBigInteger("liquidacion_id")->default(0);
            $table->unsignedBigInteger("venta_id")->default(0);
            $table->unsignedBigInteger("proforma_id")->default(0);
            $table->unsignedBigInteger("notacredito_id")->default(0);
            $table->unsignedBigInteger("retenciones_id")->default(0);
            $table->unsignedBigInteger("notadebito_id")->default(0);

            $table->enum("ambiente",[1,2])->default(1);
            $table->unsignedTinyInteger("tipoEmision")->default(1);
            $table->char("razonSocial",255);
            $table->char("nombreComercial",255)->nullable();
            $table->char("ruc",13); 
            $table->char("claveAcceso",49);
            $table->char("codDoc",2);
            $table->char("estab",3);
            $table->char("ptoEmi",3);
            $table->char("secuencial",9);
            $table->char("dirMatriz",255);
            $table->char("regimenMicroempresas",35)->nullable();
            $table->char("agenteRetencion",8)->nullable();

            $table->date("fecha_emision")->nullable();

            $table->double('subtotal_cero')->nullable();
            $table->double('subtotal_sin_impuestos')->nullable();
            $table->double('subtotal_iva')->nullable();
            $table->double('subtotal_otros')->nullable();
            $table->double('subtotal')->nullable();
            $table->double('descuento')->nullable();
            $table->double('propina')->nullable();
            $table->double('total')->nullable();

            $table->text("xml")->nullable();
            $table->text("xml_firmado")->nullable();
            $table->text("json")->nullable();
            $table->enum("estado",['AUTORIZADO','RECIBIDO','PENDIENTE','RECHAZADO'])->nullable();
            $table->text("estado_documento")->nullable();
            

            $table->enum("correo_enviado",['ENVIADO','PENDIENTE'])->nullable();
            $table->longText("accionista")->nullable();
            
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
        Schema::dropIfExists('documentos');
    }
}
