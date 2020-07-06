<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminAddRequest;
use App\Http\Requests\Admin\AdminChangePasswordRequest;
use App\Http\Requests\Admin\AdminChangeStatusRequest;
use App\Http\Requests\Admin\AdminDeleteRequest;
use App\Http\Requests\Admin\AdminUpdateRequest;
use App\Model\entity\Admin;
use App\Model\services\AdminService;
use Illuminate\Http\Request;
use Tools\Core\Loader;
use Tools\JsonTools\JsonResponse;

/**
 * Class AdminController
 * @package App\Http\Controllers\Admin
 * 管理员模块 控制器
 */
class AdminController extends BaseController
{

    /* @var AdminService $adminService */
    protected $adminService;

    public function __construct()
    {
        $this->adminService = Loader::service(AdminService::class);
    }

    public function getList(Request $request) {
        $where = [
            'account' => $request->get('account',''),
            'email' => $request->get('email',''),
            'phone' => $request->get('phone',''),
            'status' => $request->get('status',-1)
        ];

        list($data,$total) = $this->adminService->getList($this->getPage(),$this->getPageSize(),$where);
        JsonResponse::paginate($data,$total,$this->getPage(),$this->getPageSize());
    }


    /**
     * @param AdminAddRequest $request
     * @throws \Exception
     * 添加管理员
     */
    public function create(AdminAddRequest $request) {
        $account = $request->get('account');
        $password = $request->get('password');
        $email = $request->get('email');
        $phone = $request->get('phone');
        $isCan = $request->get('isCan');
        if (!$this->adminService->create($account,$password,$email,$phone,$isCan)) {
            JsonResponse::fail('录入失败!');
        }
        JsonResponse::success('录入成功');
    }


    /**
     * @param AdminUpdateRequest $request
     * @throws \Exception
     * 编辑管理员
     */
    public function update(AdminUpdateRequest $request) {
        $adminId = $request->get('id');
        $account = $request->get('account');
        $email = $request->get('email');
        $phone = $request->get('phone');
        $isCan = $request->get('isCan');
        if (!$this->adminService->update($adminId,$account,$email,$phone,$isCan)) {
            JsonResponse::fail('编辑失败!');
        }
        JsonResponse::success('编辑成功');
    }


    /**
     * @param AdminChangePasswordRequest $request
     * @throws \App\Exceptions\AuthorizeException
     * 修改管理员密码
     */
    public function changePassword(AdminChangePasswordRequest $request) {
        $adminId = $request->get('id');
        $password = $request->get('password');
        if (!$this->adminService->changePassword($adminId,$password)) {
            JsonResponse::fail('修改密码失败!');
        }

        JsonResponse::success('修改密码成功');
    }


    /**
     * @param AdminDeleteRequest $request
     * @throws \Exception
     * 删除管理员
     */
    public function delete(AdminDeleteRequest $request) {
        $adminId = $request->get('id');
        if (!$this->adminService->delete($adminId)) {
            JsonResponse::fail('删除失败!');
        }
        JsonResponse::success('删除成功');
    }


    /**
     * @param AdminChangeStatusRequest $request
     * 修改管理员状态
     */
    public function changeStatus(AdminChangeStatusRequest $request) {
        $adminId = $request->get('id');
        /* @var Admin $admin */
        $admin = $this->checkAdminExists($adminId);
        if (!$this->adminService->changeStatus($admin)) {
            JsonResponse::fail('编辑失败!');
        }
        JsonResponse::success('编辑成功');
    }


    /**
     * @param $adminId
     * @return mixed
     * 校验管理员是否存在
     */
    private function checkAdminExists($adminId) {
        $admin = $this->adminService->find($adminId);
        if(empty($admin)) {
            JsonResponse::fail('管理员不存在!');
        }
        return $admin;
    }
}
