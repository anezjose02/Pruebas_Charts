<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->id();

            $table->char("identificacion",32)->unique();
            $table->char("razonsocial",128)->nullable();
            $table->char("tipo",16)->nullable();
            $table->char("sexo",16)->nullable();
            $table->char("estadocivil",32)->nullable();
            $table->char("fechanacimiento",10)->nullable();
            $table->date("fecha_nacimiento")->nullable();
            $table->char("nacionalidad",32)->nullable();
            $table->char("ciudad",255)->nullable();
            $table->char("direccion",255)->nullable();
            $table->char("nrocalle",32)->nullable();
            $table->char("estadoContribuyente",32)->nullable();
            
            $table->char("telefono",32)->nullable();
            $table->char("celular",32)->nullable();
            $table->char("email",32)->nullable();

            $table->date("fecha")->nullable();
            $table->char("NUMERO_RUC",16)->nullable();
            $table->char("RAZON_SOCIAL",128)->nullable();
            $table->char("NOMBRE_COMERCIAL",128)->nullable();
            $table->char("ESTADO_CONTRIBUYENTE",32)->nullable();
            $table->char("CLASE_CONTRIBUYENTE",32)->nullable();
            $table->char("FECHA_INICIO_ACTIVIDADES",10)->nullable();
            $table->char("FECHA_ACTUALIZACION",10)->nullable();
            $table->date("fechan_inicio_actividades")->nullable();
            $table->date("fechan_actualizacion")->nullable();
            $table->char("FECHA_SUSPENSION_DEFINITIVA",10)->nullable();
            $table->char("FECHA_REINICIO_ACTIVIDADES",10)->nullable();
            $table->date("fechan_suspension_definitiva")->nullable();
            $table->date("fechan_reinicio_actividades")->nullable();
            $table->char("OBLIGADO",32)->nullable();
            $table->char("TIPO_CONTRIBUYENTE",64)->nullable();
            $table->char("NUMERO_ESTABLECIMIENTO",32)->nullable();
            $table->char("NOMBRE_FANTASIA_COMERCIAL",128)->nullable();
            $table->char("CALLE",64)->nullable();
            $table->char("INTERSECCION",64)->nullable();
            $table->char("ESTADO_ESTABLECIMIENTO",32)->nullable();
            $table->char("DESCRIPCION_PROVINCIA",32)->nullable();
            $table->char("DESCRIPCION_CANTON",32)->nullable();
            $table->char("DESCRIPCION_PARROQUIA",32)->nullable();
            $table->char("CODIGO_CIIU",32)->nullable();
            $table->text("ACTIVIDAD_ECONOMICA")->nullable();

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
        Schema::dropIfExists('personas');
    }
}
