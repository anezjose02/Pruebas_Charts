<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use App\User;
use Illuminate\Http\Request;
use Josefranciscocruzcorro\EnviaSri\Enviador;
use App\Models\General\Empresa;
use App\Http\Controllers\SRI\XMLController;
use App\Models\Cliente;
use App\Models\Comercio\Venta;

use Josefranciscocruzcorro\Firmador\Firmar;

class DocumentoController extends Controller
{
    //


    public function generarXMLVENTA($venta_id)
    {
        $venta = Venta::find($venta_id);
        $obj = Documento::where('venta_id', $venta_id)->first();
        $cliente = Cliente::find($venta->cliente_id);
        $xml = XMLController::factura($obj, $cliente, "");
        return $xml;
    }


 
    public function convertirCompra($id)
    {
        # code...
        $u = User::find(auth()->user()->admin_id);

        $documento = $u->documentos()->find($id);

        if (!$documento) {
            # code...
            return back()->with("danger", "Accion deneada.");
        }
        $v = $documento;

        $v->megadocumento = $documento;

        $data = [
            'compra' => $v,
            'tipodoc' => 'megadocumento',
            'configuracion' => json_decode($u->configuracion_sistema),
        ];

        return view('otros.compra', $data);
    }
    public function convertirGasto($id)
    {
        # code...
        $u = User::find(auth()->user()->admin_id);

        $documento = $u->documentos()->find($id);

        if (!$documento) {
            # code...
            return back()->with("danger", "Accion deneada.");
        }
        $v = $documento;

        $v->megadocumento = $documento;

        $data = [
            'gasto' => $v,
            'tipodoc' => 'megadocumento',
            'configuracion' => json_decode($u->configuracion_sistema),
        ];

        return view('otros.gasto', $data);
    }

    public function index()
    {
        //
        $props = '';
        $u = User::find(auth()->user()->id);
        if ($u->superuser) {
            # code...
            $props .= ' essuperuser=true';
        }
        if ($u->evaluarPermisos(['documentos.compra'])) {
            # code...
            $props .= ' puedecompra=true';
        }
        if ($u->evaluarPermisos(['documentos.venta'])) {
            # code...
            $props .= ' puedeventa=true';
        }
        if ($u->evaluarPermisos(['documentos.gasto'])) {
            # code...
            $props .= ' puedegasto=true';
        }
        if ($u->evaluarPermisos(['documentos.borrar'])) {
            # code...
            $props .= ' puedeborrar=true';
        }

        $data = [
            'titulo' => 'Documentos recibidos',
            'tabla' => 't-documentos',
            'props' => $props,
        ];

        return view("general", $data);
    }

    public function cargaMasiva()
    {
        # code...
        $data = [
            'titulo' => 'Carga masiva',
            'tabla' => 'carga-masiva',
        ];

        return view("general", $data);
    }

    public function cargarTXT(Request $request)
    {
        # code...
        $u = User::find(auth()->user()->admin_id);
        $documento = $u->documentos()->where('claveAcceso', $request->clave)->first();

        if ($documento) {
            # code...
            return 'EXISTE';
        }

        $xml = utf8_encode(Enviador::extraerComprobanteXML($request->clave, 2));
        $obj = simplexml_load_string($xml);
        $json = json_encode($obj);
        $obj = json_decode($json, true);
        $obj2 = FuncionesGenerales::estandarizar($obj);
        $json = json_encode($obj2);

        $this->saveDocumento($u, $obj, $json);

        return $json;
    }

    public function cargarXML(Request $request)
    {
        # code...


        $xml = utf8_encode($request->xml);
        $obj = simplexml_load_string($xml);
        $u = User::find(auth()->user()->admin_id);
        $documento = $u->documentos()->where('claveAcceso', $obj['infoTributaria']['claveAcceso'])->first();

        if ($documento) {
            # code...
            return 'EXISTE';
        }
        $json = json_encode($obj);
        $obj = json_decode($json, true);
        $obj2 = FuncionesGenerales::estandarizar($obj);
        $json = json_encode($obj2);

        $this->saveDocumento($u, $obj, $json);

        return $json;
    }




