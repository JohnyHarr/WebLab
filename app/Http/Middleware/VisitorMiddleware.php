<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Visitor;
use Jenssegers\Agent\Agent;

class VisitorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $agent = new Agent();

        Visitor::create([
            'page'       => $request->url(),
            'ip'         => $request->ip(),
            'hostname'   => gethostbyaddr($request->ip()),
            'browser'    => $agent->browser(),
        ]);

        return $next($request);
    }
}
