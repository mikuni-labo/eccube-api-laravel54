<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function __construct()
    {
        //
    }
    
    public function test()
    {
        dd('test');
    }
}
