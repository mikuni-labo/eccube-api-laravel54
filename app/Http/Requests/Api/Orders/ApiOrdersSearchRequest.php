<?php

namespace App\Http\Requests\Api\Orders;

use App\Http\Requests\Request;

class ApiOrdersSearchRequest extends Request
{
    public function __construct()
    {
        //
    }

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'order_id'          => 'numeric|min:1|digits_between:1,10',
            'create_date:start' => 'date_format:Y-m-d H:i:s',
            'create_date:end'   => 'date_format:Y-m-d H:i:s',
            'update_date:start' => 'date_format:Y-m-d H:i:s',
            'update_date:end'   => 'date_format:Y-m-d H:i:s',
            'status'            => ['regex:/^[\d|\,]+$/'],
            'limit'             => 'numeric|min:1|digits_between:1,10',
//             'offset'            => 'numeric|digits_between:1,10',
            'page'              => 'numeric|min:1|digits_between:1,10',
            'sort'              => 'max:255|in:'. implode(',', $this->getAllowedSortFields()),
        ];
    }

    public function attributes()
    {
        return [
//             'order_id'   => '受注ID',
        ];
    }

    public function messages()
    {
        return [
            //
        ];
    }

    private function getAllowedSortFields()
    {
        return [
            'create_date:asc',
            'create_date:desc',
            'update_date:asc',
            'update_date:desc',
        ];
    }

}
