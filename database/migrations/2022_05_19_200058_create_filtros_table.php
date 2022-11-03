<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFiltrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() 
    {
        Schema::create('filtros', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("user_id");

            $table->enum("tipo",['Clasificación','Categoría','Tipo de producto'])->default("Clasificación");
            $table->char("nombre",128);
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
        Schema::dropIfExists('filtros');
    }
}
