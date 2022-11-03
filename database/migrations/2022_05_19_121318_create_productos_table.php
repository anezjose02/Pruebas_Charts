<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("user_id");

            $table->boolean("activo")->default(true);

            $table->char("codigoPrincipal",25);
            $table->char("codigoAuxiliar",25)->nullable();
            $table->text("descripcion");
            $table->text("unidadMedida")->nullable();

            $table->text("preciosunidades")->nullable();
            $table->text("impuestos")->nullable();

            $table->char("descripcionadicional",255)->nullable();
            $table->char("clasificacion",64)->nullable();
            $table->char("categoria",64)->nullable();
            $table->char("tipoproducto",64)->nullable();
            $table->char("tipo",64)->nullable();
            $table->double("minimo")->nullable();
            $table->double("maximo")->nullable();
            $table->char("diasgarantia",64)->nullable();
            $table->char("ubicacioninterna",64)->nullable();
            $table->char("detalleadicional",64)->nullable();
            $table->text("imagenes")->nullable();//['url1','url2',...]
            $table->boolean("editardatos")->default(false);
            
            $table->text("preciosadicionales")->nullable();
            $table->boolean("editarprecio")->default(false);
            $table->double("subsidio")->nullable();
            $table->boolean("grabaiva")->default(false);
            $table->boolean("subsidiado")->default(false);

            $table->boolean("almacenespordefecto")->default(false);
            $table->boolean("aplicafechaelaboracion")->default(false);
            $table->boolean("aplicafechavencimiento")->default(false);
            $table->boolean("aplicavariante")->default(false);
            $table->boolean("aplicamultiunidad")->default(false);
            $table->boolean("aplicacompra")->default(false);
            $table->boolean("aplicaventa")->default(false);
            $table->boolean("aplicaimportacion")->default(false);
            $table->boolean("aplicaexportacion")->default(false);
            $table->boolean("aplicasitioweb")->default(false);
            $table->boolean("aplicalineaproduccion")->default(false);
            $table->boolean("aplicaporcentajeservicio")->default(false);
            $table->boolean("aplicacomision")->default(false);
            $table->boolean("aplicasede")->default(false);
            $table->boolean("aplicalote")->default(false);
            $table->boolean("aplicacomanda")->default(false);
            $table->boolean("aplicavedemecum")->default(false);
            $table->boolean("aplicaarearectangular")->default(false);
            $table->boolean("aplicaareacircular")->default(false);
            $table->boolean("aplicavolumencubico")->default(false);
            $table->boolean("aplicavolumencilindrico")->default(false);

            $table->double("preciocompra")->nullable();
            $table->double("ivacompra")->nullable();
            $table->char("categoriacontable",255)->nullable();
            $table->char("categoriacompra",255)->nullable();
            $table->char("categoriaventa",255)->nullable();
            $table->char("categoriacostos",255)->nullable();
            $table->char("categoriaingresos",255)->nullable();
            $table->char("categoriaproduccion",255)->nullable();
            $table->char("costoventa",255)->nullable();
            $table->char("ingresoventa",255)->nullable();
            $table->char("centrocosto",64)->nullable();
            $table->char("decucibleir",64)->default('NO');
            $table->double("ivaretener")->nullable();
            $table->boolean("activofijo")->default(false);
            
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
        Schema::dropIfExists('productos');
    }
}
