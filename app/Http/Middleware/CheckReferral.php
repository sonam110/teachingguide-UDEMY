<?php

namespace App\Http\Middleware;
use Illuminate\Http\Response;
use Cookie;
use Closure;

class CheckReferral
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
         if( $request->hasCookie('referral')) {
             return $next($request);
         }
         else {
            $source = $request->query('utm_source');
            $medium = $request->query('utm_medium');

             if( $source && $source == 'affiliate' && $medium ) {
                 return redirect($request->fullUrl())->withCookie(cookie()->forever('referral', $medium));
             }
         }
         return $next($request);
     }
}
