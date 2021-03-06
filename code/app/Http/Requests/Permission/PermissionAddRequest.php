<?php

namespace App\Http\Requests\Permission;

use App\Http\Requests\Login\BaseRequest;

/**
 * Class PermissionAddRequest
 * @package App\Http\Requests\Permission
 * 权限添加校验器
 */
class PermissionAddRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'slug' => 'required',
//            'path' => 'required',
            'isMenu' => 'required|in:1,0',
        ];
    }


    /**
     * @return string[]
     */
    public function message() {
        return [
            'name.required' => '请填写权限名',
            'slug.required' => '请填写前端标识',
//            'path.required' => '请填写后端标识',
            'isMenu.required' => '请选择菜单类型',
            'isMenu.in' => '菜单类型值异常'
        ];
    }
}
