<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminCheck
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
        if (auth('admin')->user()->is_active == 0) {
            auth('admin')->logout();
            return back()->with('error','لقد تم حظر الحساب الخاص بك من قبل الادارة');
//            session()->flush();
//            return redirect('/');
        }
        return $next($request);
    }
}
