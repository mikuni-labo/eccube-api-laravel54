<?php

namespace App\Models\B2c;

use App\Models\B2c\AbstractB2cModel;

class OrderDetail extends AbstractB2cModel
{
    public $timestamps = false;
    public $incrementing = false;
    
    protected $table = 'dtb_order_detail';
    protected $primaryKey = 'order_id';
    
    protected $fillable = [
        //
    ];

    protected $hidden = [
        //
    ];

    protected $dates = [
        //
    ];

    protected $casts = [
        //
    ];

    /**
     * 属する受注情報
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo('App\Models\B2c\Order', 'order_id');
    }

}
