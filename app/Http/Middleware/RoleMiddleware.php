<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next ,$role): Response
    {
        if(auth()->check()&&auth()->user()->role===$role){
        return $next($request);
        }
        abort(403, 'Access Denied');
    }
}
//     public function handle($request, Closure $next, $role)
// {
//     if (!auth()->check()) {
//         // Allow unauthenticated users for specific routes
//         if ($request->route()->named('home')) {
//             return $next($request);
//         }
//         return redirect()->route('login'); // Or handle unauthenticated access as needed
//     }

//     if (auth()->user()->role !== $role) {
//         abort(403, 'Unauthorized action.');
//     }

//     return $next($request);
// }

// }
