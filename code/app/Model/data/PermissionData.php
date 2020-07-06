<?php
/**
 * Created By PHPStorm
 * User: SteffenKong(Konghy)
 * Date: 2020/7/6
 * Time: 20:39
 */

namespace App\Model\data;


use App\Admin\entity\Permission;

/**
 * Class PermissionData
 * @package App\Model\PermissionData
 * 权限查询层
 */
class PermissionData {


    /**
     * @return mixed
     * 获取所有权限数据
     */
    public function getAll() {
        return Permission::get();
    }


    /**
     * @param $permissionId
     * @return mixed
     */
    public function find($permissionId) {
        return Permission::where('id',$permissionId)->first();
    }
}
