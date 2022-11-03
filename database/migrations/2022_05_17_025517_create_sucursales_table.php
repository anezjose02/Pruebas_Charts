<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSucursalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sucursales', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("user_id");

            $table->unsignedBigInteger('empresa_id')->constrained('empresa')->onDelete('cascade');

            $table->char("estab",3);
            
            $table->char("direccion",255)->nullable();
            $table->char("email",64)->nullable();
            $table->char("celular",64)->nullable();
            $table->char("telefono",64)->nullable();
            $table->char("web",64)->nullable();

            $table->boolean("aplicaservicios")->default(0);

            $table->text("facturas1")->nullable();
            $table->text("facturas2")->nullable();
            $table->text("proformas1")->nullable();
            $table->text("proformas2")->nullable();
            
            $table->char("secuencialproforma",9);

            
            $table->char("logofactura",255)->nullable();
            $table->char("logoproforma",255)->nullable();
            $table->char("logomarcaagua",255)->nullable();
            $table->char("logocontrato",255)->nullable();

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
        Schema::dropIfExists('sucursales');
    }
}
