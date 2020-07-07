<?php

namespace App\Model\entity;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Permission
 * @package App\Admin\entity
 * 权限模型
 */
class Permission extends Model
{

    protected $table = 'permission';

    protected $fillable = [
        'id',
        'name',
        'pid',
        'path',
        'slug',
        'is_menu',
        'created_at',
        'updated_at'
    ];
}
