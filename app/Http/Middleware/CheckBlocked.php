<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckBlocked
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    // public function handle(Request $request, Closure $next)
    // {
    //     if (auth()->check() && (auth()->user()->is_block)) {
    //         $banned = Auth::user()->is_block == '1';
    //         Auth::logout();
    //         if($banned == 1)
    //         {
    //             $message = "Your Account is suspended, please contact Admin.";
    //         }
    //         return redirect()->route('login')->with('status',$message);
    //         $request->session()->invalidate();
    //         $request->session()->regenerateToken();
    //     }
    //     // return $next($request);
    // }
    public function handle(Request $request, Closure $next)
    {
        if(auth()->check() && (auth()->user()->is_block == 1)){
            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect()->route('login')->with('error', 'Your Account is suspended, please contact Admin.');

        }

        return $next($request);
    }
}
