<?php

namespace App\Http\Controllers\Api\B2c\Orders;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Orders\ApiOrdersSearchRequest;
use App\Services\Api\Orders\ApiOrdersService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Validator;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->json['orders'] = [];
    }

    public function index(ApiOrdersSearchRequest $ApiOrdersSearchRequest, ApiOrdersService $ApiOrdersService) : JsonResponse
    {
        $Validator = Validator::make(request()->all(), $ApiOrdersSearchRequest->rules(), $ApiOrdersSearchRequest->messages(), $ApiOrdersSearchRequest->attributes());
        
        if( $Validator->fails() ) return $this->responseError($Validator, Response::HTTP_BAD_REQUEST);
        
        $parameters = request()->all();
        
        $ApiOrdersService->buildJson($parameters);
        
        return response()->json($ApiOrdersService->getJson(), Response::HTTP_OK);
    }

}
