<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HistoriaController;
use App\User;
use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
    //

    public function cambiar_contraseña(Request $request)
    {
        $user = User::find($request->id);
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return true;
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
        if ($u->evaluarPermisos(['usuarios.crear'])) {
            # code...
            $props .= ' puedecrear=true';
        }
        if ($u->evaluarPermisos(['usuarios.editar'])) {
            # code...
            $props .= ' puedeeditar=true';
        }
        if ($u->modulos) {
            # code...
            $props .= ' premodulos=' . $u->modulos;
        }

        $data = [
            'titulo' => 'Usuarios',
            'tabla' => 't-usuarios',
            'props' => $props,
        ];

        return view("general", $data);
    }

    public function configSistema()
    {
        $u = User::find(auth()->user()->admin_id);

        if (!$u) {
            # code...
            return back()->with("danger", "No tiene érmitido acceder a esta URL.");
        }

        $props = '';

        if ($u->configuracion_sistema) {
            # code...
            $props = ' preconfiguracion=' . $u->configuracion_sistema;
        }


        $data = [
            'titulo' => 'Configuración del sistema',
            'tabla' => 'configuracion-sistema',
            'props' => $props,
        ];

        return view("general", $data);
    }

    public function saveConfigSistema(Request $request)
    {
        # code...
        $u = User::find(auth()->user()->admin_id);

        if (!$u) {
            # code...
            return false;
        }

        $u->configuracion_sistema = json_encode($request->configuracion);

        $u->save();

        HistoriaController::setAccion("Modificó la configuración general del sistema '" . $u->sistema . "'.");

        return true;
    }

    public function get()
    {
        # code...
      
        $u = User::find(auth()->user()->admin_id);
        if(auth()->user()->superuser){
            return $u->usuarios()->where(function ($query) {
                if (@$_GET['buscarnombre']) {
                    # code...
                    $query->where('nombre', 'like', '%' . @$_GET['buscarnombre'] . '%');
                }
            }) ->orderBy(@$_GET['orderBy'] ? @$_GET['orderBy'] : 'id', @$_GET['orderDesc'] ? @$_GET['orderDesc'] : 'desc')->paginate(@$_GET['perPage']);
        }else{
            return $u->usuarios()->where('superuser',0)->where(function ($query) {
                if (@$_GET['buscarnombre']) {
                    # code...
                    $query->where('nombre', 'like', '%' . @$_GET['buscarnombre'] . '%');
                }
            }) ->orderBy(@$_GET['orderBy'] ? @$_GET['orderBy'] : 'id', @$_GET['orderDesc'] ? @$_GET['orderDesc'] : 'desc')->paginate(@$_GET['perPage']);
        }
       
    }

    public function store(Request $request, $id = 0)
    {
        # code...
        $u = User::find(auth()->user()->admin_id);
        $p = $u->usuarios()->find($id);
        if (!$p) {
            # code...
            if ($u->max_usuarios > 0 && $u->max_usuarios <= $u->usuarios()->count()) {
                # code...
                return null;
            }
            $p = new User();
        }
        $p->fill($request->all());

        if ($request->password) {
            # code...
            $p->password = bcrypt($request->password);
        }

        $p->permisos = @json_encode($request->permisos);
        $p->modulos = @json_encode($request->modulos);
        $p->en_empresas = @json_encode($request->en_empresas);
        $p->en_sucursales = @json_encode($request->en_sucursales);
        $p->en_puntos = @json_encode($request->en_puntos);
        $p->en_cajas = @json_encode($request->en_cajas);
        $p->en_almacenes = @json_encode($request->en_almacenes);

        $p->admin_id = auth()->user()->admin_id;
        $p->sistema = auth()->user()->sistema;

        $p->save();


        HistoriaController::setAccion(($id ? 'Modificó' : 'Creó') . " al usuario '" . $p->email . "'.");

        return $p;
    }

    public function temas()
    {
        $user = Auth::user();

        return view('temas', ["user" => $user]);
    }

    public function cambiar_tema(Request $request)
    {
        $user = Auth::user();
        $user->tema_seleccionado = $request->tema;
        $user->save();

        return back();
    }

    public function cambiar_barra_lateral(Request $request)
    {
        $user = Auth::user();
        $user->barra_lateral = $request->variable;
        $user->save();

        return back();
    }
}
