<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("user_id");

            $table->char("ruc",13);
            $table->char("dirMatriz",255);
            $table->char("razonSocial",255);
            $table->char("nombreComercial",255)->nullable();
            $table->char("agenteRetencion",8)->nullable();

            
            $table->char("representante",255)->nullable();
            $table->char("representanteruc",13)->nullable();
            $table->char("celular",64)->nullable();
            $table->char("telefono",64)->nullable();
            $table->char("web",64)->nullable();
            $table->char("email",64)->nullable();
            
            $table->char("contribuyenteEspecial",13)->nullable();
            $table->enum("obligadoContabilidad",['SI','NO'])->nullable();
            $table->char("codigoempresa",64)->nullable();
            $table->char("codigoartesano",64)->nullable();
            
            $table->char("logo",64)->nullable();
            $table->char("firma",64)->nullable();
            $table->char("firmaclave",64)->nullable();
            $table->char("clavesri",64)->nullable();
            $table->date("firmavence")->nullable();

            $table->enum("tipocontribuyente",['Ninguno','RÉGIMEN GENERAL','CONTRIBUYENTE RÉGIMEN RIMPE','CONTRIBUYENTE RÉGIMEN MICROEMPRESAS','CONTRIBUYENTE NEGOCIO POPULAR RIMPE'])->nullable();

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
        Schema::dropIfExists('empresas');
    }
}
