<?php

namespace App\Http\Middleware;

use Closure;

use Auth;

class AdminRedirectIfAuthenticated
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
        // trường hợp đã login -> nhảy sang trang adminhome
        if(Auth::guard('admin')->check()) {
            return redirect('admin/dashboard');
        }

        return $next($request);
    }
}
