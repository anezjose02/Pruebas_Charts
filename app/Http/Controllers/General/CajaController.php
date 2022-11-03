<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HistoriaController;
use App\Models\General\Caja;
use App\Registroefectivocaja;
use App\User;
use Illuminate\Http\Request;

class CajaController extends Controller
{
    
    public function abrir_cerrar_caja(Request $request){
        
        $u = User::find(auth()->user()->admin_id);
        $caja = $u->cajas()->find($request->caja_id);
       
        if($caja && $caja->estado == "CERRADA"){
            $registroAnt = Registroefectivocaja::where('reciente',1)->where('caja_id',$request->caja_id)->first();
            if($registroAnt){
                $registroAnt->reciente = 0;
                $registroAnt->save();
            }
            $cajareg = new Registroefectivocaja;
            $cajareg->fecha_apertura = \Carbon\Carbon::now()->format("Y-m-d H:i:s");
            $cajareg->user_id = auth()->user()->id;
            $cajareg->valor_apertura = $request->valor_apertura;
            $cajareg->valor_cierre = 0;

            $cajareg->caja_id = $request->caja_id;
            $cajareg->reciente = 1;

            $cajareg->save();
            $caja->estado = "ABIERTA";
        }else{
            $cajareg = Registroefectivocaja::where('reciente',1)->where('caja_id',$request->caja_id)->first();
            $cajareg->fecha_cierre = \Carbon\Carbon::now()->format("Y-m-d H:i:s");
            $cajareg->valor_apertura = $request->valor_apertura;
            $cajareg->valor_cierre = $request->valor_cierre;
            
            $cajareg->reciente = 0;
            $cajareg->save();
            $caja->estado = "CERRADA";

        }

        $caja->save();
    }

    public function cajas_efectivo()
    {
        $props = "";
        $data = [
            'titulo' => 'Cajas efectivo',
            'tabla' => 'cajas-efectivo',
            'props' => $props,
        ];

        return view("general", $data);
    }

    //
    public function index()
    {
        //
        $props = '';
        $u = User::find(auth()->user()->id);
        if ($u->superuser) {
            # code...
            $props .= ' essuperuser=true';
        }
        if ($u->evaluarPermisos(['cajas.crear'])) {
            # code...
            $props .= ' puedecrear=true';
        }
        if ($u->evaluarPermisos(['cajas.editar'])) {
            # code...
            $props .= ' puedeeditar=true';
        }
        if ($u->evaluarPermisos(['cajas.borrar'])) {
            # code...
            $props .= ' puedeborrar=true';
        }

        $data = [
            'titulo' => 'Cajas',
            'tabla' => 't-cajas',
            'props' => $props,
        ];

        return view("general", $data);
    }

    public function getAll()
    {
        $u = User::find(auth()->user()->admin_id);
        return $u->cajas()->where(function ($query) {
            $query->where(function($query) {
                $query->where('efectivo',1)->where('estado','ABIERTA')->orWhere(function($query) {
                    $query->where('efectivo',0);
                });
            });
            if (!auth()->user()->superuser && auth()->user()->id != auth()->user()->admin_id) {
                # code...
                $query->whereIn('id', json_decode(auth()->user()->en_cajas));
            }
        })->get();
    }

    public function get()
    {
        $u = User::find(auth()->user()->admin_id);
        return $u->cajas()->Join('sucursales', 'sucursales.id', '=', 'cajas.sucursales_id')->where(function ($query) {
            // $query->where('estado','ABIERTA');
            if (!auth()->user()->superuser && auth()->user()->id != auth()->user()->admin_id) {
                # code...
                $query->whereIn('id', json_decode(auth()->user()->en_cajas));
            }
        })->select('cajas.*','sucursales.estab as sucursales_estab','sucursales.direccion as sucursales_direccion')->orderBy(@$_GET['orderBy'] ? @$_GET['orderBy'] : 'id', @$_GET['orderDesc'] ? @$_GET['orderDesc'] : 'desc')->paginate(@$_GET['perPage']);
    }

    public function getCajasEfectivo()
    {
        $u = User::find(auth()->user()->admin_id);
        return $u->cajas()
        ->Join('sucursales', 'sucursales.id', '=', 'cajas.sucursales_id')
        
        ->leftJoin('registroefectivocajas', function ($join) {
            $join->on('registroefectivocajas.caja_id', '=', 'cajas.id')
                 ->where('registroefectivocajas.reciente',1);
        })
       ->where('cajas.efectivo',1)
        ->where(function ($query) {
            if (!auth()->user()->superuser && auth()->user()->id != auth()->user()->admin_id) {
                # code...
                $query->whereIn('id', json_decode(auth()->user()->en_cajas));
            }
        })->select('cajas.*','sucursales.estab as sucursales_estab','sucursales.direccion as sucursales_direccion','registroefectivocajas.valor_apertura as valor_apertura','registroefectivocajas.valor_cierre as valor_cierre','registroefectivocajas.id as registro_id')->orderBy(@$_GET['orderBy'] ? @$_GET['orderBy'] : 'id', @$_GET['orderDesc'] ? @$_GET['orderDesc'] : 'desc')->paginate(@$_GET['perPage']);
        
    }

    public function delete($id)
    {
        $u = User::find(auth()->user()->admin_id);
        $p = $u->cajas()->find($id);
        if (!$p) {
            # code...
            return false;
        }

        HistoriaController::setAccion("Eliminó la caja '" . $p->nombre . "'.");

        $p->delete();

        return true;
    }

    public function store(Request $request, $id = 0)
    {
        # code...
        $u = User::find(auth()->user()->admin_id);
        $p = $u->cajas()->find($id);

        if (!$p) {
            $p = new Caja();
        }

        $p->fill($request->all());
        $p->user_id = auth()->user()->admin_id;
        $p->save();

        HistoriaController::setAccion(($id ? 'Modificó' : 'Creó') . " la caja '" . $p->nombre . "'.");

        return $p;
    }
}
