<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Login\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AdminChangePasswordRequest
 * @package App\Http\Requests\Admin
 * 编辑密码的校验器
 */
class AdminChangePasswordRequest extends BaseRequest
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
            'password' => 'required'
        ];
    }


    /**
     * @return array|string[]
     */
    public function messages()
    {
        return [
            'id.required' => '请传入管理员id',
            'password.required' => '请填写新密码'
        ];
    }
}
