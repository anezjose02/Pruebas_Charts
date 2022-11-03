<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentetiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agentetipos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("user_id");

            $table->text("empresas")->nullable();

            $table->char("nombre",128)->nullable();
            $table->char("abreviatura",16)->nullable();
            $table->char("prefijo",8)->nullable();

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
        Schema::dropIfExists('agentetipos');
    }
}
