<?php

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

Route::middleware('api')
    ->namespace('Api')
    ->group( function ()
{
    /**
     * B2C
     */
    Route::namespace('B2c')
        ->prefix('b2c')
        ->group( function ()
    {
        /**
         * Orders
         */
        Route::namespace('Orders')
            ->prefix('orders')
            ->group( function ()
        {
            Route::name('api.b2c.orders')->get('/', OrdersController::class. '@index');
        });
        
        /**
         * Products
         */
        
        /**
         * Customers
         */
    });
    
   /**
    * test
    */
    Route::name('api.test')->get('test', TestController::class. '@test');
    
    Route::name('api.users')->get('users', UsersController::class. '@index');
});
