<?php

namespace App\Model\entity;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AdminInfo
 *
 * @package App\Model
 * 管理员信息模型
 * @property int $id
 * @property int $admin_id 管理员id
 * @property string|null $email 邮箱
 * @property string|null $phone 电话号码
 * @property string $is_can 是否开启邮箱发送 0 - 未开启 1 - 已开启
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Model\Admin $admin
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\AdminInfo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\AdminInfo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\AdminInfo query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\AdminInfo whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\AdminInfo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\AdminInfo whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\AdminInfo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\AdminInfo whereIsCan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\AdminInfo wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\AdminInfo whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AdminInfo extends Model
{
    protected $table = 'admin_info';

    public $fillable = [
        'id',
        'admin_id',
        'email',
        'phone',
        'is_can',
        'created_at',
        'updated_at'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * 关联管理员模型
     */
    public function admin(){
        return $this->belongsTo(Admin::class,'id','admin_id');
    }
}
