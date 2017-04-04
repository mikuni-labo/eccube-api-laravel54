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
    Route::namespace('Users')
       ->prefix('users')
       ->group( function ()
    {
        Route::name('api.users')->get('/', UsersController::class. '@index');
    });
    
   /**
    * test
    */
    Route::name('api.test')->get('test', TestController::class. '@test');
});
