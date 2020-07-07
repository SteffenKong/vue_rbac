<?php
/**
 * Created By PHPStorm
 * User: SteffenKong(Konghy)
 * Date: 2020/7/6
 * Time: 20:39
 */

namespace App\Model\dao;


use App\Model\entity\Permission;

/**
 * Class PermissionDao
 * @package App\Model\dao
 * 权限操作层
 */
class PermissionDao {


    /**
     * @param $name
     * @param $path
     * @param $slug
     * @param $pid
     * @param $isMenu
     * @param $pidStr
     * @return mixed
     * 录入权限
     */
   public function create($name,$path,$slug,$pid,$isMenu) {
       return Permission::create([
           'name' => $name,
           'path' => $path,
           'slug' => $slug,
           'pid' => $pid,
           'is_menu' => $isMenu,
       ]);
   }


    /**
     * @param $permissionId
     * @param $name
     * @param $path
     * @param $slug
     * @param $pid
     * @param $isMenu
     * @param $pidStr
     * @return mixed
     * 更新权限
     */
   public function update($permissionId,$name,$path,$slug,$pid,$isMenu) {
       return Permission::where('id',$permissionId)->update([
           'name' => $name,
           'path' => $path,
           'slug' => $slug,
           'pid' => $pid,
           'is_menu' => $isMenu,
       ]);
   }


    /**
     * @param $permissionId
     * @return mixed
     * 删除权限
     */
   public function delete($permissionId) {
       return Permission::where('id',$permissionId)->delete();
   }
}
