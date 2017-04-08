<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Request;

class ApiAuthRequest extends Request
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
            'access_token'                  => 'required|max:255|api_access_token',
        ];
    }

    public function attributes()
    {
        return [
            'access_token'                  => 'アクセストークン',
        ];
    }

    public function messages()
    {
        return [
            'access_token.api_access_token' => trans('validation.custom.access_token.api_access_token'),
        ];
    }

}
