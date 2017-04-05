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
//     protected $dateFormat = 'r';// 小数点以下の値を持つtimestamp型のカラムだとparse出来ずにエラーを吐く・・
    
    protected $fillable = [
        
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

}
