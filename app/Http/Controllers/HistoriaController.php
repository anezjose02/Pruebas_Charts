<?php

namespace App\Http\Controllers;

use App\Models\Historia;
use App\User;
use Illuminate\Http\Request;

class HistoriaController extends Controller
{
    //
    public function index()
    {
        $data = [
            'titulo'=> 'Historial de acciones',
            'tabla' => 't-historias',    
        ];

        return view("general",$data);
    }
    
    public function get()
    {
        # code...
        $u = User::find(auth()->user()->admin_id);
        return $u->historias()->where(function ($query)
        {
            if (@$_GET['buscarnombre']) {
                # code...
                $query->where('nombre','like','%'.@$_GET['buscarnombre'].'%');
            }
        })->orderBy(@$_GET['orderBy'] ? @$_GET['orderBy'] : 'id',@$_GET['orderDesc'] ? @$_GET['orderDesc'] : 'desc')->paginate(@$_GET['perPage']);
    }

    public static function setAccion($accion)
    {
        # code...
        $h = new Historia([
            'user_id'   => auth()->user()->admin_id,
            'accion'    => $accion,
            'email'     => auth()->user()->superuser?'SUPER USUARIO': auth()->user()->email,
            'name'      => auth()->user()->superuser?'SUPER USUARIO': auth()->user()->name,
            'rol'       => auth()->user()->rol . (auth()->user()->superuser?' | SUPER USUARIO':''),
            'sistema'   => auth()->user()->superuser?'SUPER USUARIO':auth()->user()->sistema,
        ]);
        $h->save();

        return;
    }
}
