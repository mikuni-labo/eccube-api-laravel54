<?php

namespace App\Models\B2c;

use App\Models\B2c\AbstractB2cModel;

class Order extends AbstractB2cModel
{
    protected $table = 'dtb_order';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
}