    public function saveDocumento($u, $obj, $json)
    {
        # code...
        $documento = new Documento($obj['infoTributaria']);

        $documento->user_id = $u->id;
        $documento->json = $json;
        $documento->nombreComercial = @json_encode(@$obj['infoTributaria']['nombreComercial']);

        if (@$obj['infoFactura']) {
            # code...
            $fecha = @explode('/', @$obj['infoFactura']['fechaEmision']);
            $documento->fecha_emision = @$fecha[2] . '-' . @$fecha[1] . '-' . @$fecha[0];
            $documento->subtotal_sin_impuestos = @$obj['infoFactura']['totalSinImpuestos'];
            $documento->descuento = @$obj['infoFactura']['totalDescuento'];
            $documento->propina = @$obj['infoFactura']['propina'];
            $documento->total = @$obj['infoFactura']['importeTotal'];

            if (@$obj['infoFactura']['totalConImpuestos']) {
                # code...
                $documento->subtotal_cero = 0;
                $documento->subtotal_iva = 0;
                $documento->subtotal_otros = 0;

                if (@$obj['infoFactura']['totalConImpuestos']['totalImpuesto'][1]) {
                    # code...
                    foreach (@$obj['infoFactura']['totalConImpuestos']['totalImpuesto'] as $totalImp) {
                        # code...
                        if (
                            $totalImp['codigo'] == 2 &&
                            $totalImp['codigoPorcentaje'] == 0
                        ) {
                            # code...
                            $documento->subtotal_cero += $totalImp['valor'];
                        }
                        if (
                            $totalImp['codigo'] == 2 &&
                            $totalImp['codigoPorcentaje'] != 0
                        ) {
                            # code...
                            $documento->subtotal_iva += $totalImp['valor'];
                        }
                        if ($totalImp['codigo'] != 2) {
                            # code...
                            $documento->subtotal_otros += $totalImp['valor'];
                        }
                    }
                } else {
                    # code...
                    if (
                        @$obj['infoFactura']['totalConImpuestos']['totalImpuesto']['codigo'] == 2 &&
                        @$obj['infoFactura']['totalConImpuestos']['totalImpuesto']['codigoPorcentaje'] == 0
                    ) {
                        # code...
                        $documento->subtotal_cero = @$obj['infoFactura']['totalConImpuestos']['totalImpuesto']['valor'];
                    }
                    if (
                        @$obj['infoFactura']['totalConImpuestos']['totalImpuesto']['codigo'] == 2 &&
                        @$obj['infoFactura']['totalConImpuestos']['totalImpuesto']['codigoPorcentaje'] != 0
                    ) {
                        # code...
                        $documento->subtotal_iva = @$obj['infoFactura']['totalConImpuestos']['totalImpuesto']['valor'];
                    }
                    if (@$obj['infoFactura']['totalConImpuestos']['totalImpuesto']['codigo'] != 2) {
                        # code...
                        $documento->subtotal_otros = @$obj['infoFactura']['totalConImpuestos']['totalImpuesto']['valor'];
                    }
                }
            }
        } else if (@$obj['infoNotaDebito']) {
            # code...
            $fecha = @explode('/', @$obj['infoNotaDebito']['fechaEmision']);
            $documento->fecha_emision = @$fecha[2] . '-' . @$fecha[1] . '-' . @$fecha[0];
        } else if (@$obj['infoNotaCredito']) {
            # code...
            $fecha = @explode('/', @$obj['infoNotaCredito']['fechaEmision']);
            $documento->fecha_emision = @$fecha[2] . '-' . @$fecha[1] . '-' . @$fecha[0];
        } else if (@$obj['infoCompRetencion']) {
            # code...
            $fecha = @explode('/', @$obj['infoCompRetencion']['fechaEmision']);
            $documento->fecha_emision = @$fecha[2] . '-' . @$fecha[1] . '-' . @$fecha[0];
        } else if (@$obj['infoLiquidacionCompra']) {
            # code...
            $fecha = @explode('/', @$obj['infoLiquidacionCompra']['fechaEmision']);
            $documento->fecha_emision = @$fecha[2] . '-' . @$fecha[1] . '-' . @$fecha[0];
        }

        $documento->save();

        HistoriaController::setAccion("Ingresó por carga masiva el documento con clave de acceso '" . $documento->claveAcceso . "'.");
    }

    public function get()
    {
        # code...
        $u = User::find(auth()->user()->admin_id);
        return $u->documentos()->where('compra_id', 0)->where('gasto_id', 0)->where('venta_id', 0)->where('proforma_id', 0)->where(function ($query) {
            if (@$_GET['buscarnombre']) {
                # code...
                $query->where('nombre', 'like', '%' . @$_GET['buscarnombre'] . '%');
            }
        })->orderBy(@$_GET['orderBy'] ? @$_GET['orderBy'] : 'id', @$_GET['orderDesc'] ? @$_GET['orderDesc'] : 'desc')->paginate(@$_GET['perPage']);
    }

    public function delete($id)
    {
        $u = User::find(auth()->user()->admin_id);
        $p = $u->documentos()->find($id);
        if (!$p) {
            # code...
            return false;
        }

        $p->delete();
        HistoriaController::setAccion("Eliminó documento con clave de acceso '" . $p->claveAcceso . "'.");

        return true;
    }
}
