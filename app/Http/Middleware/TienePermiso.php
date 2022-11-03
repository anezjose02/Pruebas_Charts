<?php

namespace App\Http\Middleware;

use Closure;

class TienePermiso
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$permisos)
    {
        if ($request->user()->superuser || $request->user()->evaluarPermisos($permisos)) {
            # code...
            return $next($request);
        }

        return redirect("/home")->with("warning","No tienes permisos para acceder a esa ruta.");
    }
}
