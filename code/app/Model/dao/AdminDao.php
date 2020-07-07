<?php
/**
 * Created By PHPStorm
 * User: SteffenKong(Konghy)
 * Date: 2020/7/5
 * Time: 20:40
 */

namespace App\Model\dao;

use App\Model\entity\AdminInfo;
use App\Model\entity\Admin;
use Hash;
use Tools\Rsa\RSACrypt;

/**
 * Class AdminDao
 * @package App\Model\data
 * 管理员 操作层
 */
class AdminDao {


    /**
     * @param $adminId
     * @param $password
     * @return int
     * 重新加密更新密码
     */
    public function refreshPassword($adminId,$password) {
        return Admin::where('admin_id',$adminId)->update([
            'password' => $password
        ]);
    }


    /**
     * @param $adminId
     * @param $account
     * @return int
     * 更新管理员主表账号
     */
    public function updateAccount($adminId,$account) {
        return Admin::where('id',$adminId)->update([
            'account' => $account
        ]);
    }


    /**
     * @param $adminId
     * @param $email
     * @param $phone
     * @param $isCan
     * @return int
     * 更新管理员附表数据
     */
    public function updateAdminInfo($adminId,$email,$phone,$isCan) {
        return AdminInfo::where('admin_id',$adminId)
            ->update([
                'email' => $email,
                'phone' => $phone,
                'is_can' => $isCan
            ]);
    }


    /**
     * @param $adminId
     * @param $status
     * @return int
     * 修改管理员状态
     */
    public function changeStatus($adminId,$status) {
        return Admin::where('id',$adminId)
            ->update([
                'status' => !$status,
            ]);
    }

    /**
     * @param $adminId
     * @return mixed
     * 删除管理员主表数据
     */
    public function deleteAdmin($adminId) {
        return Admin::where('id',$adminId)->delete();
    }


    /**
     * @param $adminId
     * @return mixed
     * 删除管理员附表数据
     */
    public function deleteAdminInfo($adminId) {
        return AdminInfo::where('admin_id',$adminId)->delete();
    }


    /**
     * @param $account
     * @param $password
     * @param $salt
     * @return Admin|\Illuminate\Database\Eloquent\Model
     * 插入主表数据
     */
    public function insertAdmin($account,$password,$salt) {
        return Admin::create([
            'account' => $account,
            'password' => $password,
            'salt' => $salt,
            'status' => 1
        ]);
    }


    /**
     * @param $adminId
     * @param $email
     * @param $phone
     * @param $isCan
     * @return AdminInfo|\Illuminate\Database\Eloquent\Model
     * 插入附表数据
     */
    public function insertAdminInfo($adminId,$email,$phone,$isCan) {
        return AdminInfo::create([
            'admin_id' => $adminId,
            'email' => $email,
            'phone' => $phone,
            'is_can' => $isCan
        ]);
    }


    /**
     * @param $adminId
     * @param $password
     * @param $salt
     * @return int
     * 更改密码
     */
    public function changePassword($adminId,$password,$salt) {
        return Admin::where('id',$adminId)->update([
            'password' => $password,
            'salt' => $salt
        ]);
    }
}
