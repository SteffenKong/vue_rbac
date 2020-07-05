<?php
/**
 * Created By PHPStorm
 * User: SteffenKong(Konghy)
 * Date: 2020/6/4
 * Time: 15:23
 */

namespace Tools\JsonTools;

/**
 * Class StringUtils
 * 字符串工具类
 */
class StringUtils {


    /**
     * @param array $array
     * @return false|string
     * 数组转json字符串
     */
    public static function jsonEncode($array = []) {
        return json_encode($array,JSON_UNESCAPED_UNICODE);
    }


    /**
     * @param $string
     * @return mixed
     * json字符串转数组
     */
    public static function jsonDecode($string) {
        $string = trim($string,'\xEF\xBB\xBF');
        return json_decode($string,true);
    }


    /**
     * @param $length
     * @return string
     * 获取指定长度的随机字符串
     */
    public static function genRandomString($length) {
        $array = array_merge(range(0,9),range('a','z'),range('A','Z'));
        $index = array_rand($array,$length);
        shuffle($index);
        $str = '';
        foreach ($index ?? [] as $i) {
            $str .= $array[$i];
        }
        return $str;
    }
}
