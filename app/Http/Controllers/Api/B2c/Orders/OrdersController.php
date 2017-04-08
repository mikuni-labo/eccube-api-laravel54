<?php

namespace App\Http\Controllers\Api\B2c\Orders;

use App\Http\Controllers\Controller;
use App\Models\B2c\Order;
use App\Models\B2c\OrderDetail;
use App\Models\B2c\ShipmentItem;
use App\Models\B2c\Shipping;
use Illuminate\Http\JsonResponse;

class OrdersController extends Controller
{
    private $json = [];

    public function __construct()
    {
        //
    }

    public function index() : JsonResponse
    {
        $this->json['orders'] = [];
        $this->json['orders'][] = $this->setOrders();
        
        return response()->json($this->json, 200);
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

    private function setOrder(Order $Order) : array
    {
        $order = $Order->toArray();
        
        $order['details']   = $this->setDetails($Order);
        $order['shippings'] = $this->setShippings($Order);
        
        return $order;
    }

    private function setDetails(Order $Order) : array
    {
        $details = [];
//         return $Order->order_details()->get()->toArray();// これでも成立する
        
        foreach ( $Order->order_details()->get() as $Detail)
        {
            $details[] = $this->setDetail($Detail);
        }
        
        return $details;
    }

    private function setDetail(OrderDetail $Detail) : array
    {
        return $Detail->attributesToArray();
    }

    private function setShippings(Order $Order) : array
    {
        $shippings = [];
//         return $Order->shippings()->get()->toArray();// これでも成立する
        
        foreach ( $Order->shippings()->get() as $Shipping)
        {
            $shippings[] = $this->setShipping($Shipping);
        }
        
        return $shippings;
    }

    private function setShipping(Shipping $Shipping) : array
    {
        $shipping = $Shipping->attributesToArray();
        
        foreach ( $Shipping->shipment_items()->get() as $ShipmentItem )
        {
            $shipping['items'][] = $this->setShipmentItem($ShipmentItem);
        }
        
        return $shipping;
    }

    private function setShipmentItem(ShipmentItem $ShipmentItem) : array
    {
        return $ShipmentItem->attributesToArray();
    }

}
