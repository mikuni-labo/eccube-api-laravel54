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
            'order_id'   => 'numeric|digits_between:1,10',
        ];
    }

    public function attributes()
    {
        return [
            'order_id'   => '受注ID',
        ];
    }

    public function messages()
    {
        return [
            //
        ];
    }

}
