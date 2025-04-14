<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

     public function handle($request, Closure $next, $role)
     {
         if (Auth::check() && Auth::user()->myagenda_user_role == $role) {
             return $next($request);
         }
         return response()->view('error.hak_akses', [], 403);
     }
     
}
