<?php
/**
 * Created By PHPStorm
 * User: SteffenKong(Konghy)
 * Date: 2020/7/5
 * Time: 20:40
 */

namespace App\Model\data;

use App\Model\Admin;

/**
 * Class AdminData
 * @package App\Model\data
 * 管理员 查询层
 */
class AdminData {

    /**
     * @param $account
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function getByAccount($account) {
        return Admin::with('adminInfo')->where('account',$account)->first();
    }


    /**
     * @param $adminId
     * @return mixed
     */
    public function find($adminId) {
        return Admin::with('adminInfo')->where('id',$adminId)->first();
    }
}
