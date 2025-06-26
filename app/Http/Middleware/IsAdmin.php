<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if (Auth::check() && in_array(Auth::user()->usertype, ['Admin', 'Mentor', 'Superadmin'])) {
        //     return redirect()->back();
        // }

        if(Auth::user()->usertype != in_array(Auth::user()->usertype, ['Admin', 'Mentor', 'Superadmin'])){
            return redirect()->back();
        }
        // dd(Auth::user()->usertype);
        if(Auth::user()->usertype == null){
            return redirect()->back();
        }

        // abort(403, 'Unauthorized access.');
        return $next($request);

    }
}
