<?php

namespace App\Http\Middleware;

use App\Exceptions\CustomException;
use App\Exceptions\TokenNotProvidedException;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Claims\Custom;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JwtTokenMiddleware
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
        
        $user = JWTAuth::parseToken()->authenticate();

        if(!$user){
            throw new CustomException("Error Processing Request", 1);
        }
        
        return $next($request);
    }
}
