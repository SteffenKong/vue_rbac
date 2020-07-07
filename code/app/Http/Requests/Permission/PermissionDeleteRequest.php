<?php

namespace App\Http\Requests\Permission;

use App\Http\Requests\Login\BaseRequest;

/**
 * Class PermissionDeleteRequest
 * @package App\Http\Requests\Permission
 * 权限删除校验器
 */
class PermissionDeleteRequest extends BaseRequest
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
            'id.required' => '请传入权限id'
        ];
    }
}
