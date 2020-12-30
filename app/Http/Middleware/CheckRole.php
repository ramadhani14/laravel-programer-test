<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->name == 'admin') {
            return $next($request);
        }else{
            return redirect()->route('crud');
            // return response()->json('Anda tidak memiliki akses ke halaman ini!');
        }
        
    }
}
