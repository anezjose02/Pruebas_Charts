<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HistoriaController;
use App\Models\Super\Concepto;
use Illuminate\Http\Request;

class ConceptoController extends Controller
{
    //
    public function index()
    {
        //
        $data = [
            'titulo'=> 'Conceptos',
            'tabla' => 't-conceptos',    
            'props' => '',
        ];

        return view("general",$data);
    }

    public function getAll()
    {
        return Concepto::get();
    }

    public function get()
    {
        # code...
        return Concepto::where(function ($query)
        {
            if (@$_GET['buscarnombre']) {
                # code...
                $query->where('nombre','like','%'.@$_GET['buscarnombre'].'%');
            }
        })->orderBy(@$_GET['orderBy'] ? @$_GET['orderBy'] : 'id',@$_GET['orderDesc'] ? @$_GET['orderDesc'] : 'desc')->paginate(@$_GET['perPage']);
    }

    public function delete($id)
    {
        $p = Concepto::find($id);

        $p->delete();
        
        HistoriaController::setAccion("Eliminó el concepto '" . $p->nombre . "'.");

        return true;
    }

    public function store(Request $request,$id=0)
    {
        # code...
        $p = Concepto::find($id);
        
        if (!$p) {
            # code...
            $p = new Concepto();
        }
        $p->fill($request->all());

        $p->save();

        HistoriaController::setAccion(($id? 'Modificó':'Creó') . " el concepto '" . $p->nombre . "'.");

        return $p;
    }
}
