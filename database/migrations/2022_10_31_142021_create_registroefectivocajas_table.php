<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistroefectivocajasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registroefectivocajas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('caja_id')->nullable();
            $table->foreign('caja_id')->references('id')->on('cajas')->nullable()->after("id");
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->nullable()->after("id");
            $table->double('valor_apertura')->nullable();
            $table->double('valor_cierre')->nullable();
            $table->datetime("fecha_apertura")->nullable();
            $table->datetime("fecha_cierre")->nullable();
            $table->boolean("reciente")->default(0);
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
        Schema::dropIfExists('registroefectivocajas');
    }
}
