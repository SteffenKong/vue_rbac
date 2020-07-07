<?php
/**
 * Created By PHPStorm
 * User: SteffenKong(Konghy)
 * Date: 2020/7/6
 * Time: 20:39
 */

namespace App\Model\dao;


use App\Model\entity\Role;

/**
 * Class RoleDao
 * @package App\Model\dao
 * 角色操作层
 */
class RoleDao {


    /**
     * @param $roleName
     * @return mixed
     * 创建角色
     */
    public function create($roleName) {
        return Role::create([
            'role_name' => $roleName,
            'status' => 1,
        ]);
    }


    /**
     * @param $roleId
     * @param $status
     * @return mixed
     * 更改角色状态
     */
    public function changeStatus($roleId,$status) {
        return Role::where('id',$roleId)->update([
            'status' => !$status
        ]);
    }


    /**
     * @param $roleId
     * @param $roleName
     * @return mixed
     * 更新角色名字
     */
    public function update($roleId,$roleName) {
        return Role::where('id',$roleId)->update([
            'role_name' => $roleName
        ]);
    }


    /**
     * @param $roleId
     * @return mixed
     * 删除角色
     */
    public function delete($roleId) {
        return Role::where('id',$roleId)->delete();
    }
}
