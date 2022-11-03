<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asientos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("sucursales_id")->default(0);

            $table->double("total_debito")->default(0);
            $table->double("total_credito")->default(0);

            $table->double("monto")->default(0);

            $table->date("fecha")->nullable();
            $table->unsignedBigInteger("tipo")->default(0);
            $table->unsignedBigInteger("numero")->default(0);
            $table->char("referencia",32)->nullable();
            $table->char("centro_costo",128)->nullable();


            $table->text("cuentas")->nullable();
            $table->text("descripcion")->nullable();
            
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
        Schema::dropIfExists('asientos');
    }
}
