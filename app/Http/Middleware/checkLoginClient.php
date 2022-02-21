<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckLoginClient
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('client')->check()) {
            if (Auth::guard('client')->user()->emailVerify == 1) {
                return $next($request);
            }
        } elseif (Auth::guard('client')->user()->emailVerify == '') {
            Auth::guard('client')->logout();
            return redirect('client/login')->with('msg', 'Tài khoản chưa được kích hoạt. Vui lòng check mail.');
        } else {
            return redirect("client/login");
        }
    }
}
