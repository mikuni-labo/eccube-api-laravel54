<?php

namespace App\Models\B2c;

use App\Models\B2c\AbstractB2cModel;
use App\Scopes\AliveScope;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends AbstractB2cModel
{
    const CREATED_AT = 'create_date';
    const UPDATED_AT = 'update_date';
    
    public $timestamps = true;
    public $incrementing = true;
    
    protected $table = 'dtb_order';
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $primaryKey = 'order_id';
    
    protected $fillable = [
        //
    ];

    protected $hidden = [
        'order_temp_id',
    ];

    protected $dates = [
        'create_date',
        'update_date',
        'commit_date',
        'payment_date',
    ];

    protected $casts = [
        'order_id'         => 'int',
        'customer_id'      => 'int',
        'order_tel01'      => 'int',
        'order_tel02'      => 'int',
        'order_tel03'      => 'int',
        'order_zip01'      => 'int',
        'order_zip02'      => 'int',
        'order_zipcode'    => 'int',
        'order_country_id' => 'int',
        'order_pref'       => 'int',
        'order_sex'        => 'int',
        'order_birth'      => 'int',
        'order_job'        => 'int',
        'subtotal'         => 'int',
        'discount'         => 'int',
        'deliv_id'         => 'int',
        'deliv_fee'        => 'int',
        'charge'           => 'int',
        'use_point'        => 'int',
        'add_point'        => 'int',
        'birth_point'      => 'int',
        'tax'              => 'int',
        'total'            => 'int',
        'payment_total'    => 'int',
        'payment_id'       => 'int',
        'status'           => 'int',
        'device_type_id'   => 'int',
        'del_flg'          => 'int',
    ];

    /**
     * モデルの「初期起動」メソッド
     *
     * @return void
     */
    protected static function boot() : void
    {
        parent::boot();
        
        static::addGlobalScope(new AliveScope());
    }

    /**
     * 紐付く受注詳細
     * 
     * @return HasMany
     */
    public function order_details() : HasMany
    {
        return $this->hasMany('App\Models\B2c\OrderDetail','order_id');
    }

    /**
     * 紐付く配送先
     *
     * @return HasMany
     */
    public function shippings() : HasMany
    {
        return $this->hasMany('App\Models\B2c\Shipping','order_id');
    }

}
