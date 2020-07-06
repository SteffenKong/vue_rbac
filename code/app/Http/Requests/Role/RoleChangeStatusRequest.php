<?php

namespace App\Http\Requests\Role;

use App\Http\Requests\Login\BaseRequest;


/**
 * Class RoleChangeStatusRequest
 * @package App\Http\Requests\Role
 * 角色状态修改校验器
 */
class RoleChangeStatusRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required'
        ];
    }


    /**
     * @return array|string[]
     */
    public function messages()
    {
        return [
            'id.required' => '请传入角色id'
        ];
    }
}
