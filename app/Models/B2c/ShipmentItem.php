<?php

namespace App\Models\B2c;

use App\Models\B2c\AbstractB2cModel;
use App\Models\B2c\Shipping;
use Illuminate\Database\Eloquent\Builder;


class ShipmentItem extends AbstractB2cModel
{
    public $timestamps = false;
    public $incrementing = false;
    
    protected $table = 'dtb_shipment_item';
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
        'shipping_id'         => 'int',
        'product_class_id'    => 'int',
        'order_id'            => 'int',
        'price'               => 'int',
        'quantity'            => 'int',
    ];

    /**
     * 属する配送先
     *
     * @return Builder
     */
    public function shipping() : Builder
    {
        $query = Shipping::query();
        $query->select('dtb_shipping.*');
        
        $query->join('dtb_shipment_item', function ($join){
            $join->on('dtb_shipping.order_id', '=', 'dtb_shipment_item.order_id');
            $join->on('dtb_shipping.shipping_id', '=', 'dtb_shipment_item.shipping_id');
        });
        
        $query->where('dtb_shipment_item.order_id',    '=', $this->order_id);
        $query->where('dtb_shipment_item.shipping_id', '=', $this->shipping_id);
        
        return $query;
    }

}
