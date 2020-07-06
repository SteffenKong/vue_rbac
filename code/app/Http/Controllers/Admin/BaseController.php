<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Request;

/**
 * Class BaseController
 * @package App\Http\Controllers\Admin
 * 基础控制器
 */
class BaseController extends Controller
{

    protected $page;

    protected $pageSize;

    public function __construct()
    {
        // 实例化请求对象
        /* @var Request $request */
        $request = Request::instance();

        // 传入请求对象
        $this->setPageParam($request);
    }


    /**
     * @param Request $request
     * 设置分页参数
     */
    private function setPageParam(Request $request) {
        $page = $request->get('page');
        if ($page <= 0) {
            $page = 1;
        }

        $pageSize = $request->get('pageSize');

        if ($pageSize <= 0) {
            $pageSize = 10;
        }

        // 设置每页显示的数量
        $this->setPageSize($pageSize);

        // 设置当前页码
        $this->setPage($page);
    }
    /**
     * @return mixed
     * 获取当前页码
     */
    protected function getPage() {
        return $this->page;
    }

    /**
     * @return mixed
     * 获取每页的数据量
     */
    protected function getPageSize() {
        return $this->pageSize;
    }

    /**
     * @param $page
     */
    private function setPage($page) {
        $this->page = $page;
    }

    /**
     * @param $pageSize
     */
    private function setPageSize($pageSize) {
        $this->pageSize = $pageSize;
    }
}
