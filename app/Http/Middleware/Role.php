<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if(!Auth::check()){
            return redirect("/login");
        }

        $user = Auth::user();
        foreach ($user->roles as $rol) {
            if($rol->nombre == $role){
                return $next($request);
            }
        }

        //Auth::logout();
        return redirect("/admin")->with("mensaje", "No estás Autorizado para ver esta sección");
        
    }
}
