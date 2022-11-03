<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historias', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("user_id");

            $table->string("accion",1000)->nullable();
            $table->char("email",128)->nullable();
            $table->char("name",128)->nullable();
            $table->char("rol",128)->nullable();
            $table->char("sistema",128)->nullable();

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
        Schema::dropIfExists('historias');
    }
}
