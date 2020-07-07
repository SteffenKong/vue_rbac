<?php


namespace App\Model\entity;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 * @package App\Admin\entity
 * 角色模型
 */
class Role extends Model
{
    protected $table = 'role';

    protected $fillable = [
        'id',
        'role_name',
        'status',
        'created_at',
        'updated_at'
    ];
}
