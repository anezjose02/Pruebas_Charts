<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HistoriaController;
use App\Models\General\Role;
use App\User;
use Illuminate\Http\Request;

class RoleController extends Controller
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
        if ($u->evaluarPermisos(['roles.crear'])) {
            # code...
            $props .= ' puedecrear=true';
        }
        if ($u->evaluarPermisos(['roles.editar'])) {
            # code...
            $props .= ' puedeeditar=true';
        }
        if ($u->evaluarPermisos(['roles.borrar'])) {
            # code...
            $props .= ' puedeborrar=true';
        }
        if ($u->modulos) {
            # code...
            $props .= ' premodulos='.$u->modulos;
        }

        $data = [
            'titulo'=> 'Roles',
            'tabla' => 't-roles',    
            'props' => $props,
        ];

        return view("general",$data);
    }

    public function getAll()
    {
        $u = User::find(auth()->user()->admin_id);
        return $u->roles()->where(function ($query)
        {
            # code...
            if (!auth()->user()->superuser && auth()->user()->id != auth()->user()->admin_id) {
                # code...
                $query->where('nombre',auth()->user()->rol);
            }
        })->get();
    }

    public function get()
    {
        # code...
        $u = User::find(auth()->user()->admin_id);
        return $u->roles()->where(function ($query)
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
        $p = $u->roles()->find($id);
        if (!$p) {
            # code...
            return false;
        }

        HistoriaController::setAccion("Eliminó el rol '" . $p->nombre . "'.");

        $p->delete();

        return true;
    }

    public function store(Request $request)
    {
        # code...
        $p = new Role($request->all());

        $p->permisos = @json_encode($request->permisos);
        $p->modulos = @json_encode($request->modulos);
        $p->user_id = auth()->user()->admin_id;

        $p->save();
        
        HistoriaController::setAccion("Creó el rol '" . $p->nombre . "'.");

        return $p;
    }

    public function update(Request $request,$id)
    {
        # code...
        $u = User::find(auth()->user()->admin_id);
        $p = $u->roles()->find($id);
        if (!$p) {
            # code...
            return null;
        }

        $p->fill($request->all());

        $p->permisos = @json_encode($request->permisos);
        $p->modulos = @json_encode($request->modulos);

        $p->save();

        
        if ($request->permisos) {
            # code...
            $uss = $u->usuarios()->where('superuser',0)->get();
            foreach ($uss as $us) {
                # code...
                $us->permisos = '[]';
                foreach ($request->permisos as $pp) {
                    # code...
                    if ($us->rol == $p->nombre && !$us->evaluarPermisos([$pp])) {
                        # code...
                        $upp = json_decode($us->permisos);

                        array_push($upp,$pp);

                        $us->permisos = json_encode($upp);
                        $us->save();
                    }
                }
            }
        }
        if ($request->modulos) {
            # code...
            $uss = $u->usuarios()->where('superuser',0)->get();
            foreach ($uss as $us) {
                # code...
                if ($us->id != $us->admin_id) {
                    # code...
                    $us->modulos = '[]';
                }
                foreach ($request->modulos as $pp) {
                    # code...
                    if ($us->rol == $p->nombre && !$us->evaluarModulos([$pp])) {
                        # code...
                        $upp = json_decode($us->modulos);

                        array_push($upp,$pp);

                        $us->modulos = json_encode($upp);
                        $us->save();
                    }
                }
            }
        }

        
        HistoriaController::setAccion("Modificó el rol '" . $p->nombre . "'.");

        return $p;
    }
}
