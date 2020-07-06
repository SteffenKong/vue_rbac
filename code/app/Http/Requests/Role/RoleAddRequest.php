<?php

namespace App\Http\Requests\Role;

use App\Http\Requests\Login\BaseRequest;


/**
 * Class RoleAddRequest
 * @package App\Http\Requests\Role
 * 角色添加校验器
 */
class RoleAddRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'roleName' => 'required'
        ];
    }


    /**
     * @return array|string[]
     */
    public function messages()
    {
        return [
            'roleName.required' => '请填写角色名称'
        ];
    }
}
