<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FuncionesGenerales;
use App\Http\Controllers\HistoriaController;
use App\Models\General\Sucursales;
use App\User;
use Illuminate\Http\Request;

class SucursalController extends Controller
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
        if ($u->evaluarPermisos(['sucursales.crear'])) {
            # code...
            $props .= ' puedecrear=true';
        }
        if ($u->evaluarPermisos(['sucursales.editar'])) {
            # code...
            $props .= ' puedeeditar=true';
        }
        if ($u->evaluarPermisos(['sucursales.borrar'])) {
            # code...
            $props .= ' puedeborrar=true';
        }

        $data = [
            'titulo'=> 'Sucursales',
            'tabla' => 't-sucursales',    
            'props' => $props,
        ];

        return view("general",$data);
    }

    public function getAll()
    {
        $u = User::find(auth()->user()->admin_id);
        return $u->sucursales()->where(function($query)
        {
            if (!auth()->user()->superuser && auth()->user()->id != auth()->user()->admin_id) {
                # code...
                $query->whereIn('id',json_decode(auth()->user()->en_sucursales));
            }
        })->get();
    }

    public function get()
    {
        # code...
        $u = User::find(auth()->user()->admin_id);
        return $u->sucursales()->where(function ($query)
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
        $p = $u->sucursales()->find($id);
        if (!$p) {
            # code...
            return false;
        }
        HistoriaController::setAccion("Eliminó el establecimiento/Sucursal '" . $p->estab . "'. Junto con los puntos de emisión y cajas asociados.");

        $p->delete();

        return true;
    }

    public function store(Request $request,$id=0)
    {
        # code...
        $u = User::find(auth()->user()->admin_id);
        $p = $u->sucursales()->find($id);

        if (!$p) {
            # code...
            if ($u->max_sucursales > 0 && $u->max_sucursales <= $u->sucursales()->count()) {
                # code...
                return null;
            }
            $p = new Sucursales();
        }

        $p->fill($request->all());
        $p->user_id = auth()->user()->admin_id;

        if ($request->file('file_1')) {
            # code...
            $file_1 = $request->file('file_1');

            $nom = auth()->user()->id . 'u' . time() . 'lg1.' . $file_1->getClientOriginalExtension();

            $file_1->move(public_path('files/img'),$nom);

            @unlink(public_path('files/img').'/'.$p->logofactura);

            $p->logofactura = $nom;
        }
        if ($request->file('file_2')) {
            # code...
            $file_2 = $request->file('file_2');

            $nom = auth()->user()->id . 'u' . time() . 'lg2.' . $file_2->getClientOriginalExtension();

            $file_2->move(public_path('files/img'),$nom);

            @unlink(public_path('files/img').'/'.$p->logoproforma);

            $p->logoproforma = $nom;
        }
        if ($request->file('file_3')) {
            # code...
            $file_3 = $request->file('file_3');

            $nom = auth()->user()->id . 'u' . time() . 'lg3.' . $file_3->getClientOriginalExtension();

            $file_3->move(public_path('files/img'),$nom);

            @unlink(public_path('files/img').'/'.$p->logomarcaagua);

            $p->logomarcaagua = $nom;
        }
        if ($request->file('file_4')) {
            # code...
            $file_4 = $request->file('file_4');

            $nom = auth()->user()->id . 'u' . time() . 'lg4.' . $file_4->getClientOriginalExtension();

            $file_4->move(public_path('files/img'),$nom);

            @unlink(public_path('files/img').'/'.$p->logocontrato);

            $p->logocontrato = $nom;
        }

        $p->secuencialproforma = FuncionesGenerales::secuenciales($p->secuencialproforma);

        $p->save();

        
        HistoriaController::setAccion(($id? 'Modificó':'Creó') . " la sucursal '" . $p->estab . "'.");

        return $p;
    }
}
