<?php

namespace App\Http\Controllers\Api\B2c\Orders;

use App\Http\Controllers\Controller;
use App\Models\B2c\Order;

class OrdersController extends Controller
{
    private $data = [];
    
    public function __construct()
    {
        //
    }
    
    public function index()
    {
        $this->data['orders'] = [];
        
        $this->setOrders();
        
        return response()->json($this->data);
    }

    private function setOrders()
    {
        foreach ( Order::all() as $Order )
        {
            dd( $Order->shippings()->get() );
            
            $Order->orderDetails = $Order->order_details()->get();
            $this->data['orders'][] = $Order;
        }
    }

}
