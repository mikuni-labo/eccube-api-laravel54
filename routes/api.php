<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * @var \Illuminate\Routing\Router $router
 */
$router->middleware('api')
        ->namespace('Api')
        ->group( function () use ($router)
{
    /**
     * Orders
     */
    
    /**
     * Products
     */
    
    /**
     * Customers
     */
    
    /**
     * Users (Test)
     */
    $router->namespace('Users')
           ->prefix('users')
           ->group( function () use ($router)
    {
        $router->name('api.users')->get('/', UsersController::class. '@index');
    });
    
   /**
    * test
    */
    $router->name('api.test')->get('test', TestController::class. '@test');
});
