<?php

namespace App\Models\B2c;

use App\Models\B2c\AbstractB2cModel;

class OrderDetail extends AbstractB2cModel
{
    const CREATED_AT = 'create_date';
    const UPDATED_AT = 'update_date';
    
    public $timestamps = true;
    public $incrementing = true;
    
    protected $table = 'dtb_order_detail';
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
     * 属する受注情報
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo('App\Models\B2c\Order', 'order_id');
    }

}
