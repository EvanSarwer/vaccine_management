<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if($request->user()->role !== $role){
            // Clear all cookies
            foreach ($_COOKIE as $key => $value) {
                Cookie::forget($key);
            }

            // Clear session data
            Session::flush();

            // Clear cache headers
            $response = $next($request);
            $response->headers->remove('Cache-Control');
            $response->headers->remove('Pragma');
            $response->headers->remove('Expires');

            return redirect('/signin')->withHeaders($response->headers->all());
            // return redirect('/signin');
        }
        return $next($request);
    }
}
