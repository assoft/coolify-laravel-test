<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleBasedRedirectMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()){
//            $request->is('dashboard') &&
//            !session()->has('role_redirect_checked')) {
//
//            $user = auth()->user();
//            session()->put('role_redirect_checked', true);

            if ($request->user()->hasAnyRole('admin', 'moderator')) {
                \Log::info('Middleware redirect to admin');
                return redirect('/admin');
            }
        }

        return $next($request);
    }
}
