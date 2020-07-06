<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Login\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AdminChangeStatusRequest
 * @package App\Http\Requests\Admin
 * 管理员状态修改校验器
 */
class AdminChangeStatusRequest extends BaseRequest
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
