<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Role\RoleAddRequest;
use App\Http\Requests\Role\RoleChangeStatusRequest;
use App\Http\Requests\Role\RoleDeleteRequest;
use App\Http\Requests\Role\RoleEditRequest;
use App\Model\services\RoleService;
use Request;
use Tools\Core\Loader;
use Tools\JsonTools\JsonResponse;

/**
 * Class RoleController
 * @package App\Http\Controllers\Admin
 * 角色控制器
 */
class RoleController extends BaseController
{

    /* @var RoleService $roleService */
    protected $roleService;

    public function __construct()
    {
        parent::__construct();
        $this->roleService = Loader::service(RoleService::class);
    }


    /**
     * @param Request $request
     * 获取角色列表
     */
    public function getList(Request $request) {
        $where = [
            'roleName' => $request->get('roleName',''),
            'status' => $request->get('status',-1)
        ];
        list($data,$total) = $this->roleService->getList($this->getPage(),$this->getPageSize(),$where);
        JsonResponse::paginate($data,$total,$this->getPage(),$this->getPageSize());
    }


    /**
     * @param RoleAddRequest $request
     * 录入角色
     */
    public function create(RoleAddRequest $request) {
        $roleName = $request->get('roleName');
        if (!$this->roleService->create($roleName)) {
            JsonResponse::fail('录入角色失败!');
        }
        JsonResponse::success('录入角色成功');
    }


    /**
     * @param RoleEditRequest $request
     * 编辑角色
     */
    public function update(RoleEditRequest $request) {
        $roleId = $request->get('id');
        $roleName = $request->get('roleName');
        $this->checkRole($roleId);
        if ($this->roleService->checkNameIsExistsByUpdate($roleId,$roleName)) {
            JsonResponse::fail('角色名字已存在!');
        }

        if (!$this->roleService->update($roleId,$roleName)) {
            JsonResponse::fail('编辑角色失败!');
        }
        JsonResponse::success('编辑角色成功');
    }


    /**
     * @param RoleDeleteRequest $request
     * 删除角色
     */
    public function delete(RoleDeleteRequest $request) {
        $roleId = $request->get('id');
        $this->checkRole($roleId);
        if (!$this->roleService->delete($roleId)) {
            JsonResponse::fail('删除角色失败!');
        }
        JsonResponse::success('删除角色成功');
    }

    /**
     * @param RoleChangeStatusRequest $request
     * 更改角色状态
     */
    public function changeStatus(RoleChangeStatusRequest $request) {
        $roleId = $request->get('id');
        $role = $this->checkRole($roleId);
        if (!$this->roleService->changeStatus($role)) {
            JsonResponse::fail('删除角色失败!');
        }
        JsonResponse::success('删除角色成功');
    }


    /**
     * @param Request $request
     * 获取角色详情
     */
    public function detail(Request $request) {
        $roleId = $request->get('id');
        if (!$roleId) {
            JsonResponse::fail('请传入角色id!');
        }

        $detail = $this->checkRole($roleId);

        JsonResponse::item([
            'id' => $detail->id,
            'roleName' => $detail->role_name
        ]);
    }


    /**
     * @param $roleId
     * @return mixed
     * 检测角色
     */
    private function checkRole($roleId) {
        $role = $this->roleService->find($roleId);
        if (empty($role)) {
            JsonResponse::fail('角色不存在!');
        }
        return $role;
    }
}
