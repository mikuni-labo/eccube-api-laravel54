<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function welcome()
    {
        return view('welcome');
    }

    protected function responseError(Validator $Validator, int $code) : JsonResponse
    {
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

}
