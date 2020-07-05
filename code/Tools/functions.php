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
