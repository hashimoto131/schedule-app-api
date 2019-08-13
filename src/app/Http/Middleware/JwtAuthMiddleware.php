<?php
namespace App\Http\Middleware;

use Closure;
use App\Facades\JwtAuth;

class JwtAuthMiddleware
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
        if (is_null($request->header('Authorization'))) {
            abort(401, config('error.auth.error'));
        }
        JwtAuth::tokenDecode($request->header('Authorization'));
        return $next($request);
    }
}
