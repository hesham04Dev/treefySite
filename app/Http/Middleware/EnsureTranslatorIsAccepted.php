<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTranslatorIsAccepted
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        if (auth()->check() && auth()->user()->isTranslator() && auth()->user()->translator->is_accepted) {
            return $next($request);
        }

        abort(403, 'Waiting to Accept your Request');
    }
}
