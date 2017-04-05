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
        return response()->json([
            'orders' => Order::all(),
        ]);
    }
}
