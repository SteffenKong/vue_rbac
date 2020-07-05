<?php
/**
 * Created By PHPStorm
 * User: SteffenKong(Konghy)
 * Date: 2020/6/4
 * Time: 15:31
 */

namespace Tools\JsonTools;

use Tools\JsonTools\StringUtils;

/**
 * Class JsonResult
 * 格式返回
 */
class JsonResult {

    /**
     * @var array
     * 数据
     */
    private $data = [];

    /**
     * @var
     * 消息
     */
    private $message;

    /**
     * @var
     * 返回码
     */
    private $code;


    /**
     * @var
     * 列表数据条数
     */
    private $count;

    /**
     * @var
     * 页数
     */
    private $pageSize;


    /**
     * @var array
     * 扩展数据
     */
    private $extra = [];


    /**
     * @var
     * 当前页码
     */
    private $page;


    /**
     * @var bool
     * 是否发送json头信息
     */
    private $useJsonHeader = true;


    const SUCCESS_CODE = '000';
    const FAIL_CODE = '001';


    private static $_CODE_STATUS = [
        self::SUCCESS_CODE => '操作成功',
        self::FAIL_CODE => '操作失败'
    ];


    public function __construct($code,$message)
    {
        $this->setCode($code);
        $this->setMessage($message);
    }


    /**
     * @param $code
     * 设置返回码
     */
    public function setCode($code) {
        $this->code = $code;
    }





    /**
     * @return array
     * 获取data数据
     */
    public function getData() {
        return $this->data;
    }


    /**
     * @param $message
     * 设置返回信息
     */
    public function setMessage($message) {
        $this->message = $message;
    }


    /**
     * @return mixed
     * 获取返回消息
     */
    public function getMessage() {
        return $this->message;
    }

    /**
     * @return mixed
     * 获取返回码
     */
    public function getCode() {
        return $this->message;
    }


    /**
     *以json格式输出
     */
    public function output() {
        if ($this->useJsonHeader) {
            header('Content-type: application/json;charset=utf-8');
        }
        echo $this; //这里触发当前类的__toString()
        exit();
    }


    /**
     * @return bool
     * 是否成功
     */
    public function isSuccess() {
        return $this->code == self::SUCCESS_CODE;
    }


    /**
     * @param $useJsonHeader
     * 设置是否使用json头部
     */
    public function setUseJsonHeader($useJsonHeader) {
        $this->useJsonHeader = $useJsonHeader;
    }


    /**
     * @param $count
     */
    public function setCount($count) {
        $this->count = $count;
    }

    /**
     * @return mixed
     */
    public function getCount() {
        return $this->count;
    }

    /**
     * @param $data
     */
    public function setExtra($data) {
        $this->extra = $data;
    }

    /**
     * @return array
     */
    public function getExtra() {
        return $this->extra;
    }


    /**
     * @param $page
     */
    public function setPage($page) {
        $this->page = $page;
    }


    /**
     * @param $page
     * @return mixed
     */
    public function getPage() {
        return $this->page;
    }

    /**
     * @param $pageSize
     * @return mixed
     */
    public function setPageSize($pageSize) {
        return $this->pageSize = $pageSize;
    }

    /**
     * @return mixed
     */
    public function getPageSize() {
        return $this->pageSize;
    }


    /**
     * @return false|string
     * 打印对象输出的内容
     */
    public function __toString()
    {
        //如果没有设置返回信息就使用配置编码对应的返回信息
        if (empty($this->message)) {
            $this->setMessage(self::$_CODE_STATUS[$this->code]);
        }

        return StringUtils::jsonEncode([
            'code' => $this->getCode(),
            'success' => $this->isSuccess(),
            'message' => $this->getMessage(),
            'data' => $this->getData(),
            'count' => $this->getCount(),
            'page' => $this->getPage(),     // 当前页码
            'pageSize' => $this->getPageSize(),  // 每页的条数
            // 总页数
            'countPage' => $this->getPageSize() != 0 ? ceil($this->getCount()/$this->getPageSize()) : 0,
            'extra' => $this->getExtra()
        ]);
    }


    /**
     * @param string $message
     */
    public static function success($message = '成功') {
        $result = new self(self::SUCCESS_CODE,$message);
        $result->output();
    }


    /**
     * @param string $message
     */
    public static function fail($message = '失败') {
        $result = new self(self::FAIL_CODE,$message);
        $result->output();
    }

    /**
     * @param $data
     */
    public function setData($data) {
        $this->data = $data;
    }
}
