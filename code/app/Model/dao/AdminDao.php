<?php
/**
 * Created By PHPStorm
 * User: SteffenKong(Konghy)
 * Date: 2020/7/5
 * Time: 20:40
 */

namespace App\Model\dao;

use App\Model\Admin;

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
}
