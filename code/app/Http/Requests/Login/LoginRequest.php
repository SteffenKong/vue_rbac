<?php

namespace App\Http\Requests\Login;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class LoginRequest
 * @package App\Http\Requests\Login
 * 登录校验器
 */
class LoginRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'account' => 'required',
            'password' => 'required',
        ];
    }


    /**
     * @return array|string[]
     * 校验错误消息提示输出
     */
    public function messages()
    {
        return [
            'account.required' => '请填写账号',
            'password.required' => '请填写密码',
        ];
    }
}
