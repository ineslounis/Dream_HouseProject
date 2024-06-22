<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AgenceRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if((auth()->check() && auth()->user()->role === 'agence')){
            return $next($request);
          }
          return redirect()->route('dashboard')->with('error',' Vous n\'avez pas les autorisations');
    }
}
