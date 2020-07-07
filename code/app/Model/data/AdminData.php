<?php
/**
 * Created By PHPStorm
 * User: SteffenKong(Konghy)
 * Date: 2020/7/5
 * Time: 20:40
 */

namespace App\Model\data;

use App\Model\entity\Admin;

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


    /**
     * @param $page
     * @param $pageSize
     * @param array $where
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     * 获取管理员列表
     */
    public function getList($page,$pageSize,$where = []) {
        return Admin::when(isset($where['account']) && !empty($where['account']),function ($query) use ($where) {
            return $query->where('account','like',"%{$where['account']}%");
        })->when(isset($where['email']) && !empty($where['email']),function ($query) use ($where) {
            return $query->where('email','like',"%{$where['email']}%");
        })->when(isset($where['phone']) && !empty($where['phone']),function ($query) use ($where) {
            return $query->where('phone','like',"%{$where['phone']}%");
        })->when(isset($where['status']) && $where['status'] != -1,function ($query) use ($where) {
            return $query->where('status',$where['status']);
        })->paginate($pageSize,["*"],'page',$page);
    }
}
