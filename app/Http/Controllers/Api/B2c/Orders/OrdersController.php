<?php

namespace App\Http\Controllers\Api\B2c\Orders;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Orders\ApiOrdersSearchRequest;
use App\Models\B2c\Order;
use App\Models\B2c\ShipmentItem;
use App\Models\B2c\Shipping;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Validator;

class OrdersController extends Controller
{
    private $json = [];

    public function __construct()
    {
        $this->json['orders'] = [];
    }

    public function index(ApiOrdersSearchRequest $ApiOrdersSearchRequest) : JsonResponse
    {
        $Validator = Validator::make(request()->all(), $ApiOrdersSearchRequest->rules(), $ApiOrdersSearchRequest->messages(), $ApiOrdersSearchRequest->attributes());
        
        if( $Validator->fails() ) return $this->responseError($Validator, Response::HTTP_BAD_REQUEST);
        
        $this->json['orders'] = $this->setOrders();
        
        return response()->json($this->json, Response::HTTP_OK);
    }

    private function setOrders() : array
    {
        $orders = [];
        
        foreach ( Order::all() as $Order )
        {
            $orders[] = $this->setOrder($Order);
        }
        
        return $orders;
    }

    private function setOrder(Order $Order) : Order
    {
        $Order->details   = $Order->order_details()->get();
        $Order->shippings = $this->setShippings($Order);
        
        return $Order;
    }

    private function setShippings(Order $Order) : array
    {
        $shippings = [];
        
        foreach ( $Order->shippings()->get() as $Shipping)
        {
            $shippings[] = $this->setShipping($Shipping);
        }
        
        return $shippings;
    }

    private function setShipping(Shipping $Shipping) : Shipping
    {
        foreach ( $Shipping->shipment_items()->get() as $ShipmentItem )
        {
            $Shipping->items = $Shipping->shipment_items()->get();
        }
        
        return $Shipping;
    }

}
