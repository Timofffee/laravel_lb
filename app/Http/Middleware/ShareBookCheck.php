<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Book;
use App\libShare;

class ShareBookCheck
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
        $book = Book::find($request->id);
        if (($book && $book->shared) or 
            (Auth::check() && 
                (Auth::user()->id == $book->owner or
                libShare::getShare($book->owner, Auth::user()->id)))
        ) {
            return $next($request);
        } else {
            abort(404);
        }
        
    }
}
