<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Permission\PermissionAddRequest;
use App\Http\Requests\Permission\PermissionDeleteRequest;
use App\Http\Requests\Permission\PermissionEditRequest;
use App\Model\services\PermissionService;
use Tools\JsonTools\JsonResponse;
use Illuminate\Http\Request;
use Tools\Core\Loader;

/**
 * Class PermissionController
 * @package App\Http\Controllers\Admin
 * 权限控制器
 */
class PermissionController extends BaseController
{

    /* @var PermissionService $permissionService */
    protected $permissionService;

    public function __construct()
    {
        parent::__construct();
        $this->permissionService = Loader::service(PermissionService::class);
    }


    /**
     * 权限列表
     */
    public function getList() {
        $data = $this->permissionService->getTree();
        JsonResponse::item($data);
    }


    /**
     * @param PermissionAddRequest $request
     * 录入权限
     */
    public function create(PermissionAddRequest $request) {
        $name = $request->get('name');
        $slug = $request->get('slug');
        $path = $request->get('path');
        $isMenu = $request->get('isMenu');
        $pid = $request->get('pid',0);

        if ($this->permissionService->checkNameIsExists($name)) {
            JsonResponse::fail('权限名已存在!');
        }

        if (!$this->permissionService->create($name,$path,$slug,$pid,$isMenu)) {
            JsonResponse::fail('录入权限失败!');
        }
        JsonResponse::success('录入成功');
    }


    /**
     * @param PermissionEditRequest $request
     * 编辑权限
     */
    public function update(PermissionEditRequest $request) {
        $permissionId = $request->get('id');
        $name = $request->get('name');
        $slug = $request->get('slug');
        $path = $request->get('path');
        $isMenu = $request->get('isMenu');
        $pid = $request->get('pid',0);

        if ($this->permissionService->checkNameIsExistsByUpdate($permissionId,$name)) {
            JsonResponse::fail('权限名已存在!');
        }


        if (!empty($slug)) {
            if ($this->permissionService->checkSlugIsExistsByUpdate($permissionId,$slug)) {
                JsonResponse::fail('前端标识已存在!');
            }
        }

        if (!$this->permissionService->update($permissionId,$name,$path,$slug,$pid,$isMenu)) {
            JsonResponse::fail('编辑失败!');
        }

        JsonResponse::success('编辑成功');
    }


    /**
     * @param PermissionDeleteRequest $request
     * 删除权限
     */
    public function delete(PermissionDeleteRequest $request) {
        $permissionId = $request->get('id');
        if (empty($permissionId)) {
            JsonResponse::fail('请传入权限id');
        }

        if (!$this->permissionService->delete($permissionId)) {
            JsonResponse::fail('删除失败!');
        }

        JsonResponse::success('删除成功');
    }


    /**
     * @param Request $request
     * 权限详情
     */
    public function detail(Request $request) {
        $permissionId = $request->get('id');
        if (empty($permissionId)) {
            JsonResponse::fail('请传入权限id!');
        }
        $detail = $this->checkPermission($permissionId);

        JsonResponse::item([
            'name' => $detail->name,
            'slug' => $detail->slug,
            'path' => $detail->path,
            'pid' => $detail->pid,
            'isMenu' => $detail->is_menu
        ]);

    }


    /**
     * @param $permissionId
     * @return mixed
     * 检测权限
     */
    public function checkPermission($permissionId) {
        $permission = $this->permissionService->find($permissionId);
        if(!$permission) {
            JsonResponse::fail('权限不存在!');
        }
        return $permission;
    }


    /**
     * 权限下拉选择
     */
    public function getPermissionSelect() {
        $selectData = $this->permissionService->getSelectTree();
        JsonResponse::item($selectData);
    }
}
