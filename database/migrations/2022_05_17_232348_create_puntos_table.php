<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePuntosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puntos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("user_id");
            $table->foreignId("empresa_id")->constrained('empresas')->onDelete('cascade');
            $table->foreignId("sucursales_id")->constrained('sucursales')->onDelete('cascade');
            
            $table->char("ptoEmi",3);
            
            $table->char("secuencialfactura",9);
            $table->char("secuencialretencion",9);
            $table->char("secuencialnotacredito",9);
            $table->char("secuencialnotadebito",9);
            $table->char("secuencialguiaremision",9);
            $table->char("secuencialliquidacioncompra",9);

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
        Schema::dropIfExists('puntos');
    }
}
