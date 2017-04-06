<?php

namespace App\Models\B2c;

use App\Models\B2c\AbstractB2cModel;
use App\Scopes\AliveScope;

class Order extends AbstractB2cModel
{
    const CREATED_AT = 'create_date';
    const UPDATED_AT = 'update_date';
    
    public $timestamps = true;
    public $incrementing = true;
    
    protected $table = 'dtb_order';
    protected $primaryKey = 'order_id';
    protected $dateFormat = 'Y-m-d H:i:s';
    
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
        //
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
     * 紐付く受注詳細
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function order_details()
    {
        return $this->hasMany('App\Models\B2c\OrderDetail','order_id');
    }

}
