<?php

namespace App\Models\B2c;

use App\Models\B2c\AbstractB2cModel;
use App\Models\B2c\ShipmentItem;
use App\Scopes\AliveScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Shipping extends AbstractB2cModel
{
    const CREATED_AT = 'create_date';
    const UPDATED_AT = 'update_date';
    
    public $timestamps = true;
    public $incrementing = true;
    
    protected $table = 'dtb_shipping';
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $primaryKey = 'order_id';
    
    protected $fillable = [
        //
    ];

    protected $hidden = [
        //
    ];

    protected $dates = [
        'create_date',
        'update_date',
        'shipping_date',
        'shipping_commit_date',
    ];

    protected $casts = [
        'shipping_id'         => 'int',
        'order_id'            => 'int',
        'shipping_tel01'      => 'int',
        'shipping_tel02'      => 'int',
        'shipping_tel03'      => 'int',
        'shipping_fax01'      => 'int',
        'shipping_fax02'      => 'int',
        'shipping_fax03'      => 'int',
        'shipping_country_id' => 'int',
        'shipping_pref'       => 'int',
        'shipping_zip01'      => 'int',
        'shipping_zip02'      => 'int',
        'shipping_zipcode'    => 'int',
        'time_id'             => 'int',
        'rank'                => 'int',
        'del_flg'             => 'int',
    ];

    /**
     * 初期起動
     *
     * @return void
     */
    protected static function boot() : void
    {
        parent::boot();
        
        static::addGlobalScope(new AliveScope());
    }

    /**
     * 属する受注情報
     * 
     * @return BelongsTo
     */
    public function order() : BelongsTo
    {
        return $this->belongsTo('App\Models\B2c\Order', 'order_id');
    }

    /**
     * 紐付く配送商品
     * 
     * @return Builder
     */
    public function shipment_items() : Builder
    {
        $query = ShipmentItem::query();
        $query->select('dtb_shipment_item.*');
        
        $query->join('dtb_shipping', function ($join){
            $join->on('dtb_shipping.order_id', '=', 'dtb_shipment_item.order_id');
            $join->on('dtb_shipping.shipping_id', '=', 'dtb_shipment_item.shipping_id');
        });
        
        $query->where('dtb_shipment_item.order_id',    '=', $this->order_id);
        $query->where('dtb_shipment_item.shipping_id', '=', $this->shipping_id);
        
        return $query;
    }

}
