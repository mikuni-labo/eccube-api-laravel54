<?php

namespace App\Http\Middleware;

use App\Http\Requests\Api\ApiAuthRequest;
use Closure;
use Symfony\Component\HttpFoundation\Response;
use Validator;

class ApiAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $ApiAuthRequest = new ApiAuthRequest;
        
        $Validator = Validator::make($request->all(), $ApiAuthRequest->rules(), $ApiAuthRequest->messages(), $ApiAuthRequest->attributes());
        
        if( $Validator->fails() )
        {
            $code = Response::HTTP_UNAUTHORIZED;
            
            return response()->json([
                'errors' => [
                    'response' => [
                        'code'     => $code,
                        'message'  => Response::$statusTexts[$code],
                    ],
                    'messages' => $Validator->errors(),
                ],
            ], $code);
        }
        
        return $next($request);
    }
}
