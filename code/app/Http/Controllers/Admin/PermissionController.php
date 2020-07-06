<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\PermissionAddRequest;
use App\Http\Requests\Admin\PermissionDeleteRequest;
use App\Http\Requests\Admin\PermissionEditRequest;
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


    public function getList() {

    }


    public function create(PermissionAddRequest $request) {

    }

    public function update(PermissionEditRequest $request) {

    }

    public function delete(PermissionDeleteRequest $request) {

    }

    public function detail(Request $request) {
        $permissionId = $request->get('id');
        if (empty($permissionId)) {
            JsonResponse::fail('请传入权限id!');
        }


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
}
