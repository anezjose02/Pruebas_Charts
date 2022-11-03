<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FuncionesGenerales;
use App\Http\Controllers\HistoriaController;
use App\Models\General\Punto;
use App\User;
use Illuminate\Http\Request;

class PuntoController extends Controller
{
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
        if ($u->evaluarPermisos(['puntos.crear'])) {
            # code...
            $props .= ' puedecrear=true';
        }
        if ($u->evaluarPermisos(['puntos.editar'])) {
            # code...
            $props .= ' puedeeditar=true';
        }
        if ($u->evaluarPermisos(['puntos.borrar'])) {
            # code...
            $props .= ' puedeborrar=true';
        }

        $data = [
            'titulo'=> 'Puntos de emisión',
            'tabla' => 't-puntos',    
            'props' => $props,
        ];

        return view("general",$data);
    }

    public function getAll()
    {
        $u = User::find(auth()->user()->admin_id);
        return $u->puntos()->where(function($query)
        {
            if (!auth()->user()->superuser && auth()->user()->id != auth()->user()->admin_id) {
                # code...
                $query->whereIn('id',json_decode(auth()->user()->en_puntos));
            }
        })->get();
    }

    public function get()
    {
        # code...
        $u = User::find(auth()->user()->admin_id);
        return $u->puntos()->where(function ($query)
        {
            if (@$_GET['buscarnombre']) {
                # code...
                $query->where('nombre','like','%'.@$_GET['buscarnombre'].'%');
            }
        })->orderBy(@$_GET['orderBy'] ? @$_GET['orderBy'] : 'id',@$_GET['orderDesc'] ? @$_GET['orderDesc'] : 'desc')->paginate(@$_GET['perPage']);
    }

    public function delete($id)
    {
        $u = User::find(auth()->user()->admin_id);
        $p = $u->puntos()->find($id);
        if (!$p) {
            # code...
            return false;
        }
        
        HistoriaController::setAccion("Eliminó el punto de emisión '" . $p->ptoEmi . "'. Junto con las cajas asociadas.");

        $p->delete();

        return true;
    }

    public function store(Request $request,$id=0)
    {
        # code...
        $u = User::find(auth()->user()->admin_id);
        $p = $u->puntos()->find($id);

        if (!$p) {
            # code...
            if ($u->max_puntos > 0 && $u->max_puntos <= $u->puntos()->count()) {
                # code...
                return null;
            }
            $p = new Punto();
        }

        $p->fill($request->all());
        $p->user_id = auth()->user()->admin_id;

        $p->secuencialfactura = FuncionesGenerales::secuenciales($p->secuencialfactura);
        $p->secuencialretencion = FuncionesGenerales::secuenciales($p->secuencialretencion);
        $p->secuencialnotacredito = FuncionesGenerales::secuenciales($p->secuencialnotacredito);
        $p->secuencialnotadebito = FuncionesGenerales::secuenciales($p->secuencialnotadebito);
        $p->secuencialguiaremision = FuncionesGenerales::secuenciales($p->secuencialguiaremision);
        $p->secuencialliquidacioncompra = FuncionesGenerales::secuenciales($p->secuencialliquidacioncompra);

        $p->save();
        
        HistoriaController::setAccion(($id? 'Modificó':'Creó') . " el punto de emisión '" . $p->ptoEmi . "'.");

        return $p;
    }
}
