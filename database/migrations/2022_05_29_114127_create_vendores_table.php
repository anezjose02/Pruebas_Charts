<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendores', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("empresa_id")->default(0);

            $table->char("identificacion",32)->unique();
            $table->char("identificacion_tipo",32)->unique();
            $table->char("razonsocial",128)->nullable();

            $table->char("direccion",255)->nullable();

            $table->char("telefono",32)->nullable();
            $table->char("email",32)->nullable();

            $table->date("fecha_contratacion")->nullable();
            $table->double("comision")->default(0);

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
        Schema::dropIfExists('vendores');
    }
}
