<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Login\LoginRequest;
use App\Model\services\AdminService;
use Tools\Core\Loader;
use Tools\JsonTools\JsonResponse;
use Tools\Jwt\JwtTool;


/**
 * Class LoginController
 * @package App\Http\Controllers\Admin
 * 登录控制器
 */
class LoginController extends Controller
{


    /**
     * @param LoginRequest $request
     * @throws \App\Exceptions\AuthorizeException
     * 登录接口
     */
    public function login(LoginRequest $request) {
        $account = $request->get('account');
        $password = $request->get('password');
        /* @var AdminService $adminService*/
        $adminService = Loader::service(AdminService::class);
        $admin = $adminService->login($account,$password);

        if (!$admin) {
            JsonResponse::fail('账号或密码错误!');
        }

        if (!$admin['status']) {
            JsonResponse::fail('该账户已锁定，请联系超级管理员！');
        }

        // 生成Token
        $token = JwtTool::getInstance(\config('rbac.jwt.secret'))->makeToken($admin);

        JsonResponse::success('登录成功',[
            'token' => $token,
            'adminId' => $admin['id'],
            'account' => $admin['account']
        ]);
    }


    /**
     * 获取公钥
     */
    public function getPublicKey() {
        JsonResponse::success('获取成功',[
            'publicKey' => \config('rbac.publicKey')
        ]);
    }
}
