<?php

namespace App\Models\B2c;

use App\Models\B2c\AbstractB2cModel;
use App\Scopes\AliveScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class Order extends AbstractB2cModel
{
    const CREATED_AT = 'create_date';
    const UPDATED_AT = 'update_date';
    
    public $timestamps = true;
    public $incrementing = true;
    
    protected $table = 'dtb_order';
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $primaryKey = 'order_id';
    protected $perPage = 10;
    
    protected $fillable = [
        //
    ];

    protected $hidden = [
        'order_temp_id',
    ];

    protected $dates = [
        'create_date',
        'update_date',
        'order_birth',
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
     * 検索
     * 
     * @param array $search
     * @return Builder
     */
    public static function search(array $search) : LengthAwarePaginator
    {
        $query = self::query();
        $query->select('dtb_order.*');
        
        // 注文ID
        if( isset($search['order_id']) ) {
            $query->where('dtb_order.order_id', '=', $search['order_id']);
        }
        
        // 受注ステータス
        if( !empty($search['status']) ) {
            $query->where(function ($q) use ($search) {
                foreach ( explode(',', $search['status']) as $status ) {
                    if( is_numeric($status) ) {
                        $q->orWhere('dtb_order.status', '=', $status);
                    }
                }
            });
        }
        
        // 購入日開始
        if( !empty($search['create_date:start']) ) {
            $query->where('dtb_order.create_date', '>=', $search['create_date:start']);
        }
        
        // 購入日終了
        if( !empty($search['create_date:end']) ) {
            $query->where('dtb_order.create_date', '<=', $search['create_date:end']);
        }
        
        // 更新日開始
        if( !empty($search['update_date:start']) ) {
            $query->where('dtb_order.update_date', '>=', $search['update_date:start']);
        }
        
        // 更新日終了
        if( !empty($search['update_date:end']) ) {
            $query->where('dtb_order.update_date', '<=', $search['update_date:end']);
        }
        
        // 最大取得件数
        $limit = 20;
        if( isset($search['limit']) ) {
            $limit = intVal($search['limit']);
        }
//         $query->take($limit);

        // オフセット（ページネートを併用する場合はカレントページがオフセットの代わりになる）
//         $offset = 0;
//         if( isset($search['offset']) ) {
//             $offset = intVal($search['offset']);
//         }
//         $query->skip($offset);
        
        // 現在ページ
        $page = 1;
        if( isset($search['page']) ) {
            $page = intVal($search['page']);
        }
        
        // ソート条件
        if( !empty($search['sort']) ) {
            $sort = explode(':', $search['sort']);
            $query->orderBy("dtb_order.{$sort[0]}", $sort[1]);
        }
        else {
            $query->orderBy('dtb_order.update_date', 'DESC');
        }
        
        // 削除フラグ
        $query->where('dtb_order.del_flg', '=', 0);
        
        return $query->paginate($limit, '*', 'page', $page);
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

    /**
     * アクセサ定義
     */
    public function getCreateDateAttribute($value)
    {
        return $value ? \Carbon::parse($value)->format('c') : null;
    }

    public function getUpdateDateAttribute($value)
    {
        return $value ? \Carbon::parse($value)->format('c') : null;
    }

    public function getOrderBirthAttribute($value)
    {
        return $value ? \Carbon::parse($value)->format('c') : null;
    }

    public function getCommitDateAttribute($value)
    {
        return $value ? \Carbon::parse($value)->format('c') : null;
    }

    public function getPaymentDateAttribute($value)
    {
        return $value ? \Carbon::parse($value)->format('c') : null;
    }

}
