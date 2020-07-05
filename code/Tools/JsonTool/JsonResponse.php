<?php
/**
 * Created By PHPStorm
 * User: SteffenKong(Konghy)
 * Date: 2020/7/2
 * Time: 13:32
 */

namespace Tools\JsonTools;

use Tools\JsonTools\JsonResult;

use Tools\JsonTools\ResultCode;

/**
 * Class JsonResponse
 * 接口响应格式
 */
class JsonResponse {

    /**
     * @param $message
     * @param array $extra
     * 执行成功
     */
    public static function success($message,$extra = []) {
        $result = new JsonResult(ResultCode::SUCCESS_CODE,$message);
        $result->setExtra($extra);
        $result->output();
    }


    /**
     * @param $message
     * @param array $extra
     * 执行失败
     */
    public static function fail($message,$extra = []) {
        $result = new JsonResult(ResultCode::FAIL_CODE,$message);
        $result->setExtra($extra);
        $result->setMessage($message);
        $result->output();
    }


    /**
     * @param $data
     * @param array $extra
     * 返回成功(数据集)
     */
    public static function item($data,$extra = []) {
        $result = new JsonResult(ResultCode::SUCCESS_CODE,'获取成功');
        $result->setData($data);
        $result->setExtra($extra);
        $result->output();
    }


    /**
     * @param $data
     * @param $count
     * @param $page
     * @param $pageSize
     * @param array $extra
     * 返回带有分页的数据接口(数据集)
     */
    public static function paginate($data,$count,$page,$pageSize,$extra = []) {
        $result = new JsonResult(ResultCode::SUCCESS_CODE,'获取成功');
        $result->setData($data);
        $result->setCode($count);
        $result->setPage($page);
        $result->setPageSize($pageSize);
        $result->setExtra($extra);
    }


    public static function authorize(){
        $result = new JsonResult(ResultCode::NEED_AUTHORIZE_CODE,'请登录!');
        $result->output();
    }
}
