<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HistoriaController;
use App\Models\Super\Impuesto;
use Illuminate\Http\Request;

class ImpuestoController extends Controller
{
    //
    public function index()
    {
        //
        $data = [
            'titulo'=> 'Impuestos',
            'tabla' => 't-impuestos',    
            'props' => '',
        ];

        return view("general",$data);
    }

    public function get()
    {
        # code...
        return Impuesto::where(function ($query)
        {
            if (@$_GET['buscarnombre']) {
                # code...
                $query->where('nombre','like','%'.@$_GET['buscarnombre'].'%');
            }
        })->orderBy(@$_GET['orderBy'] ? @$_GET['orderBy'] : 'id',@$_GET['orderDesc'] ? @$_GET['orderDesc'] : 'desc')->paginate(@$_GET['perPage']);
    }

    public function getAll()
    {
        return Impuesto::get();
    }

    public function delete($id)
    {
        $p = Impuesto::find($id);

        HistoriaController::setAccion("Eliminó el impuesto '". $p->nombre ."'.");

        $p->delete();

        return true;
    }

    public function store(Request $request,$id=0)
    {
        # code...

        $p = Impuesto::find($id);
        if (!$p) {
            # code...
            $p = new Impuesto();
        }

        $p->fill($request->all());

        $p->save();

        HistoriaController::setAccion(( $id==0?'Creó':'Modificó' ) ." el impuesto '". $p->nombre ."'.");

        return $p;
    }
}
