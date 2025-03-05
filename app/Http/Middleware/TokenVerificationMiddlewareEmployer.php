<?php

namespace App\Http\Middleware;

use App\Helper\JWTToken;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenVerificationMiddlewareEmployer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $tokenEmployer=$request->cookie('tokenEmployer');
        $result=JWTToken::VerifyTokenEmloyer($tokenEmployer);

        if($result == "unauthorized"){
            return redirect('/employer-login');
        }
        else{
            $request->headers->set('email',$result->employerEmail);
            $request->headers->set('id',$result->employerID);
            $request->headers->set('designation',$result->designation);
            return $next($request);
        }

    }
}
