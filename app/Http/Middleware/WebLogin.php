<?php

namespace App\Http\Middleware;

use App\Codes\Models\UserAgent;
use Closure;

class WebLogin
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

        

        if($request->session()->has('agent_id'))
        {    
            $agentId = $request->session()->get('agent_id');
            $getAgent = UserAgent::where('id', $agentId)->first();
            if(!$getAgent){
                session()->flush();
                return redirect()->route('web.logout');
            }
            $request->attributes->add([
                '_agent' => $getAgent
            ]);
            return $next($request);
        }
        else{
            session()->flush();
            return redirect()->route('web.logout');
        }
        
    }
}
