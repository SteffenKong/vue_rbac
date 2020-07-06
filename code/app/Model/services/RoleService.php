<?php
/**
 * Created By PHPStorm
 * User: SteffenKong(Konghy)
 * Date: 2020/7/6
 * Time: 20:37
 */

namespace App\Model\services;

use App\Admin\entity\Role;
use App\Model\dao\RoleDao;
use App\Model\data\RoleData;
use Tools\Core\Loader;

/**
 * Class RoleService
 * @package App\Model\services
 * 角色服务层
 */
class RoleService
{

    /* @var RoleData $roleData */
    protected $roleData;

    /* @var RoleDao $roleDao */
    protected $roleDao;

    public function __construct()
    {
        $this->roleData = Loader::data(RoleData::class);
        $this->roleDao = Loader::dao(RoleDao::class);
    }


    /**
     * @param $page
     * @param $pageSize
     * @param array $where
     * @return array
     * 获取角色列表
     */
    public function getList($page, $pageSize, $where = [])
    {
        $items = $this->roleData->getList($page, $pageSize, $where);
        $return = [];
        foreach ($items->item() ?? [] as $role) {
            $return[] = [
                'id' => $role->id,
                'roleName' => $role->role_name,
                'status' => $role->status,
                'createdAt' => $role->created_at,
                'updatedAt' => $role->updated_at
            ];
        }
        return [$return, $items->total()];
    }


    /**
     * @param $roleId
     * @return mixed
     * 查找角色
     */
    public function find($roleId)
    {
        return $this->roleData->find($roleId);
    }

    /**
     * @param $roleName
     * @return mixed
     * 创建角色
     */
    public function create($roleName)
    {
        return $this->roleDao->create($roleName);
    }


    /**
     * @param $roleId
     * @param $roleName
     * @return mixed
     * 编辑角色
     */
    public function update($roleId, $roleName)
    {
        return $this->roleDao->update($roleId, $roleName);
    }


    /**
     * @param Role $role
     * @return mixed
     * 编辑角色状态
     */
    public function changeStatus(Role $role)
    {
        $roleId = $role->id;
        $status = $role->status;
        return $this->roleDao->changeStatus($roleId, $status);
    }


    /**
     * @param $roleId
     * @return mixed
     * 删除角色
     */
    public function delete($roleId)
    {
        return $this->roleDao->delete($roleId);
    }


    /**
     * @param $roleId
     * @param $name
     * @return mixed
     * 更新时查找角色是否存在
     */
    public function checkNameIsExistsByUpdate($roleId,$name) {
        return $this->roleData->checkNameIsExistsByUpdate($roleId,$name);
    }
}
