<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Globales;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function documentacion()
    {
        # code...
        return view('documentacion');
    }

    public function globales()
    {
        # code...
        if (!auth() || !auth()->user()->superuser) {
            # code...
            return redirect("/home");
        }

        $data = [
            'globales' => Globales::get()
        ];

        return view("globales",$data);
    }

    public function setGlobales(Request $request)
    {
        # code...
        if (!auth() || !auth()->user()->superuser) {
            # code...
            return redirect("/home");
        }

        $g =  Globales::get();

        foreach ($g as $gl) {
            # code...
            if ($gl->slug =="url_logo") {
                # code...
                @unlink(public_path().'/'.$gl->valor);

                $img = $request->file($gl->slug);

                $nm = time() . "glb123fac".$gl->id."x." . $img->getClientOriginalExtension();

                $img->move(public_path(),$nm);

                $gl->valor = '/'.$nm;
            } else {
                # code...
                $gl->valor = $request[$gl->slug];
            }
            

            $gl->save();
        }

        return back()->with("success","Variables globales actualizadas correctamente.");
    }

    public function cardsD(Request $request){
        if($request->ajax())
        {
            $user_id =  Auth::user()->id;
            //Facturas
            $facturas = DB::table('documentos')
            ->where('user_id', $user_id)
            ->where('estado', 'PENDIENTE')
            //->whereNull('estado')
            ->get();
            //Documentos Autorizados
            $documentos_autorizados = DB::table('documentos')
            ->where('user_id', $user_id)
            ->where('estado', 'AUTORIZADO')
            ->get();
            //Documentos Rechazados
            $documentos_rechazados = DB::table('documentos')
            ->where('user_id', $user_id)
            ->where('estado', 'RECHAZADO')
            ->get();
            //Documentos Anulados
            $documentos_anulados = DB::table('documentos')
            ->where('user_id', $user_id)
            ->where('estado', 'ANULADOS')
            ->get();

            $sql = [
                "facturas" => $facturas,
                "documentos_autorizados" => $documentos_autorizados,
                "documentos_rechazados" => $documentos_rechazados,
                "documentos_anulados" => $documentos_anulados,
                
                ];
            
        
         if ($sql) {
            return ($sql);
            }
        }
    }

    public function progressbar(Request $request){
        if($request->ajax())
        {
            $user_id =  Auth::user()->id;
            $from=$request->from;
            $to=$request->to;
            //Facturas
            $facturas = DB::table('documentos')
            ->where('user_id', $user_id)
            ->where('venta_id', '>', 0)
            ->where('created_at','>=', $from)
            ->whereDate('created_at', '<=', $to)
            ->get();
            //Retenciones
            $retenciones = DB::table('documentos')
            ->where('user_id', $user_id)
            ->where('retenciones_id', '>', 0)
            ->where('created_at','>=', $from)
            ->whereDate('created_at', '<=', $to)
            ->get();
            //Notas de Credito
            $nota_credito = DB::table('documentos')
            ->where('user_id', $user_id)
            ->where('notacredito_id', '>', 0)
            ->where('created_at','>=', $from)
            ->whereDate('created_at', '<=', $to)
            ->get();
            //Notas de Debito
            $nota_debito = DB::table('documentos')
            ->where('user_id', $user_id)
            ->where('notadebito_id', '>', 0)
            ->where('created_at','>=', $from)
            ->whereDate('created_at', '<=', $to)
            ->get();
            //Guias Remision
            $guia_remision = DB::table('documentos')
            ->where('user_id', $user_id)
            ->where('guiaremision_id', '>', 0)
            ->where('created_at','>=', $from)
            ->whereDate('created_at', '<=', $to)
            ->get();
            //Liquidaciones
            $liquidacion = DB::table('documentos')
            ->where('user_id', $user_id)
            ->where('liquidacion_id', '>', 0)
            ->where('created_at','>=', $from)
            ->whereDate('created_at', '<=', $to)
            ->get();
            //Array con las consultas
            $sql = [
                "facturas" => $facturas,
                "retenciones" => $retenciones,
                "nota_credito" => $nota_credito,
                "nota_debito" => $nota_debito,
                "guia_remision" => $guia_remision,
                "liquidacion" => $liquidacion,
                ];
         if ($sql) {
            return ($sql);
            }
        }
    }
}