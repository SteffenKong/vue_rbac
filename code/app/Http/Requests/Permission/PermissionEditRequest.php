<?php

namespace App\Http\Requests\Permission;



use App\Http\Requests\Login\BaseRequest;

/**
 * Class PermissionEditRequest
 * @package App\Http\Requests\Permission
 * 权限编辑校验器
 */
class PermissionEditRequest extends BaseRequest
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
            'name' => 'required',
            'slug' => 'required',
            'isMenu' => 'required|in:1,0',
        ];
    }


    /**
     * @return array|string[]
     */
    public function messages()
    {
        return  [
            'id.required' => '请传入权限id',
            'name.required' => '请填写权限名',
            'slug.required' => '请填写前端标识',
            'isMenu.required' => '请选择菜单类型',
            'isMenu.in' => '菜单类型值异常'
        ];
    }
}
