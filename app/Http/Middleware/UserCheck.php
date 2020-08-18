<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class UserCheck
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
        if (!User::find($request->id)) {
            abort(404);
        }
        return $next($request);
    }
}
