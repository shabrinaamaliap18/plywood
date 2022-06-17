<?php

namespace App\Http\Middleware;

use Closure;

class AuthenticateAdmin
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
        $user = auth()->user();

        if($user) {
            if($user->role !== 'admin') {
                abort(403);
            }
        } else {
            abort(403);
        }

        return $next($request);
    }
}
