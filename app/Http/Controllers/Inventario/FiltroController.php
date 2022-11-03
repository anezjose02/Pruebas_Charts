<?php

namespace App\Http\Controllers\Inventario;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HistoriaController;
use App\Models\Inventario\Filtro;
use App\User;
use Illuminate\Http\Request;

class FiltroController extends Controller
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
        if ($u->evaluarPermisos(['filtros.crear'])) {
            # code...
            $props .= ' puedecrear=true';
        }
        if ($u->evaluarPermisos(['filtros.editar'])) {
            # code...
            $props .= ' puedeeditar=true';
        }
        if ($u->evaluarPermisos(['filtros.borrar'])) {
            # code...
            $props .= ' puedeborrar=true';
        }

        $data = [
            'titulo'=> 'Filtros',
            'tabla' => 't-filtros',    
            'props' => $props,
        ];

        return view("general",$data);
    }

    public function getAll()
    {
        $u = User::find(auth()->user()->admin_id);
        return $u->filtros()->where("activo",1)->get();
    }

    public function get()
    {
        # code...
        $u = User::find(auth()->user()->admin_id);
        return $u->filtros()->where(function ($query)
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
        $p = $u->filtros()->find($id);
        if (!$p) {
            # code...
            return false;
        }
        
        HistoriaController::setAccion("Eliminó el filtro '" . $p->nombre . "'.");

        $p->delete();

        return true;
    }

    public function store(Request $request,$id=0)
    {
        # code...
        $u = User::find(auth()->user()->admin_id);
        $p = $u->filtros()->find($id);

        if (!$p) {
            # code...
            $p = new Filtro();
        }

        $p->fill($request->all());
        $p->user_id = auth()->user()->admin_id;

        $p->save();
        
        HistoriaController::setAccion(($id? 'Modificó':'Creó') . " el filtro '" . $p->nombre . "'.");

        return $p;
    }
}
