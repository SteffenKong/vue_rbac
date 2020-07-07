<?php
/**
 * Created By PHPStorm
 * User: SteffenKong(Konghy)
 * Date: 2020/7/6
 * Time: 22:57
 */


namespace App\Model\services;

use App\Model\dao\PermissionDao;
use App\Model\data\PermissionData;
use Tools\Core\Loader;

/**
 * Class PermissionService
 * @package App\Model\services
 * 权限服务层
 */
class PermissionService {


    /* @var PermissionData $permissionData */
    private $permissionData;

    /* @var PermissionDao $permissionDao*/
    private $permissionDao;

    public function __construct()
    {
        $this->permissionDao = Loader::dao(PermissionDao::class);
        $this->permissionData = Loader::data(PermissionData::class);
    }


    /**
     * 获取树状排序的权限数据
     */
    public function getTree() {
        return toTree($this->getAll());
    }


    /**
     * 获取权限下拉框
     */
    public function getSelectTree() {
        $return = [];
        $items = $this->permissionData->getAll();
        foreach ($items ?? []  as $item) {
            $return[] = [
                'label' => $item->name,
                'value' => $item->id,
            ];
        }
        return $return;
    }


    public function getTreeByChildrenTree() {

    }


    /**
     * @return mixed
     * 获取所有权限
     */
    private function getAll() {
        $return = [];
        $items = $this->permissionData->getAll();
        foreach ($items ?? [] as $item) {
            $return[] = [
                'id' => $item->id,
                'name' => $item->name,
                'pid' => $item->pid,
                'path' => $item->path,
                'slug' => $item->slug ?? '',
                'isMenu' => $item->is_menu,
                'createdAt' => $item->created_at->toDateTimeString(),
                'updatedAt' => $item->updated_at->toDateTimeString(),
            ];
        }
        return $return;
    }


    /**
     * @param $name
     * @param $path
     * @param $slug
     * @param $pid
     * @param $isMenu
     * @return mixed
     * 创建权限
     */
    public function create($name,$path,$slug,$pid,$isMenu) {
        return $this->permissionDao->create($name,$path,$slug,$pid,$isMenu);
    }


    /**
     * @param $permissionId
     * @param $name
     * @param $path
     * @param $slug
     * @param $pid
     * @param $isMenu
     * @return mixed
     * 更新权限
     */
    public function update($permissionId,$name,$path,$slug,$pid,$isMenu) {
        return $this->permissionDao->update($permissionId,$name,$path,$slug,$pid,$isMenu);
    }


    /**
     * @param $permissionId
     * @return mixed
     */
    public function find($permissionId) {
        return $this->permissionData->find($permissionId);
    }


    /**
     * @param $permissionId
     * @param $name
     * @return mixed
     */
    public function checkNameIsExistsByUpdate($permissionId,$name) {
        return $this->permissionData->checkNameIsExistsByUpdate($permissionId,$name);
    }


    /**
     * @param $permissionId
     * @param $slug
     * @return mixed
     */
    public function checkSlugIsExistsByUpdate($permissionId,$slug) {
        return $this->permissionData->checkSlugIsExistsByUpdate($permissionId,$slug);
    }


    /**
     * @param $permissionId
     * @return mixed
     * 删除权限
     */
    public function delete($permissionId) {
        return $this->permissionDao->delete($permissionId);
    }


    public function checkNameIsExists($permissionName) {
        return $this->permissionData->checkNameIsExists($permissionName);
    }
}
