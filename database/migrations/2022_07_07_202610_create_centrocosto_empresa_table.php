<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCentrocostoEmpresaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centrocosto_empresa', function (Blueprint $table) {
            $table->id();

            $table->foreignId("centrocosto_id")->constrained("centrocostos")->onDelete("cascade");
            $table->foreignId("empresa_id")->constrained("empresas")->onDelete("cascade");

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
        Schema::dropIfExists('centrocosto_empresa');
    }
}
