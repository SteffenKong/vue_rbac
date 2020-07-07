<?php
/**
 * Created By PHPStorm
 * User: SteffenKong(Konghy)
 * Date: 2020/7/6
 * Time: 20:39
 */

namespace App\Model\data;


use App\Model\entity\Permission;

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


    /**
     * @param $permissionId
     * @param $name
     * @return mixed
     * 检测权限名是否存在
     */
    public function checkNameIsExistsByUpdate($permissionId,$name) {
        return Permission::where('id','!=',$permissionId)
            ->where('name',$name)
            ->exists();
    }


    /**
     * @param $permissionId
     * @param $slug
     * @return mixed
     * 检测前端标识是否存在
     */
    public function checkSlugIsExistsByUpdate($permissionId,$slug) {
        return Permission::where('id','!=',$permissionId)
            ->where('slug',$slug)
            ->exists();
    }


    /**
     * @param $permissionName
     * @return mixed
     */
    public function checkNameIsExists($permissionName) {
        return Permission::where('name',$permissionName)->exists();
    }
}
