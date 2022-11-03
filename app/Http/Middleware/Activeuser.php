<?php

namespace App\Http\Middleware;

use Closure;

class Activeuser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user()->activo || $request->user()->superuser) {
            # code...
            return $next($request);
        }

        return redirect("/home")->with("danger","Tu usuario se encuentra desactivado.");
    }
}
