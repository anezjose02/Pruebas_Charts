<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Contantes;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HistoriaController;
use App\Models\Inventario\Precio;
use App\Models\Inventario\Unidades;
use App\Models\Super\Planes;
use App\Models\Super\Sistema;
use App\User;
use Illuminate\Http\Request;

class SistemaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $props = '';
        $u = User::find(auth()->user()->id);
        if ($u->superuser) {
            $props .= ' essuperuser=true';
        }
        if ($u->id == auth()->user()->id) {
            $props .= ' editarsuclave=true';
        }

        $data = [
            'titulo'=> 'Sistemas',
            'tabla' => 't-sistemas',    
            'props' => $props,
        ];

        return view("general",$data);
    }

    public function changePass(Request $request){
        $sistema = Sistema::where('id',$request->id)->first();
        if ($sistema->user_id == auth()->user()->id || auth()->user()->superuser) {
           $user = User::find($sistema->user_id);
           $user->email = $request->email;
           $user->password = bcrypt($request->password);
           $user->save();
        }
        return;

    }

    public function get()
    {
        # code...
        return Sistema::where(function ($query)
        {
            if (@$_GET['buscarnombre']) {
                # code...
                $query->where('nombre','like','%'.@$_GET['buscarnombre'].'%');
            }
        })->orderBy(@$_GET['orderBy'] ? @$_GET['orderBy'] : 'id',@$_GET['orderDesc'] ? @$_GET['orderDesc'] : 'desc')->paginate(@$_GET['perPage']);
    }

    public function delete($id)
    {
        $p = Sistema::find($id);
        
        User::where('admin_id',$p->user_id)->where('superuser','!=',1)->delete();

        HistoriaController::setAccion("Eliminó el sistema '" . $p->nombre ."'");

        $p->delete();

        return true;
    }

    public function store(Request $request)
    {
        # code...
        $plan = Planes::where('nombre',$request->plan)->first();

        $p = new Sistema(json_decode(json_encode($plan),true));


        $p->fill($request->all());

        $u = new User(json_decode(json_encode($plan),true));
        $u->fill($request->all());
      
        $u->password = bcrypt($request->password);
        $u->sistema = $request->nombre;
        $u->configuracion_sistema = Contantes::configuracionSistema();
        $u->save();
        $u->admin_id = $u->id;
        $u->save();

        $p->user_id = $u->id;

        $p->save();

        $preunidades = Contantes::unidades();

        foreach ($preunidades as $pru) {
            # code...
            $unidad = new Unidades(json_decode(json_encode($pru),true));

            $unidad->user_id = $u->id;
    
            $unidad->save();
        }

        $preprecios = Contantes::precios();

        foreach ($preprecios as $pru) {
            # code...
            $prc = new Precio(json_decode(json_encode($pru),true));

            $prc->user_id = $u->id;
    
            $prc->save();
        }
        
        HistoriaController::setAccion("Creó el sistema '" . $p->nombre ."'");

        return $p;
    }

    public function update(Request $request,$id)
    {
       
        # code...
        $plan = Planes::where('nombre',$request->plan)->first();

        $s = Sistema::find($id);

        $s->fill(json_decode(json_encode($plan),true));
        $s->nombre = $request->nombre;
        $s->plan = $request->plan;
        
        $u = User::find($s->user_id);
        $u->sistema = $request->nombre;
        $u->max_empresas = $plan->max_empresas;
        $u->save();

        $s->save();

        self::actualizarUsuariosCascada($s);

        
        HistoriaController::setAccion("Modificó el sistema '" . $s->nombre ."'");

        return $s;
    }

    public static function actualizarUsuariosCascada($sistema)
    {
        # code...
        $u = User::find($sistema->user_id);

        $us = $u->usuarios()->get();

        foreach ($us as $uu) {
            # code...
            if ($uu->id == $uu->admin_id) {
                # code...
                $uu->modulos = $sistema->modulos;
                $uu->sistema = $sistema->nombre;
                $uu->save();

                continue;
            }

            $mdl = json_decode($uu->modulos);

            $mdls = json_decode($sistema->modulos);

            
            
            $r = [];
            for ($i=0; $i < count($mdl); $i++) { 
                # code...
                $existe = false;

                for ($j=0; $j < count($mdls); $j++) { 
                    # code...
                    if ($mdl[$i] == $mdls[$j]) {
                        # code...
                        $existe = true;
                        break;
                    }
                }

                if (!$existe) {
                    # code...
                    array_splice($mdl,$i,1);
                    $i--;
                }else{
                    array_push($r,$mdl[$i]);
                }
            }

            $uu->modulos = json_encode($r);
            $uu->sistema = $sistema->nombre;
            $uu->save();
        }
    }

    public function controlar($id)
    {
        # code...
        $sis = Sistema::find($id);

        $u = User::find(auth()->user()->id);

        $u->sistema = $sis->nombre;
        $u->modulos = $sis->modulos;
        $u->admin_id = $sis->user_id;

        $u->save();
        
        HistoriaController::setAccion("El SUPER USUARIO '" . $u->email ."' tomo el control del sistema '" . $u->sistema . "'");

        return back()->with("success","Haz tomado control del sistema - ".$sis->nombre.".");
    }
}
