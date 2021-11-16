<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Firebase\JWT\Key;
use Firebase\JWT\JWT;


class JWTTokenValid
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
        $header = $request->header('Authentication');
        $token = trim($header,"Bearer");
        $key = env('JWT_SECRET', 'SECRET');
        $alg = env('JWT_ALGORITHM', 'HS256');
        try {
            $payload = JWT::decode(trim($token, " "), new Key($key, $alg));
            $request->perfil = (array) $payload;
            return $next($request);
        }
        catch(\Exception $e) {
            return response()->json(["message"=>"Invalid token"],201);
        }
        
    }
}
