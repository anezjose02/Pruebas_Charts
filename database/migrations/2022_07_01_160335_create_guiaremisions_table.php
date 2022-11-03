<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuiaremisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guiaremisions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("factura_id")->default(0);
            $table->unsignedBigInteger("transportista_id")->default(0);
            $table->unsignedBigInteger("punto_id")->default(0);
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
            
            $table->char("dirEstablecimiento",255);
            $table->char("dirMatriz",255);
            $table->date("fecha_emision")->nullable();
            $table->char("dirPartida",255)->nullable();
            $table->char("razonSocialTransportista",255)->nullable();
            $table->char("tipoIdentificacionTransportista",2)->nullable();
            $table->char("rucTransportista",13)->nullable();
            $table->char("rise",48)->nullable();
            $table->char("fechaIniTransporte",10)->nullable();
            $table->char("fechaFinTransporte",10)->nullable();

            $table->date("fecha_inicio_transporte")->nullable();
            $table->date("fecha_fin_transporte")->nullable();

            $table->char("placa",20)->nullable();

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
        Schema::dropIfExists('guiaremisions');
    }
}
