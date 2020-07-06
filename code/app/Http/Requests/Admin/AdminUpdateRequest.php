<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminUpdateRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required',
            'account' => 'required|unique:admin',
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
            'id.required' => '请传入管理员id',
            'account.required' => '请填写账号',
            'account.unique' => '账号已存在',
            'email.required' => '请填写邮箱',
            'email.unique' => '邮箱已存在',
            'phone.required' => '请填写手机',
            'phone.unique' => '手机已存在',
            'isCan.in' => '是否开启通知取值异常'
        ];
    }
}
