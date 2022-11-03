<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransportistasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transportistas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("empresa_id")->default(0);

            $table->char("identificacion",32)->unique();
            $table->char("identificacion_tipo",32)->default('RUC');
            $table->char("razonsocial",128)->nullable();
            
            $table->char("direccion",255)->nullable();

            $table->char("telefono",32)->nullable();
            $table->char("email",32)->nullable();
            $table->char("NOMBRE_COMERCIAL",128)->nullable();

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
        Schema::dropIfExists('transportistas');
    }
}
