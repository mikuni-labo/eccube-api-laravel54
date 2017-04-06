<?php

namespace App\Http\Controllers\Api\B2c\Orders;

use App\Http\Controllers\Controller;
use App\Models\B2c\Order;

class OrdersController extends Controller
{
    public function __construct()
    {
        //
    }
    
    public function index()
    {
//         foreach ( Order::all() as $Order )
//         {
//             dd( $Order->order_details()->get() );
//         }
        
        return response()->json([
            'orders' => Order::all(),
        ]);
    }
}
