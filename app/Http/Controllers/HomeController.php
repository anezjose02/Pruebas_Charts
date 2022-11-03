<?php

namespace App\Http\Controllers;

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
}
