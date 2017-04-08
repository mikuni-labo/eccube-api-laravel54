<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;

class UsersController extends Controller
{
    public function __construct()
    {
        //
    }
    
    public function index()
    {
        return response()->json([
            'users' => User::all(),
        ]);
    }
}
