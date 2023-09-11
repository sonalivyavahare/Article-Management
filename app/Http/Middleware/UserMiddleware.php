<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check()) {
            if(Auth::user()->user_role == '0')
            {
                return $next($request);
            } else {
                return redirect('admin/articles')->with('message', "Acccess denied as you are not user !");
            }
        } else
        {
            return redirect('/login');
        }
    }
}
