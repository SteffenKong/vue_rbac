<?php

namespace App\Http\Requests\Role;

use App\Http\Requests\Login\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;


/**
 * Class RoleDeleteRequest
 * @package App\Http\Requests\Role
 * 角色删除校验器
 */
class RoleDeleteRequest extends BaseRequest
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
