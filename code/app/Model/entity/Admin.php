<?php

namespace App\Model\entity;

use App\Model\entity\AdminInfo;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Admin
 *
 * @package App\Model
 * @property int $id
 * @property string $account 账户
 * @property string $password 密码
 * @property string $salt 加密盐值
 * @property int $status 状态 0 - 禁用 1 - 启用
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Model\AdminInfo|null $adminInfo
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin whereAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin whereSalt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin whereUpdatedAt($value)
 * @mixin \Eloquent
 * 管理员模型
 */
class Admin extends Model
{

    protected $table = 'admin';

    protected $fillable = [
        'id',
        'account',
        'password',
        'salt',
        'status',
        'created_at',
        'updated_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     * 关联管理员附属表A
     */
    public function adminInfo() {
        return $this->hasOne(AdminInfo::class,'admin_id','id');
    }
}
