<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AdminDeleteRequest
 * @package App\Http\Requests\Admin
 * 管理员删除校验器
 */
class AdminDeleteRequest extends FormRequest
{

    public function rules()
    {
        return [
            'id' => 'required',
        ];
    }


    /**
     * @return array|string[]
     */
    public function messages()
    {
        return [
            'id.required' => '请传入管理员id',
        ];
    }
}
