<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Login\BaseRequest;

/**
 * Class AdminAddRequest
 * @package App\Http\Requests\Admin
 * 管理员添加校验器
 */
class AdminAddRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'account' => 'required|unique:admin',
            'password' => 'required',
            'email' => 'required|unique:admin_info',
            'phone' => 'required|unique:admin_info',
            'isCan' => 'in:0,1'
        ];
    }


    /**
     * @return array|string[]
     */
    public function messages()
    {
        return [
            'account.required' => '请填写账号',
            'account.unique' => '账号已存在',
            'password.required' => '请填写密码',
            'email.required' => '请填写邮箱',
            'email.unique' => '邮箱已存在',
            'phone.required' => '请填写手机',
            'phone.unique' => '手机已存在',
            'isCan.in' => '是否开启通知取值异常'
        ];
    }
}
