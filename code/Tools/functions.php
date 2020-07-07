<?php
/**
 * Created By PHPStorm
 * User: SteffenKong(Konghy)
 * Date: 2020/7/5
 * Time: 20:44
 */

// 项目函数库

if (!function_exists('encryptPassword')) {

    /**
     * @param $password
     * @param $salt
     * @return string
     * 密码加盐加密
     */
    function encryptPassword($password,$salt) {
        if (!$password) return $password;
        return md5(md5($password.$salt));
    }
}



if (!function_exists('getTreeHasChildren')) {

    function getTreeHasChildren() {

    }
}


if (!function_exists('toTree')) {

    /**
     * @param $data
     * @param int $pid
     * @param int $level
     * @return array
     * 将数据转化为树状排序
     */
    function toTree($data,$pid = 0,$level = 0) {
        static $allData = [];
        foreach ($data ?? [] as $one) {
            if ($one['pid'] == $pid) {
                $level++;
                $one['level'] = $level;
                $allData[] = $one;
                return toTree($data,$one['id'],$level);
            }
        }
        return $allData;
    }
}


