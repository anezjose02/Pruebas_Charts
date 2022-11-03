<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlancuentasTable extends Migration
{ 
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plancuentas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("user_id");
            $table->foreignId("empresa_id")->constrained('empresas')->onDelete('cascade');

            $table->char("nombre",128);
            $table->char("cuenta",128);
            $table->char("grupo",128);
            $table->enum("naturaleza",["DEUDORA","ACREEDORA"])->default("DEUDORA");
            $table->char("cuenta_superior",128)->nullable();
            $table->boolean("activo")->default(1);

            $table->unsignedBigInteger("inferiores")->default(0);

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
        Schema::dropIfExists('plancuentas');
    }
}
