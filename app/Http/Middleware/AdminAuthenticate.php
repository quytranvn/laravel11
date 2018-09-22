<?php

namespace App\Http\Middleware;

use Closure;

use Auth;

class AdminAuthenticate
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
        // trường hợp chưa login ->nhảy về trang login
        if(!Auth::guard('admin')->check()) {
            return redirect('admin/login');
        }
        
        return $next($request);
    }
}
