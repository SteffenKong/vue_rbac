<?php

namespace App\Http\Requests\Role;

use App\Http\Requests\Login\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class RoleEditRequest
 * @package App\Http\Requests\Role
 * 角色编辑校验器
 */
class RoleEditRequest extends BaseRequest
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
            'roleName' => 'required'
        ];
    }


    /**
     * @return array|string[]
     */
    public function messages()
    {
        return [
            'id.required' => '请传入角色id',
            'roleName.required' => '请填写角色名称'
        ];
    }

}
