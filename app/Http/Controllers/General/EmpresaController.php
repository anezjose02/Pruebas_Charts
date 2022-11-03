<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HistoriaController;
use App\Models\Contabilidad\Agentetipo;
use App\Models\General\Empresa;
use App\User;
use Illuminate\Http\Request;

class EmpresaController extends Controller
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
        if ($u->evaluarPermisos(['empresas.crear'])) {
            # code...
            $props .= ' puedecrear=true';
        }
        if ($u->evaluarPermisos(['empresas.editar'])) {
            # code...
            $props .= ' puedeeditar=true';
        }
        if ($u->evaluarPermisos(['empresas.borrar'])) {
            # code...
            $props .= ' puedeborrar=true';
        }

        $data = [
            'titulo'=> 'Empresas',
            'tabla' => 't-empresas',    
            'props' => $props,
        ];

        return view("general",$data);
    }

    public function getAll()
    {
        $u = User::find(auth()->user()->admin_id);
        return $u->empresas()->where(function($query)
        {
            if (!auth()->user()->superuser && auth()->user()->id != auth()->user()->admin_id) {
                # code...
                $query->whereIn('id',json_decode(auth()->user()->en_empresas));
            }
        })->get();
    }

    public function get()
    {
        # code...
        $u = User::find(auth()->user()->admin_id);
        return $u->empresas()->where(function ($query)
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
        $p = $u->empresas()->find($id);
        if (!$p) {
            # code...
            return false;
        }

        
        HistoriaController::setAccion("Eliminó la empresa '" . $p->nombreComercial??$p->razonSocial . "'. Junto con sus sucrusales, puntos de emisión, cajas y planes de cuenta asociados.");

        $p->delete();

        $u->sucursales()->where('empresa_id',$id)->delete();

        return true;
    }

    public function store(Request $request,$id=0)
    {
        # code...
        $u = User::find(auth()->user()->admin_id);
        $p = $u->empresas()->find($id);

        $existe = true;

        if (!$p) {
            # code...
            if ($u->max_empresas > 0 && $u->max_empresas <= $u->empresas()->count()) {
                # code...
                return null;
            }

            $p = new Empresa();

            $existe = false;
        }

        $p->fill($request->all());
        $p->user_id = auth()->user()->admin_id;

        if ($request->file('file_1')) {
            # code...
            $file_1 = $request->file('file_1');

            $nom = auth()->user()->id . 'u' . time() . 'elg.' . $file_1->getClientOriginalExtension();

            $file_1->move(public_path('files/img'),$nom);

            @unlink(public_path('files/img').'/'.$p->logo);

            $p->logo = $nom;
        }

        if ($request->file('file_2')) {
            # code...
            $file_2 = $request->file('file_2');

            $nom = auth()->user()->id . 'u' . time() . 'frm.' . $file_2->getClientOriginalExtension();

            $file_2->move(public_path().'/../confidenciales',$nom);

            @unlink(public_path().'/../confidenciales/'.$p->firma);

            $p->firma = $nom;
        }

        $p->save();

        if (!$existe) {
            # code...
            $tasg = Agentetipo::where('user_id',auth()->user()->admin_id)->get();

            foreach ($tasg as $tsa) {
                # code...
                $emps = json_decode($tsa->empresas) ?? [];

                $p->secuencia = 1;

                array_push($emps,$p);

                $tsa->empresas = json_encode($emps);

                $tsa->save();
            }
        }

        HistoriaController::setAccion(($id? 'Modificó':'Creó') . " la empresa '" . $p->nombreComercial??$p->razonSocial . "'.");

        return $p;
    }

    public function centrosCostos($id)
    {
        # code...
        $u = User::find(auth()->user()->admin_id);
        $p = $u->empresas()->find($id);

        return $p->centrosCostos()->get();
    }
}
