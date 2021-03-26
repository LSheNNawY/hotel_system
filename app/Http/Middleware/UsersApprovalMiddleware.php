<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UsersApprovalMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            if (!auth()->user()->approved) {
                auth()->logout();

                return redirect()->route('login')
                    ->with('message', 'You account needs admin\'s approval, you will receive an email once approved');
            }
        }
        return $next($request);
    }
}
