<?php

namespace App\Models\B2c;

use App\Models\B2c\AbstractB2cModel;
use App\Scopes\AliveScope;

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
     * モデルの「初期起動」メソッド
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        
        static::addGlobalScope(new AliveScope());
    }

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
