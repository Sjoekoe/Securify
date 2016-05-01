<?php
namespace App\Http\Middleware;

use Closure;

class AuthAccount
{
    /**
     * @param $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! auth()->checkTeam()) {
            return redirect()->route('accounts');
        }

        return $next($request);
    }
}
