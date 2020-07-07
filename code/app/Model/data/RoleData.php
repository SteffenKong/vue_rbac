<?php
/**
 * Created By PHPStorm
 * User: SteffenKong(Konghy)
 * Date: 2020/7/6
 * Time: 20:39
 */

namespace App\Model\data;


use App\Model\entity\Role;

/**
 * Class RoleData
 * @package App\Model\data
 * 角色查询层
 */
class RoleData {


    /**
     * @param $page
     * @param $pageSize
     * @param array $where
     * @return mixed
     * 获取角色列表
     */
    public function getList($page,$pageSize,$where = []) {
        return Role::when(isset($where['roleName']) && !empty($where['roleName']),function ($query) use ($where) {
            return $query->where('role_name','like',"%{$where['roleName']}%");
        })->when(isset($where['status']) && $where['status'] != -1,function ($query) use ($where) {
            return $query->where('status',$where['status']);
        })->orderBy('created_at','desc')->paginate($pageSize,["*"],'page',$page);
    }


    /**
     * @param $roleId
     * @return mixed
     */
    public function find($roleId) {
        return Role::where('id',$roleId)
            ->first();
    }

    /**
     * @param $roleId
     * @param $name
     * @return mixed
     * 更新时查找角色名是否已存在
     */
    public function checkNameIsExistsByUpdate($roleId,$name) {
        return Role::where('id','!=',$roleId)
            ->where('role_name',$name)
            ->exists();
    }


    /**
     * @param $roleName
     * @return mixed
     */
    public function checkNameIsExists($roleName) {
        return Role::where('role_name',$roleName)->exists();
    }
}
