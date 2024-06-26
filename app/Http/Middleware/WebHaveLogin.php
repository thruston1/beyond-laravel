<?php

namespace App\Http\Middleware;

use Closure;

class WebHaveLogin
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
        if(!$request->session()->has('agent_id'))
            return $next($request);
        // return to web login
        return redirect()->route('web.logout');
    }
}
