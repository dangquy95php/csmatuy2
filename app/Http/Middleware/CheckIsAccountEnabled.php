<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;

class CheckIsAccountEnabled
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
        // check if the account is disabled 
        // if it is disabled, log the user out and redirect to login
      
        if (! Auth::user()->is_account_enabled) {
            Auth::user()->is_account_enabled = true;
            Auth::user()->save();
            Auth::logout();

            return redirect(route('login'));
        }

        return $next($request);
    }
}
