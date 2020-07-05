<?php
/**
 * Created By PHPStorm
 * User: SteffenKong(Konghy)
 * Date: 2020/7/5
 * Time: 20:45
 */


namespace Tools\Core;

/**
 * Class Loader
 * @package Tools\Core
 * 加载器工具
 */
class Loader {


    /**
     * @var array
     * 实例化类的实例对象
     */
    protected static $classList = [];


    /**
     * @param $className
     * @return mixed
     * 单例
     */
    public static function singleton($className) {
        if (isset(self::$classList[$className])) {
            return self::$classList[$className];
        }
        return self::$classList[$className] = new $className;
    }


    /**
     * @param $serviceName
     * @return mixed
     * 实例化service层对象
     */
    public static function service($serviceName) {
        return self::singleton($serviceName);
    }


    /**
     * @param $dataName
     * @return mixed
     * 实例化data层对象
     */
    public static function data($dataName) {
        return self::singleton($dataName);
    }

    /**
     * @param $daoName
     * @return mixed
     * 实例化dao层对象
     */
    public static function dao($daoName) {
        return self::singleton($daoName);
    }
}
