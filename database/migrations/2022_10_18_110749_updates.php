<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class Updates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if (!Schema::hasColumn('documentos', 'formas_de_pago')) {
            Schema::table('documentos', function (Blueprint $table) {
                $table->text("formas_de_pago")->nullable()->after("json");
            });
        }
        // CREDITOS
        if (!Schema::hasColumn('creditos', 'caja_id')) {
            Schema::table('creditos', function (Blueprint $table) {
                $table->unsignedBigInteger('caja_id')->nullable();
                $table->foreign('caja_id')->references('id')->on('cajas')->nullable()->after("cliente_id");
                // ->onDelete('cascade');
            });
        }

        if (!Schema::hasColumn('creditos', 'venta_id')) {
            Schema::table('creditos', function (Blueprint $table) {
                $table->unsignedBigInteger('venta_id')->nullable();
                $table->foreign('venta_id')->references('id')->on('ventas')->nullable()->after("id");
                // ->onDelete('cascade');
            });
        }

        // 31-10-2022
        if (!Schema::hasColumn('cajas', 'estado')) {
            Schema::table('cajas', function (Blueprint $table) {
                $table->enum("estado", ['CERRADA', 'ABIERTA'])->default('CERRADA');
            });
        }

    
        
        // if (Schema::hasColumn('cajas', 'efectivo')) {
        //     Schema::table('cajas', function (Blueprint $table) {
        //         $table->dropColumn('efectivo');
        //     });
        // }
        // if (!Schema::hasColumn('cajas', 'efectivo')) {
        //     Schema::table('cajas', function (Blueprint $table) {
        //         $table->bigInteger('efectivo')->defautl(0);
        //     });
        // }
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
// $table->dropColumn('comment_count');
