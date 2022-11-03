<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HistoriaController;
use App\Models\Super\Planes;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = [
            'titulo'=> 'Planes',
            'tabla' => 't-planes',    
            'props' => '',
        ];

        return view("general",$data);
    }

    public function getAll()
    {
        return Planes::get();
    }

    public function get()
    {
        # code...
        return Planes::where(function ($query)
        {
            if (@$_GET['buscarnombre']) {
                # code...
                $query->where('nombre','like','%'.@$_GET['buscarnombre'].'%');
            }
        })->orderBy(@$_GET['orderBy'] ? @$_GET['orderBy'] : 'id',@$_GET['orderDesc'] ? @$_GET['orderDesc'] : 'desc')->paginate(@$_GET['perPage']);
    }

    public function delete($id)
    {
        $p = Planes::find($id);

        HistoriaController::setAccion("Eliminó el plan '". $p->nombre ."'.");
        
        $p->delete();

        return true;
    }

    public function store(Request $request)
    {
        # code...
        $p = new Planes($request->all());

        $p->modulos = @json_encode($request->modulos);

        $p->save();

        HistoriaController::setAccion("Creó el plan '". $p->nombre ."'.");

        return $p;
    }

    public function update(Request $request,$id)
    {
        # code...
        $p = Planes::find($id);

        $p->fill($request->all());

        $p->modulos = @json_encode($request->modulos);

        $p->save();

        $sis = $p->sistemas()->get();

        foreach ($sis as $s) {
            # code...
            $ns = $s->nombre;

            $s->fill($request->all());
            $s->nombre = $ns;
            $s->modulos = @json_encode($request->modulos);
            $s->save();

            SistemaController::actualizarUsuariosCascada($s);
        }

        HistoriaController::setAccion("Modificó el plan '". $p->nombre ."'.");

        return $p;
    }
}
