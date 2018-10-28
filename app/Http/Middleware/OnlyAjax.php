<?php 

namespace App\Http\Middleware;

class OnlyAjax
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        if ( ! $request->ajax())
            return redirect('/home');

        return $next($request);
    }
}