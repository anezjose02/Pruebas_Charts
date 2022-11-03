<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger("admin_id")->default(0);
            $table->boolean("superuser")->default(0);
            $table->boolean("activo")->default(1);
            $table->char("sistema",128)->nullable();
            $table->char("rol",128)->nullable();
            $table->char("en_empresas",255)->nullable();
            $table->char("en_sucursales",255)->nullable();
            $table->char("en_puntos",255)->nullable();
            $table->char("en_cajas",255)->nullable();
            $table->char("en_almacenes",255)->nullable();
            $table->text("modulos")->nullable();
            $table->text("permisos")->nullable();
            $table->enum("licencia",['MENSUAL','ANUAL','PERMANENTE'])->default('MENSUAL');
            $table->date("proximo_corte")->nullable();
            $table->unsignedInteger("limite_facturas")->default(0);
            $table->unsignedInteger("max_empresas")->default(0);
            $table->unsignedInteger("max_sucursales")->default(0);
            $table->unsignedInteger("max_usuarios")->default(0);
            $table->unsignedInteger("max_puntos")->default(0);
            $table->text("tema_sistema")->nullable();
            $table->double("precio_sistema")->default(0);
            $table->text("configuracion_sistema")->nullable();

            // colores tema usuario
            $table->text("tema_seleccionado")->nullable();
            $table->text("boton_primario")->nullable();
            $table->text("boton_secundario")->nullable();
            $table->text("color_secciones")->nullable();
            $table->text("barra_lateral")->nullable();

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
